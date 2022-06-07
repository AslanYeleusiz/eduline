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
        $languageId = $request->language_id ?? TestLanguage::first()->id;
        if (!$languageId) {
            return new ErrorException('Язык не выбрано');
        }
        $directions = TestDirection::isActive()
        ->with(['subjects' => fn($query)=>$query->where('language_id', $languageId)])
        ->get();

        return TestDirectionsResource::collection($directions)
        ->additional(['status' => true]);;
    }
}
