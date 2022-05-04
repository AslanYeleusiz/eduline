<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalAdvice;
use App\Models\PersonalAdviceOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalAdviceOrderController extends Controller
{
    public function index(Request $request)
    {
        $fullName = $request->full_name;
        $phone = $request->phone;
        $personalAdviceId = $request->personal_advice_id;
        $commentForNote = $request->comment_for_note;
        $personalAdvices = PersonalAdvice::isActive()->get();
        $personalAdviceOrders = PersonalAdviceOrder::when($fullName, fn ($query) => $query->where('full_name', 'like', "%$fullName%"))
        ->when($phone, fn ($query) => $query->where('phone', 'like', "%$phone%"))
        ->when($commentForNote, fn ($query) => $query->where('comment_for_note', 'like', "%$commentForNote%"))
            ->when($personalAdviceId, fn ($query) => $query->where('personal_advice_id', $personalAdviceId))
            ->orderByDesc('id')
            ->with('personalAdvice')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/PersonalAdviceOrders/Index', [
            'personalAdvices' => $personalAdvices,
            'personalAdviceOrders' => $personalAdviceOrders
        ]);
    }
    public function edit($id)
    {
        $personalAdviceOrder = PersonalAdviceOrder::findOrFail($id);
        return Inertia::render('Admin/PersonalAdviceOrders/Edit', [
            'personalAdviceOrder' => $personalAdviceOrder
        ]);
    }
    public function update($id, Request $request)
    {
        $personalAdviceOrder = PersonalAdviceOrder::findOrFail($id);
        $personalAdviceOrder->comment_for_note = $request->input('comment_for_note');
        $personalAdviceOrder->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function destroy($id)
    {
        $personalAdviceOrder = PersonalAdviceOrder::findOrFail($id);
        $personalAdviceOrder->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
