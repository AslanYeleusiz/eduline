<?php

namespace App\Http\Controllers;

// use App\Models\News;
// use App\Models\Option;
// use App\Models\Product;
// use App\Models\Ref;
// use App\Models\Review;
// use App\Models\TrainingFile;
// use App\Models\TrainingMaterial;
// use App\Models\TrainingVideo;
// use App\Models\Transaction;
// use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
// use RecursiveArrayIterator;
// use RecursiveIteratorIterator;

class PageController extends Controller
{
    function set_locale($locale){
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }

}
