<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestDirectionsResource;
use App\Models\TestDirection;
use App\Models\TestLanguage;
use Illuminate\Http\Request;

class TestDirectionController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->header('Accept-Language');
        if($language == 'kk')       $languageId = 1;
        else if($language == 'ru')  $languageId = 2;
        $directions = TestDirection::isActive()
        ->with(['subjects' => fn($query)=>$query->where('language_id', $languageId)])
        ->get();
        foreach($directions as $direction){
            $direction->name = $direction->name[$language];
        }
        return TestDirectionsResource::collection($directions)
        ->additional(['status' => true]);
    }
}
