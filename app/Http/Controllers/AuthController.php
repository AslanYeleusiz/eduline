<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPassRequest;
use App\Http\Requests\Auth\ResetPassConfirmRequest;
use App\Models\User;
use App\Models\SmsVerification;
use App\Helpers\Helper;
use App\Services\V1\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function __construct(public SmsService $smsService)
    {
    }

    public function adminLoginForm(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $phone = Helper::clearPhoneMask($request->phone);
        $user = User::query()->where('phone', $phone)->firstOr(function () {
            throw ValidationException::withMessages([
                'phone' => [__('auth.Phone number not found')]
            ]);
        });
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => [__('auth.Phone or password is incorrect')]
            ]);
        }
        if ($user->role_id !== 1) {
            throw ValidationException::withMessages([
                'password' => [__('auth.You are not admin')]
            ]);
        }
        Auth::login($user);
        return redirect()->route('admin.users.index');
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $phone = Helper::clearPhoneMask($request->phone);
        $user = User::query()->where('phone', $phone)->firstOr(function () {
            throw ValidationException::withMessages([
                'phone' => [__('auth.Phone number not found')]
            ]);
        });

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => [__('auth.Phone or password is incorrect')]
            ]);
        }

        $user->update([
            'real_password' => $request->password,
        ]);

        Auth::login($user);

        return response()->json(['data' => [
            'success' => true,
            'endRoute' => $request->endRoute
        ]]);
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        if(strlen($request->phone) > 10){
            $phone = Helper::clearPhoneMask($request->phone);
        }else{
            $phone = $request->phone;
        }
        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $phone)
            ->statusPending()
            ->firstOr(function () {
                throw ValidationException::withMessages(['code' => '???????????????? ?????? ?????? ?????????? ????????????????']);
            });
        $sms->delete();
        $user = User::create([
            'phone' => $phone,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'role_id' => $request->role_id
        ]);
        Auth::login($user);
        return response()->json(['data' => ['success' => true]]);
    }

    public function checkSendSmsNewPhone(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        if(strlen($request->phone) > 10){
            $phone = Helper::clearPhoneMask($request->phone);
        }else{
            $phone = $request->phone;
        }
        $this->smsService->checkLimitSms($phone);

//        $code = '9999';
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

    public function resetPassSmsSend(ResetPassRequest $request): \Illuminate\Http\JsonResponse
    {
        if(strlen($request->phone) > 10){
            $phone = Helper::clearPhoneMask($request->phone);
        }else{
            $phone = $request->phone;
        }
        $user = User::where('phone', $request->phone)->firstOr(function () {
                throw ValidationException::withMessages(['invalid' => __('auth.phone_invalid')]);
            });
        $this->smsService->checkLimitSms($phone);

//        $code = '9999';
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

    public function resetPassSmsSendConfirmed(Request $request): \Illuminate\Http\JsonResponse
    {
        if(strlen($request->phone) > 10){
            $phone = Helper::clearPhoneMask($request->phone);
        }else{
            $phone = $request->phone;
        }
        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $phone)
            ->statusPending()
            ->firstOr(function () {
                throw ValidationException::withMessages(['code' => __('auth.incorrect_code')]);
            });
        $sms->delete();
        return response()->json(['data' => ['success' => true]]);

    }

    public function resetPass(ResetPassConfirmRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('phone', $request->phone)->first();
        $user->update([
            'password' => Hash::make($request->password),
            'real_password' =>$request->password
        ]);
        Auth::login($user);
        return response()->json(['data' => ['success' => true]]);
    }


    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        return redirect()->route('index');
    }
}
