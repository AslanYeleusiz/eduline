<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Services\V1\MaterialCertificateGenerateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MaterialController extends Controller
{
    public function __construct(public MaterialCertificateGenerateService $materialCertificateGenerateService)
    {

    }
    public function download($id)
    {
        $material = Material::findOrFail($id);
        $material->increment('download');
        if(empty($material->created_at)) {
            throw new NotFoundHttpException(__('errors.not_found'));
        }
        return Storage::disk('public')->download($material->file_name);
    }


    public function getCertificate($id)
    {
        $material = Material::with('user')->findOrFail($id);

        $certificateName = MaterialCertificateGenerateService::getCertificate($material);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . '/'. $certificateName);
    }

    public function getCertificateThankLetter($id)
    {
        $material = Material::findOrFail($id);
        $certificateName = MaterialCertificateGenerateService::getThankLetter($material);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . '/'. $certificateName);
    }

    public function getCertificateHonor($id)
    {
        $material = Material::findOrFail($id);
        $certificateName = MaterialCertificateGenerateService::getHonor($material);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . '/'. $certificateName);
    }
}
