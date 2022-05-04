<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Material\MyMaterialDeleteRequest;
use App\Http\Requests\Api\V1\Material\MyMaterialSaveRequest;
use App\Http\Resources\V1\Material\MyMaterialResource;
use App\Http\Resources\V1\MessageResource;
use App\Models\Material;
use App\Models\OrderUpdateMaterial;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MyMaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = Material::where('user_id', auth()->guard('api')->user()->id)
        ->isActive()
        ->with('user', 'subject', 'direction', 'class')
        ->paginate($request->input('per_page', 20));

        return MyMaterialResource::collection($materials)->additional(['status' => true]);
    }

    public function show($id)
    {
        $material = Material::where('user_id', auth()->guard('api')->user()->id)
        ->isActive()
        ->with('user', 'subject', 'direction', 'class')
        ->findOrFail($id);
        return new MyMaterialResource($material);
    }

    
    public function update($id,MyMaterialSaveRequest $request)
    {

        $material = Material::where('user_id', auth()->guard('api')->user()->id)
        ->isActive()
        ->findOrFail($id);
        $updateMaterial = new OrderUpdateMaterial();
        $updateMaterial->title = $request->title;
        $updateMaterial->description = $request->description;
        $updateMaterial->subject_id = $request->subject_id;
        $updateMaterial->direction_id = $request->direction_id;
        $updateMaterial->class_id = $request->class_id;  
        $updateMaterial->material_id = $material->id;  
        $updateMaterial->save();

        // delete update count column
        return new MessageResource('Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң сізге хабарласады');
    }

    public function store(MyMaterialSaveRequest $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
        if (!$request->hasFile('file')) {
            throw new ValidationException(['file' => 'Файл не загружен']);
        }
        
        $user = auth()->guard('api')->user();
        $material = new Material();
        $material->title = $request->title;
        $material->description = $request->description;
        $material->file_name = FileService::saveFile($request->file('file'), FileService::generateMaterialPath());
        $material->subject_id = $request->subject_id;
        $material->direction_id = $request->direction_id;
        $material->class_id = $request->class_id;  
        $material->user_id = $user->id;  
        $material->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function destroy($id, MyMaterialDeleteRequest $request)
    {
        $material = Material::where('user_id', auth()->guard('api')->user()->id)
        ->isActive()
        ->findOrFail($id);
        $material->comment_when_deleted = $request->comment_when_deleted;
        $material->save();
        $material->delete();
        return new MessageResource(__('message.success.deleted'));
    }
}
