<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PersonalAdviceOrderSaveRequest;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\PersonalAdviceResource;
use App\Models\PersonalAdvice;
use App\Models\PersonalAdviceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalAdviceController extends Controller
{
    public function index(Request $request)
    {
        $personalAdvices = PersonalAdvice::isActive()
        ->paginate($request->input('per_page', 20))
        ->append($request->except('page'));

        return PersonalAdviceResource::collection($personalAdvices)->additional(['status' => true]);
    }

    public function store($id, PersonalAdviceOrderSaveRequest $request)
    {
        $personalAdvice = PersonalAdvice::isActive()->findOrFail($id);
        PersonalAdviceOrder::create([
            'personal_advice_id' => $personalAdvice->id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
        ]);
        return new MessageResource(__('message.success.saved'));

    }

    public function show($id)
    {
        $personalAdvice = PersonalAdvice::isActive()->findOrFail($id);
        return new PersonalAdviceResource($personalAdvice);
    }
}
