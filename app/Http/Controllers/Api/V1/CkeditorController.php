<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CkeditorController extends Controller
{
    public $imageService;
    private $path = 'ckeditor/month-';
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function uploadImage(Request $request)
    {
        Log::channel('debug')->warning('file' . json_encode($request->hasFile('upload')));
        $path = $this->path . date('m') . '/';
        $image = $this->imageService->save($request->hasFile('upload'), $path, '', '', $request->file('upload'));
        return response()->json(
                 ['url' => config('app.url').Storage::url($image)],
        );
    }
}
