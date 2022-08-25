<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {

        $language = $request->header('Accept-Language');
        if (!$language) {
            return new ErrorException('Язык не выбрано');
        }

        $faqs = Faq::latest()->get();
        foreach($faqs as $faq){
            $faq->question = $faq->question[$language];
            $faq->answer = $faq->answer[$language];
        }
        return FaqResource::collection($faqs)->additional([
            'status' => true
        ]);
    }
}
