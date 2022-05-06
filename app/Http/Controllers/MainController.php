<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function calc()
    {
        // $news = News::with('newsType')
        //     ->withCount('comments')
        //     ->orderByDesc('view')
        //     ->withExists('thisUserSaved as is_saved')
        //     ->paginate($request->input('per_page', 20))
        //     ->appends($request->except('page'));
        return view('pages.calc');
    }

    public function emailUpdate($email, $token)
    {
        if(User::where('email', $email)->exists()) {
            throw new ErrorException('Email уже используется');
        }
        $user = User::where('email_token', $token)->firstOrFail();
        $user->email = $email;
        $user->save();
        return redirect()->route('index')->withSuccess('Успешно изменено');
    }
}
