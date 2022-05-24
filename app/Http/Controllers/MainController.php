<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;
use App\Models\SmsVerification;
use App\Services\V1\SmsService;

class MainController extends Controller
{
    public function __construct(public SmsService $smsService)
    {
    }

    public function index()
    {
        return view('welcome');
    }
    
    // public function calc()
    // {
        // $news = News::with('newsType')
        //     ->withCount('comments')
        //     ->orderByDesc('view')
        //     ->withExists('thisUserSaved as is_saved')
        //     ->paginate($request->input('per_page', 20))
        //     ->appends($request->except('page'));
    //     return view('pages.calc');
    // }

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

    public function attestation(Request $req)
    {
        if($req) {
            $phone = $req->input('phone');
            $array = ["+","-"," ","(", ")"];
            $phone = str_replace($array, "", $phone);
            $msg = "Қосымшаны жүктеу сілтемесі: https://clck.ru/hcdEa";
            $this->smsService->send($msg, $phone);
        }
        return view('pages.attestation');
    }

    public function calculator(Request $req)
    {
        if($req) {
            $phone = $req->input('phone');
            $array = ["+","-"," ","(", ")"];
            $phone = str_replace($array, "", $phone);
            $msg = "Қосымшаны жүктеу сілтемесі: https://clck.ru/hcdEa";
            $this->smsService->send($msg, $phone);
        }
        return view('pages.calculator');
    }
}
