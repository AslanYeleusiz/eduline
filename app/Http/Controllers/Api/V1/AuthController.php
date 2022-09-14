<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Auth\RegisterSendSmsCodeRequest;
use App\Http\Requests\Api\V1\Auth\ResetPasswordSaveRequest;
use App\Http\Requests\Api\V1\Auth\ResetPasswordVerifyCodeRequest;
use App\Http\Requests\Api\V1\User\UserAccountDestroyRequest;
use App\Http\Resources\V1\LoggedInResource;
use App\Http\Resources\V1\MessageResource;
use App\Models\Role;
use App\Models\SmsVerification;
use App\Models\User;
use App\Models\RemoteUsers;
use App\Services\V1\AuthCreateTokenService;
use App\Services\V1\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    private $createTokenService;
    private $smsService;
    public function __construct(AuthCreateTokenService $createTokenService,SmsService $smsService
    )
    {
        $this->createTokenService = $createTokenService;
        $this->smsService = $smsService;
    }

    public function login(LoginRequest $request)
    {
        $login = $request->input('login');
        $user = User::where('phone', $login)->orWhere('email', $login)->first();
        if (!$user) {
            throw new ErrorException(
                __('errors.user.not_found'),
                Response::HTTP_NOT_FOUND,
            );
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            throw new ErrorException(
                __('errors.given_data_invalid'),
                Response::HTTP_UNPROCESSABLE_ENTITY,
                ['email_or_password' => [__('errors.user.email_or_password')]]
            );
        }
        return new LoggedInResource($this->createTokenService->create($user, config('app.name')));
    }

    public function register(RegisterRequest $request): LoggedInResource
    {
       $smsVerification = $this->checkCode($request->phone, $request->code);

        DB::beginTransaction();
        $smsVerification->status = SmsVerification::STATUS_VERIFIED;
        $smsVerification->save();
        $roleIds = Role::isGeneral()->select('id')->get()->pluck('id')->toArray();
        $roleId = in_array($request->role_id, $roleIds) ? $request->role_id : Role::DEFAULT_ROLE;
        $user = User::forceCreate(
            [
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'role_id' => $roleId,
                // 'role_id' => $request->input('role_id', Role::DEFAULT_ROLE),
                'password' => Hash::make($request->input('password')),
            ]
        );
        DB::commit();
        return new LoggedInResource($this->createTokenService->create($user, config('app.name')));
    }

    public function logout(): MessageResource
    {
        Auth::guard('api')->user()->token()->revoke();
        return new MessageResource(__('message.user.logout'));
    }

    public function destroyAccount(UserAccountDestroyRequest $request): MessageResource
    {
        $user = auth()->guard('api')->user();
        RemoteUsers::create([
            'full_name' => $user->full_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => $user->real_password,
            'role_id' => $user->role_id,
            'text' => $request->text,
        ]);
        $user->delete();
        return new MessageResource(__('message.user.logout'));
    }

    public function registerSendSmsCode(RegisterSendSmsCodeRequest $request)
    {
        $phone = $request->phone;
        $this->sendSms($phone);
        return new MessageResource(__('message.success.sent'));
    }

    public function resetPasswordSendSmsCode(Request $request)
    {
        $user = User::phoneBy($request->phone)->firstOrFail();
        $this->sendSms($request->phone);
        return new MessageResource(__('message.success.sent'));
    }

    public function resetPasswordVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        $phone = $request->phone;

        $smsVerification = $this->checkCode($request->phone, $request->code);
        DB::beginTransaction();
        $smsVerification->status = SmsVerification::STATUS_VERIFIED;
        $smsVerification->save();
        $hash = Str::random(10);
        Cache::put("password_reset_hash/$phone", $hash, 120);
        return response()->json([
            'data' => [
                'hash' => $hash
            ],
            'status' => true
        ]);
    }

    public function resetPassword(ResetPasswordSaveRequest $request)
    {
        $phone = $request->phone;
        $value = Cache::get("password_reset_hash/$phone");

        if($value != $request->hash) {
            throw new ErrorException('Хеш қате');
        }
        $user = User::phoneBy($request->phone)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();
        return new MessageResource(__('message.success.saved'));
    }

    private function sendSms($phone)
    {
//        $code = $phone % 10000;
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
    }

    private function checkCode($phone, $code)
    {
        $smsVerification = SmsVerification::phoneBy($phone)
            ->statusPending()
            ->where('code', $code)
            ->first();
        if (empty($smsVerification)) {
            throw new ErrorException(__('admin.the_code_or_number_incorrect'), 404);
        }
        return $smsVerification;
    }


}
