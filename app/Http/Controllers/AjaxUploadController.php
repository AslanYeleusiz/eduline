<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxUploadController extends Controller
{
    public function index() {
       return view('pages.materials.materialpublication');
    }
    public function action(Request $request) {
       $validation = Validator::make($request->all(), [
           'select-file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
       ]);
        if($validation->passes()){
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$new_name);
            return response();
        }
        else{
            return response();
        }
        return responce()->json ("OK");
}


}
