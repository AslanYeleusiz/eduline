<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromoCodeSaveRequest;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->code;
        $day = $request->day;
        $usedCounts = $request->used_counts;
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $isActive = $request->is_active;

        $promoCodes = PromoCode::when($code, fn ($query) => $query->where('code', 'like', "%$code%"))
            ->when($fromDate, fn ($query) => $query->whereDate('from_date', '<=', $fromDate))
            ->when($toDate, fn ($query) => $query->whereDate('to_date', '>=', $toDate))
            ->when($day, fn ($query) => $query->where('day', $day))
            ->when($usedCounts, fn ($query) => $query->where('used_counts', $usedCounts))
            ->when($isActive, fn ($query) => $query->where('is_active', ($isActive == 'true') ? 1 : 0))
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/PromoCodes/Index', [
            'promoCodes' => $promoCodes
        ]);
    }
    public function edit(PromoCode $promoCode)
    {
        return Inertia::render('Admin/PromoCodes/Edit', [
            'promoCode' => $promoCode
        ]);
    }
    public function update(PromoCode $promoCode, PromoCodeSaveRequest $request)
    {
        $request->validate([
            'code' => 'unique:promo_codes,code,' . $promoCode->id
        ]);
        $discountPercentage = ($request->discount_percentage  > 0)  && ($request->discount_percentage < 101 )
        ? $request->discount_percentage
        : 0;
        $promoCode->code = $request->code;
        $promoCode->discount_percentage = $discountPercentage;
        $promoCode->from_date = $request->from_date;
        $promoCode->to_date = $request->to_date;
        $promoCode->is_active = $request->is_active == 'true';
        $promoCode->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $code = Str::random(10);
        return Inertia::render('Admin/PromoCodes/Create', compact('code'));
    }

    public function store(PromoCodeSaveRequest $request)
    {
        $request->validate([
            'code' => 'unique:promo_codes,code'
        ]);
        $promoCode = new PromoCode();
        $promoCode->code = $request->code;
        $promoCode->day = $request->day;
        $promoCode->from_date = $request->from_date;
        $promoCode->to_date = $request->to_date;
        $promoCode->is_active = $request->is_active == 'true';
        $promoCode->save();
        return redirect()->route('admin.promoCodes.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
