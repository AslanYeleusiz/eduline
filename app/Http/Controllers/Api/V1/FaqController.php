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

        $languageId = $request->language_id ? $request->language_id : 1;

        $faqs = Faq::latest()->get();
        foreach($faqs as $faq){
            if($languageId == 1){
                $faq->question = $faq->question['kk'];
                $faq->answer = $faq->answer['kk'];
            }

            else if($languageId == 2){
                $faq->question = $faq->question['ru'];
                $faq->answer = $faq->answer['ru'];
            }

        }
        return FaqResource::collection($faqs)->additional([
            'status' => true
        ]);
    }
}
