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
        if(empty($material->created_at)) {
            throw new NotFoundHttpException(__('errors.not_found'));
        }
        return Storage::disk('public')->download($material->filePath);
    }

    
    public function getCertificate($id)
    {
        $material = Material::with('user')->findOrFail($id);

        $certificateName = MaterialCertificateGenerateService::getCertificate($material);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . '/'. $certificateName) ;
    }
    
    public function getCertificateThankLetter($id)
    {
        $material = Material::findOrFail($id);
        $certificateName = MaterialCertificateGenerateService::getThankLetter($material);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . 'thank-letter.jpg');
    }
    
    public function getCertificateHonor($id)
    {
        $material = Material::findOrFail($id);
        $certificateName = MaterialCertificateGenerateService::getHonor($material);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . '/'. $certificateName) ;
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . 'honor.jpg');
    }
}
