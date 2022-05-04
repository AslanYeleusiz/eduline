<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function loginShowForm()
    {
        return  view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->route('admin.users.index');
        }
        return redirect()->back()->withErrors(['login' => 'Неправилный логин или пароль']);
    }

    public function logout()
    {
        auth()->logout();
        return Inertia::location(route('loginShow'));
    }
}
