<?php

namespace App\Helpers;

class Image
{
    public static function imgBase64Encode($img)
    {
        if (!$img) {
            return '';
        }
        return 'data:image/jpg;base64,' . base64_encode($img);
    }

    public static function getImgHexCode($image){
        $path_name    = $image->getPathname();

        $img_code     = file_get_contents($path_name);
        $img_code     = unpack("H*hex", $img_code);
        $img_code     = "0x" . $img_code['hex'];

        return $img_code;
    }
    public static function resizeCropImage($img, $width, $height)
    {
        $img = storage_path() . '/app/public/' .$img;
        $imagine = new \Imagine\Gd\Imagine();
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;

        $imagine->open($img)
            ->thumbnail($size, $mode)
            ->save($img);
    }

    public static function saveImage($photo, $path, $width = '', $height ='')
    {
        $formatImage = ['jpg', 'jpeg', 'png', 'jfif'];

        $format = $photo->getClientOriginalExtension();
        if (in_array(strtolower($format), $formatImage)) {
            $name = time() . rand(1, 9) . '.' . $format;
            // public/.img/user/12365841829 9 .jpg
            $photo->storeAs($path, $name);
            if (!empty($width)) {
                self::resizeCropImage($path . $name, $width, $height);
            }
            return $name;
        } else {
            return false;
        }
    }

}
