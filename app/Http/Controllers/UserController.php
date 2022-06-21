<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\V1\User\UserEmailSaveRequest;
use App\Http\Requests\Api\V1\User\UserPasswordSaveRequest;
use App\Http\Requests\Api\V1\User\UserPhoneSaveRequest;
use App\Http\Requests\Api\V1\User\UserProfileSaveRequest;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\User\UserProfileResource;
use App\Mail\EmailConfirm;
use App\Mail\EmailUpdate;
use App\Models\SmsVerification;
use App\Models\User;
use App\Services\V1\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $request->phone)
            ->statusPending()
            ->firstOr(function () {
                throw  ValidationException::withMessages(['code' => 'Неверный код или номер телеф
                .она']);
            });
        $sms->delete();

        $user = auth()->user();
        $user->phone = $request->phone;
        $user->save();
        DB::commit();

        return response()->json(['data' => [
            'success' => true,
        ]]);
    }

    public function checkSendSmsNewPhone(\App\Http\Requests\UserPhoneSaveRequest $request): \Illuminate\Http\JsonResponse
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

        return response()->json(['data' => [
            'success' => true,
        ]]);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function updateEmail(UserEmailSaveRequest $request)
    {
        $user = auth()->user();

        $token = Str::uuid();
        $user->email_token = $token;
        $user->save();
        $message = new EmailConfirm($request->email);
        mail($request->email, 'Please confirm email address', view('mail.emailUpdate')
                ->with([
                    'token' => $token,
                    'email' => $request->email,
                ]));
        return;
    }

    public function linkToConfirmEmail(Request $request)
    {
        Mail::to($request->email)->send(new EmailConfirm($request->email));

        return $request->email;
    }

    public function confirmEmail($email) {
        $user = User::where('email', $email)->first();
        $user->is_email_verified = 1;
        $user->save();

        return redirect()->route('index')->withSuccess('Успешно подтверждён!');
    }
}
