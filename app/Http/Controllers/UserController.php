<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\V1\User\UserEmailSaveRequest;
use App\Http\Requests\Api\V1\User\UserPasswordSaveRequest;
use App\Http\Requests\Api\V1\User\UserPhoneSaveRequest;
use App\Http\Requests\User\UserProfileSaveRequest;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\User\UserProfileResource;
use App\Mail\EmailConfirm;
use App\Mail\EmailUpdate;
use App\Models\SmsVerification;
use App\Models\User;
use App\Services\V1\SmsService;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct(public SmsService $smsService)
    {
    }

    public function updateProfile(UserProfileSaveRequest $request)
    {
        $user = auth()->user();
        $user->iin = $request->iin;
        $user->sex = $request->sex;
        $user->birthday = $request->birthday;
        $user->save();

        return response()->json(['data' => [
            'success' => true,
        ]]);
    }

    public function updatePhone(Request $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        if(strlen($request->phone) > 10){
            $phone = Helper::clearPhoneMask($request->phone);
        }else{
            $phone = $request->phone;
        }
        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $phone)
            ->statusPending()
            ->firstOr(function () {
                throw  ValidationException::withMessages(['code' => 'Неверный код или номер телефона']);
            });
        $sms->delete();

        $user = auth()->user();
        $user->phone = $phone;
        $user->is_phone_verification = 1;
        $user->save();
        DB::commit();

        return response()->json(new MessageResource(__('message.success.updatedPhone')));
    }

    public function checkSendSmsNewPhone(\App\Http\Requests\UserPhoneSaveRequest $request): \Illuminate\Http\JsonResponse
    {
        if(strlen($request->phone) > 10){
            $phone = Helper::clearPhoneMask($request->phone);
        }else{
            $phone = $request->phone;
        }
        $this->smsService->checkLimitSms($phone);
//        $code = 9999;
        $code = $this->smsService->generateCode();
        $msg = __('auth.sms_verification') . $code;
        $this->smsService->send($msg, $phone);

        SmsVerification::create([
            'code' => $code,
            'status' => SmsVerification::STATUS_PENDING,
            'phone' => $phone
        ]);

        return response()->json(['data' => [
            'success' => true,
        ]]);
    }

    public function checkSendSmsNewPassword(\App\Http\Requests\UserPassSendCodeRequest $request)
    {
        $user = auth()->user();
        $phone = $user->phone;

        $this->smsService->checkLimitSms($phone);

//        $code = 9999;
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

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $phone = $user->phone;
        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $phone)
            ->statusPending()
            ->firstOr(function () {
                throw  ValidationException::withMessages(['code' => 'Неверный код или номер телефона']);
            });
        $sms->delete();

        $user->password = Hash::make($request->password);
        $user->real_password = $request->password;
        $user->save();
        return response()->json(new MessageResource(__('message.success.updatedPassword')));
    }

    public function updateEmail(UserEmailSaveRequest $request)
    {
        $user = auth()->user();

        $token = Str::uuid();
        $user->email_token = $token;
        $user->save();
        $message = new EmailConfirm($request->email);
        Mail::send('mail.emailUpdate', [
            'email' => $request->email,
            'token' => $token
        ], function($message) use ($email){
            $message->to($request->email, '')->subject(__('site.Почтаңызды растаңыз'));
            $message->from('admin@ust.kz', 'Eduline.kz');
        });
        return;
    }

    public function linkToConfirmEmail(Request $request)
    {
        $email = $request->email;
        $user = auth()->user();

        $token = Str::uuid();
        $user->email_token = $token;
        $user->save();
        Mail::send('mail.emailConfirm', [
            'email' => $request->email,
            'token' => $token
        ], function($message) use ($email){
            $message->to($email)->subject(__('site.Почтаңызды растаңыз'));
            $message->from('admin@ust.kz', 'Eduline.kz');
        });
        return $request->email;
    }

    public function confirmEmail($email, $token) {
        $user = User::where('email', $email)->where('email_token',$token)->firstOrFail();
        $user->is_email_verified = 1;
        $user->save();

        return redirect()->route('index')->withSuccess('Успешно подтверждён!');
    }
}
