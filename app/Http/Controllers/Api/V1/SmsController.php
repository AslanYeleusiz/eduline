<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Sms\SendSmsRequest;
use App\Http\Resources\V1\MessageResource;
use App\Models\SmsVerification;
use App\Services\V1\SmsService;

class SmsController extends Controller
{
    public function __construct(public SmsService $smsService)
    {

    }
    public function store(SendSmsRequest $request)
    {
        $phone = $request->phone;

        $this->smsService->checkLimitSms($phone);
        $code = $this->smsService->generateCode();

        $msg = __('auth.sms_verification') . $code;

        // $result =
        $this->smsService->send($msg, $phone);

        // $smsVerification =
         SmsVerification::create([
            'code' => $code,
            'status' => SmsVerification::STATUS_PENDING,
            'phone' => $phone
        ]);
        return new MessageResource(__('message.success.sent'));
    }
}
