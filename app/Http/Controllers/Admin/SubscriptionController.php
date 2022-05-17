<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionSaveRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $duration = $request->duration;
        $isDiscount = $request->is_discount;
        $isActive = $request->is_active;
        $subscriptions = Subscription::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
            ->when($price, fn ($query) => $query->where('price', $price))
            ->when($duration, fn ($query) => $query->where('duration', $duration))
            ->when($isDiscount, fn ($query) => $query->where('is_discount', ($isDiscount == 'true') ? 1 : 0))
            ->when($isActive, fn ($query) => $query->where('is_active', ($isActive == 'true') ? 1 : 0))
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/Subscriptions/Index', [
            'subscriptions' => $subscriptions
        ]);
    }
    public function edit(Subscription $subscription)
    {
        return Inertia::render('Admin/Subscriptions/Edit', [
            'subscription' => $subscription
        ]);
    }
    public function update($id, SubscriptionSaveRequest $request)
    {
//        dd($id);

        $subscription = Subscription::findOrFail($id);
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->duration = $request->duration > 12 ? 1 : $request->duration;
        $subscription->is_discount = $request->is_discount == 'true';
        $subscription->discount_percentage = $request->discount_percentage;
        $subscription->is_active = $request->is_active == 'true';
        $subscription->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/Subscriptions/Create');
    }

    public function store(SubscriptionSaveRequest $request)
    {
        $subscription = new Subscription();
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->duration = $request->duration > 12 ? 1 : $request->duration;
        $subscription->is_discount = $request->is_discount == 'true';
        $subscription->discount_percentage = $request->discount_percentage;
        $subscription->is_active = $request->is_active == 'true';
        $subscription->save();
        return redirect()->route('admin.subscriptions.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
