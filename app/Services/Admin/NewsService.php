<?php

namespace App\Services\Admin;

use App\Models\News;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;

class NewsService
{

    public function handle($news, $request)
    {
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->description;
        $news->news_types_id = $request->news_types_id;
        $news->view = $request->view;
        if (auth()->check()) {
            $news->user_id = auth()->user()->id;
        }
        if ($request->hasFile('image')) {
            $images = [
                'ru' => '',

                'kk' => '',
            ];
            foreach ($request->image as $key => $image) {
                if ($key == 'ru') {
                    $images['ru'] = FileService::saveFile($image, News::IMAGE_PATH);
                } elseif ( $key == 'kk') {
                    $images['kk'] = FileService::saveFile($image, News::IMAGE_PATH);
                }
            }
            $news->image = $images;
        }
        return $news;
    }

    public function save($news, $request)
    {

        $news = $this->handle($news, $request);
        return $news->save();
    }
}
