<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;
use App\Models\SmsVerification;
use App\Models\PersonalAdvice;
use App\Models\PersonalAdviceOrder;
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
        $user->is_email_verified = 1;
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

            return redirect()->route('attestation')->withSuccess(__('site.SMS жіберілді'));
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
            if($this->smsService->send($msg, $phone))
                return redirect()->route('calculator')->withSuccess(__('site.SMS жіберілді'));
            else
                return redirect()->route('calculator')->withErrors(__('site.Қате! SMS жіберілмеді.'));
        }
        else
            return view('pages.calculator');
    }

    public function consultations()
    {
        $consultations = PersonalAdvice::where('is_active', true)->get();
        foreach ($consultations as $con) {
            $con->lat_title = $con->slug($con->title);
        }
        return view('pages.consultations', ['consultations' => $consultations]);
    }

    public function consultation($slug, Request $request)
    {
        $id = $request->id;
        $consultation = PersonalAdvice::where('id',$id)->where('is_active',true)->firstOrFail();
        return view('pages.consultation', ['consultation' => $consultation]);
    }

    public function send(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;

        PersonalAdviceOrder::create([
            'personal_advice_id' => $id,
            'full_name' => $name,
            'phone' => $phone,
        ]);

        return redirect()->route('consultation', ['id' => $id])->withSuccess(__('site.Өтінішіңіз жіберілді'));
    }
}
