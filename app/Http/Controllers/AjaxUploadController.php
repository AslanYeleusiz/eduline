<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\File;

class AjaxUploadController extends Controller
{
    public function index() {
       return view('pages.materials.materialpublication');
    }
    public function upload(Request $request) {
        $path = $request->file('file')->store('uploads', 'public');
        return view('pages.materials.materialpublication', ['path'=>$path]);
    }
}
