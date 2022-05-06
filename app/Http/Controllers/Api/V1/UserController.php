<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserEmailSaveRequest;
use App\Http\Requests\Api\V1\User\UserPasswordSaveRequest;
use App\Http\Requests\Api\V1\User\UserPhoneSaveRequest;
use App\Http\Requests\Api\V1\User\UserProfileSaveRequest;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\User\UserProfileResource;
use App\Mail\EmailUpdate;
use App\Models\SmsVerification;
use App\Services\V1\SmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct(public SmsService $smsService)
    {
    }

    public function profile()
    {
        $user = auth()->guard('api')->user();
        return new UserProfileResource($user);
    }

    public function updateProfile(UserProfileSaveRequest $request)
    {
        $user = auth()->guard('api')->user();
        $user->full_name = $request->full_name;
        $user->place_work = $request->place_work;
        $user->sex = $request->sex;
        $user->birthday = $request->birthday;
        $user->save();
        return new UserProfileResource($user);
    }

    public function updatePassword(UserPasswordSaveRequest $request)
    {
        $user = auth()->guard('api')->user();
        $user->password = Hash::make($request->password);
        $user->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function updateEmail(UserEmailSaveRequest $request)
    {
        $user = auth()->guard('api')->user();
        $token = Str::uuid();
        $user->email_token = $token;
        $user->save();
        Mail::to($request->email)->send(new EmailUpdate($token));

        // $request->email

        return new UserProfileResource($user);
    }

    public function updatePhone(UserPhoneSaveRequest $request)
    {
        DB::beginTransaction();
        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $request->phone)
            ->statusPending()
            ->firstOr(function () {
                throw  ValidationException::withMessages(['code' => 'Неверный код или номер телефона']);
            });
        $sms->delete();

        $user = auth()->guard('api')->user();
        $user->phone = $request->phone;
        $user->save();
        DB::commit();
        return new UserProfileResource($user);
        // sms accept
        // SMS ACCEPT
        // sms accept
    }

    public function checkSendSmsNewPhone(UserPhoneSaveRequest $request)
    {
        $phone = $request->phone;
            
        $this->smsService->checkLimitSms($phone);
        
        $code = $this->smsService->generateCode();
        $msg = __('auth.sms_verification') . $code;
        $this->smsService->send($msg, $phone);
  
        SmsVerification::create([
            'code' => $code,
            'status' => SmsVerification::STATUS_PENDING,
            'phone' => $phone
        ]);
        return new MessageResource(__('message.success.sent'));
    }
}
