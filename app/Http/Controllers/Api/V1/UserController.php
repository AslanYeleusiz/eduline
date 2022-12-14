<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserEmailSaveRequest;
use App\Http\Requests\Api\V1\User\UserPasswordSaveRequest;
use App\Http\Requests\Api\V1\User\UserPhoneChangeSendCodeRequest;
use App\Http\Requests\Api\V1\User\UserPhoneSaveRequest;
use App\Http\Requests\Api\V1\User\UserProfileSaveRequest;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\User\UserProfileResource;
use App\Mail\EmailUpdate;
use App\Models\SmsVerification;
use App\Models\User;
use App\Services\FileService;
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
//        $user = User::find(40);
        $user->load('subscription.subscription');
        return new UserProfileResource($user);
    }



    public function updateProfile(UserProfileSaveRequest $request)
    {
        $user = auth()->guard('api')->user();
        $user->full_name = $request->full_name;
        if ($request->has('place_work')) {
            $user->place_work = $request->place_work;
        }
        if ($request->has('birthday')) {
            $user->birthday = $request->birthday;
        }
        if ($request->has('sex')) {
            $user->sex = $request->sex;
        }
        if ($request->hasFile('avatar')) {
            $user->avatar = FileService::saveFile($request->file('avatar'), User::IMAGE_PATH, $user->avatar);
        }
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
        // Mail::to($request->email)->send(new EmailUpdate($token, $user->email));


        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: Eduline.kz';
        mail($request->email, __('site.???????????????????? ????????????????'), view('mail.emailUpdate')
            ->with([
                'token' => $token,
                'email' => $user->email,
            ]), implode("\r\n", $headers));

        return new MessageResource(__('message.success.check_your_email'));

        // return new UserProfileResource($user);
    }

    public function updatePhone(UserPhoneSaveRequest $request)
    {
        DB::beginTransaction();
        $sms = SmsVerification::where('code', $request->code)
            ->where('phone', $request->phone)
            ->statusPending()
            ->firstOr(function () {
                return new MsgStatusFalseResource(__('errors.the_code_or_number_incorrect'));
            });
        $sms->delete();

        $user = auth()->guard('api')->user();
        $user->phone = $request->phone;
        $user->save();
        DB::commit();
        return new UserProfileResource($user);
    }

    public function checkSendSmsNewPhone(UserPhoneChangeSendCodeRequest $request)
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
