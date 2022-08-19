<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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

        Auth::login($user);

        return response()->json(['data' => [
            'success' => true,
            'endRoute' => $request->endRoute
        ]]);
    }

    /**
     * @throws ValidationException
     */
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $phone = Helper::clearPhoneMask($request->phone);
        $user = User::create([
            'phone' => $phone,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
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
