<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ConsultationController extends Controller
{
    public function index($id)
    {
        $material = Material::findOrFail($id);
        if(empty($material->created_at)) {
            throw new NotFoundHttpException('errors.not_found');
        }
        return Storage::disk('public')->download($material->filePath);
    }
}
