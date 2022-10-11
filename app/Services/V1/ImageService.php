<?php


namespace App\Services\V1;


use App\Exceptions\ErrorException;
use App\Helpers\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagine\Image\ImageInterface;
use Symfony\Component\HttpFoundation\Response;

class ImageService
{

    public $width;
    public $height;

    public function save($isFile, $path, $dbPhotoName, $photo, $newPhoto)
    {
        if ($isFile) {
            $photo = $this->saveImage($newPhoto, $path, $this->width, $this->height);
            if (empty($photo)) {
                $errors = ['photo' => [__('errors.user.photo_format')]];
                throw new ErrorException(__('errors.given_data_invalid'), Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
            }
            $photo = $path . $photo;
        } else {
            if ($dbPhotoName != $photo) {
                $photo = '';
            }
        }

        if ($dbPhotoName && $isFile && ($dbPhotoName != $photo)) {
            if (Storage::exists($dbPhotoName)) {
                Storage::delete($dbPhotoName);
                @unlink($dbPhotoName);
            }
        }
        return $photo;
    }
    public function saveImage($photo, $path, $width = '', $height ='')
    {
        Storage::makeDirectory($path);
        $formatImage = ['jpg', 'jpeg', 'png', 'jfif', 'svg'];

        $format = $photo->getClientOriginalExtension();
        if (in_array(strtolower($format), $formatImage)) {
            $name = time() . Str::random(5) . '.' . strtolower($format);
            $photo->storeAs($path, $name, 'public');
            if (!empty($width)) {
                $this->resizeCropImage($path . $name, $width, $height);
            }
            return $name;
        } else {
            return false;
        }
    }

    public function resizeCropImage($img, $width, $height)
    {
        $img = storage_path() . '/app/public/' .$img;
        $imagine = new \Imagine\Gd\Imagine();
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        ini_set('memory_limit', '1024M');
        $imagine->open($img)
            ->thumbnail($size, $mode)
            ->save($img, [  'quality' => 100]);
    }
}
