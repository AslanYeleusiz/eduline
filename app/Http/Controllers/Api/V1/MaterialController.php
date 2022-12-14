<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\MaterialCommentSaveRequest;
use App\Http\Resources\V1\Material\MaterialResource;
use App\Http\Resources\V1\Material\MaterialsResource;
use App\Http\Resources\V1\MessageResource;
use App\Models\Material;
use App\Models\SendingMaterialJournal;
use App\Services\V1\MaterialCertificateGenerateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = Material::orderBy('id')
        ->isActive()
        ->with('user', 'subject', 'direction', 'class')
        ->paginate($request->input('per_page', 20));

        return MaterialsResource::collection($materials)->additional(['status' => true]); 
    }


    public  function show($id)
    {
        $material = Material::orderBy('id')
        ->isActive()
        ->with('user', 'subject', 'direction', 'class')
        ->findOrFail($id);
        $material->increment('view');
        return new MaterialResource($material); 
    }
    
    public function sendToJournal($id)
    {
        $material = Material::isActive()->findOrFail($id);
        $user = auth()->guard('api')->user();
        $materialJournal = new SendingMaterialJournal();
        $materialJournal->user_id = $user->id;
        $materialJournal->material_id = $material->id;
        $materialJournal->save();
        return new MessageResource('Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң сізге хабарласады');
    } 


    public function materialCommentSave($id, MaterialCommentSaveRequest $request)
    {
        $material = Material::findOrFail($id);
        $user = auth()->guard('api')->user();
        $material->comments()->create([
            'user_id' => $user->id,
            'text' => $request->text,
            'comment_id' => $request->comment_id,
        ]);
        return new MessageResource(__('message.success.saved'));

    }

    public function download($id)
    {
        $material = Material::findOrFail($id);
        return response()->download(Storage::disk('public')->path(Material::FILE_PATH . '/1654222118.docx'));
        if(empty($material->created_at)) {
            throw new NotFoundHttpException(__('errors.not_found'));
        }
    }

    public function getCertificate($id)
    {
        $material = Material::with('user')->findOrFail($id);

        $certificateName = MaterialCertificateGenerateService::getCertificate($material);
        return response()->download(Storage::disk('public')->path(Material::CERTIFICATE_PATH . '/'. $certificateName));
    }

    public function getCertificateThankLetter($id)
    {
        $material = Material::findOrFail($id);
        $certificateName = MaterialCertificateGenerateService::getThankLetter($material);
        return response()->download(Storage::disk('public')->path(Material::CERTIFICATE_PATH . '/'. $certificateName));
    }

    public function getCertificateHonor($id)
    {
        $material = Material::findOrFail($id);
        $certificateName = MaterialCertificateGenerateService::getHonor($material);
        return response()->download(Storage::disk('public')->path(Material::CERTIFICATE_PATH . '/'. $certificateName));
    }
}
