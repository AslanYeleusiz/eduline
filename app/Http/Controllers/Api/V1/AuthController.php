<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\LoggedInResource;
use App\Http\Resources\V1\MessageResource;
use App\Models\Role;
use App\Models\User;
use App\Services\V1\AuthCreateTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct(public AuthCreateTokenService $createTokenService)
    {
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
        $roleIds = Role::isGeneral()->select('id')->get()->pluck('id')->toArray();
        $roleId = in_array($request->role_id, $roleIds) ? $request->role_id : Role::DEFAULT_ROLE;
        $user = User::forceCreate(
            [
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'role_id' => $request->input('role_id', Role::DEFAULT_ROLE),
                'password' => Hash::make($request->input('password')),
            ]);
        return new LoggedInResource($this->createTokenService->create($user, config('app.name')));
    }

    public function logout(): MessageResource
    {
        Auth::guard('api')->user()->token()->revoke();
        return new MessageResource(__('message.user.logout'));
    }
}
