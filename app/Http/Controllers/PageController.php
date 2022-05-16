<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function set_locale($locale): \Illuminate\Http\RedirectResponse
    {
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function profile(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Профиль');
        $user = Auth::user();
        return view('pages.profile.index', compact(['pageName', 'user']));
    }

    public function subscription(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Жазылым');
        return view('pages.subscription.index', compact(['pageName']));
    }

    public function materials(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Материалдар');
        return view('pages.materials.index', compact('pageName'));
    }

    public function myMaterials(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Менің материалдарым');
        return view('pages.materials.my-materials', compact('pageName'));
    }
}
