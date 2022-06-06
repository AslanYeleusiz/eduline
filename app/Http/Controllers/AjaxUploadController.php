<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Models\Material;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;
use Carbon\Carbon;

class AjaxUploadController extends Controller
{
    public function index()
    {
        $sub = MaterialSubject::get();
        $dir = MaterialDirection::get();
        $class = MaterialClass::get();
        return view('pages.materials.materialpublication', compact(['sub', 'dir', 'class']));
    }

    public function upload(Request $request)
    {
        $path = $request->file('file');
        return 'path';
    }
    public function store(Request $request)
    {
        $material = new Material();
        $material -> title = $request -> name;
        $material -> description = $request -> text;
        $material -> user_id = auth()->user()->id;
        $material -> subject_id = $request -> subject;
        $material -> direction_id = $request -> direction;
        $material -> class_id = $request -> class;
        $path = $request->file('file')->store('uploads/file', 'public');
        $material -> file_name = $path;
        $material -> save();
        return redirect()->back()->withSuccess(__('site.Материал сәтті жүктелді'));
    }

}
