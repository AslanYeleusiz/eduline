<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestTrainer;
use App\Models\TestLanguage;
use App\Http\Resources\V1\Test\TrainerResource;


class TestTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $languageId = $request->language_id ?? TestLanguage::first()->id;
        if (!isset($languageId)) {
            return new ErrorException('Язык не выбрано');
        }
        $trainers = TestTrainer::isActive()->get();

        foreach($trainers as $trainer){
            if($languageId == 1){
                $trainer->subject = $trainer->subject['kk'];
                $trainer->description = $trainer->description['kk'];
            }
            else if($languageId == 2){
                $trainer->subject = $trainer->subject['ru'];
                $trainer->description = $trainer->description['ru'];
            }
        }

        return TrainerResource::collection($trainers)->additional(['status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $languageId = $request->language_id ?? TestLanguage::first()->id;
        if (!isset($languageId)) {
            return new ErrorException('Язык не выбрано');
        }
        $trainers = TestTrainer::firstOrFail($request->id);

        if($languageId == 1){
            $trainer->subject = $trainer->subject['kk'];
            $trainer->description = $trainer->description['kk'];
        }
        else if($languageId == 2){
            $trainer->subject = $trainer->subject['ru'];
            $trainer->description = $trainer->description['ru'];
        }
        return TrainerResource::collection($trainers)->additional(['status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
