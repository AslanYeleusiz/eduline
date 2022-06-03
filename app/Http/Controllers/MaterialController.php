<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MaterialController extends Controller
{
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
        $material = Material::findOrFail($id);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . 'certificate.jpg');
    }
    
    public function getCertificateThankLetter($id)
    {
        $material = Material::findOrFail($id);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . 'thank-letter.jpg');
    }
    
    public function getCertificateHonor($id)
    {
        $material = Material::findOrFail($id);
        return Storage::disk('public')->download(Material::CERTIFICATE_PATH . 'honor.jpg');
    }
}
