<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Models\Material;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:ppt,pptx,doc,docx,pdf|max:10485760'
        ]);
        if($validator->fails()){
            return 0;
        };
        $file = $request->file('file');
        $fileName = time() . "_" . Str::random(5) .'.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('uploads/file', $file, $fileName);
        return $fileName;
    }
    public function store(Request $request)
    {
        if($request->fileName == 0){
            return redirect()->back()->withErrors(__('site.Файл не был соответствован требованию сайта. Пожалуйста проверьте правильность файла.'));
        }
        $material = new Material();
        $material -> title = $request -> name;
        $material -> description = $request -> text;
        $material -> user_id = auth()->user()->id;
        $material -> subject_id = $request -> subject;
        $material -> direction_id = $request -> direction;
        $material -> class_id = $request -> class;
        $material -> file_name = 'uploads/file/'.$request->fileName;
        $material -> save();
        return redirect()->route('materials.myMaterials')->withSuccess(__('site.Материал сәтті жүктелді'));
    }

}
