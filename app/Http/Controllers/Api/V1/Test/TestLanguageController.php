<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestLanguagesResource;
use App\Models\TestLanguage;
use Illuminate\Http\Request;

class TestLanguageController extends Controller
{
    public function index()
    {
        return TestLanguagesResource::collection(TestLanguage::get())
        ->additional(['status' => true]);
    }
}
