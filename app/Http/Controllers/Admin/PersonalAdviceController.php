<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonalAdviceSaveRequest;
use App\Models\PersonalAdvice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalAdviceController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $price = $request->price;
        $isDiscount = $request->is_discount;
        $isActive = $request->is_active;
        $personalAdvices = PersonalAdvice::when($title, fn ($query) => $query->where('title->kk', 'like', "%$title%"))
            ->when($price, fn ($query) => $query->where('price', $price))
            ->when($isDiscount, fn ($query) => $query->where('is_discount', ($isDiscount == 'true') ? 1 : 0))
            ->when($isActive, fn ($query) => $query->where('is_active', ($isActive == 'true') ? 1 : 0))
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/PersonalAdvice/Index', [
            'personalAdvices' => $personalAdvices
        ]);
    }
    public function edit(PersonalAdvice $personalAdvice)
    {
        return Inertia::render('Admin/PersonalAdvice/Edit', [
            'personalAdvice' => $personalAdvice
        ]);
    }
    public function update(PersonalAdvice $personalAdvice, PersonalAdviceSaveRequest $request)
    {
        $discountPercentage = ($request->discount_percentage  > 0)  && ($request->discount_percentage < 101 ) 
        ? $request->discount_percentage 
        : 0;
        $personalAdvice->title = $request->title;
        $personalAdvice->price = $request->price;
        $personalAdvice->is_discount = $request->is_discount == 'true';
        $personalAdvice->discount_percentage = $discountPercentage;
        $personalAdvice->is_active = $request->is_active == 'true';
        $personalAdvice->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/PersonalAdvice/Create');
    }

    public function store(PersonalAdviceSaveRequest $request)
    {
        $discountPercentage = ($request->discount_percentage  > 0)  && ($request->discount_percentage < 101 ) 
        ? $request->discount_percentage 
        : 0;

        $personalAdvice = new PersonalAdvice();
        $personalAdvice->title = $request->title;
        $personalAdvice->price = $request->price;
        $personalAdvice->is_discount = $request->is_discount == 'true';
        $personalAdvice->discount_percentage = $discountPercentage;
        $personalAdvice->is_active = $request->is_active == 'true';
        $personalAdvice->save();
        return redirect()->route('admin.PersonalAdvice.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(PersonalAdvice $personalAdvice)
    {
        $personalAdvice->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
