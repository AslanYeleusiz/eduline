<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\PersonalAdvice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderSaveRequest;
use App\Services\FileService;
use Inertia\Inertia;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $sliders = Slider::with(['advice'])->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/sliders/index', [
            'sliders' => $sliders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personalAdvice = PersonalAdvice::get();
        return Inertia::render('Admin/sliders/Create',[
            'personalAdvice' => $personalAdvice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderSaveRequest $request)
    {
        $slider = new Slider();
        if ($request->hasFile('image')) {
            $images = [
                'ru' => '',
                'kk' => '',
            ];
            foreach ($request->image as $key => $image) {
                if ($key == 'ru') {
                    $images['ru'] = FileService::saveFile($image, Slider::IMAGE_PATH);
                } elseif ( $key == 'kk') {
                    $images['kk'] = FileService::saveFile($image, Slider::IMAGE_PATH);
                }
            }
        }
        $slider->create([
            'image' => $images,
            'link' => $request->link,
            'linkToAdvice' => $request->linkToAdvice,
            'in_app' => $request->in_app,
        ]);
        return redirect()->route('admin.slider.index')->withSuccess('Успешно добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $personalAdvice = PersonalAdvice::get();
        return Inertia::render('Admin/sliders/Edit', [
            'slider' => $slider,
            'personalAdvice' => $personalAdvice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Slider $slider, SliderSaveRequest $request)
    {
        $images = $slider->image;
        if ($request->hasFile('image')) {
            $images = [
                'ru' => '',
                'kk' => '',
            ];
            foreach ($request->image as $key => $image) {
                if ($key == 'ru') {
                    $images['ru'] = FileService::saveFile($image, Slider::IMAGE_PATH);
                } elseif ( $key == 'kk') {
                    $images['kk'] = FileService::saveFile($image, Slider::IMAGE_PATH);
                }
            }
        }
        $slider->update([
            'image' => $images,
            'link' => $request->link,
            'linkToAdvice' => $request->linkToAdvice,
            'in_app' => $request->in_app,
        ]);
        return redirect()->route('admin.slider.index')->withSuccess('Успешно добавлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        foreach ($slider->image as $key => $image) {
            if ($key == 'ru') {
                FileService::deleteFile($image, Slider::IMAGE_PATH);
            } else if ( $key == 'kk') {
                FileService::deleteFile($image, Slider::IMAGE_PATH);
            }
        }
        $slider->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
