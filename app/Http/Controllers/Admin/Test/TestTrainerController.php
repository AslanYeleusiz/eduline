<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\TestTrainer;
use Illuminate\Http\Request;

class TestTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = TestTrainer::paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/Test/Trainers/index', [
            'trainers' => $trainers
        ]);
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
     * @param  \App\Models\TestTrainer  $testTrainer
     * @return \Illuminate\Http\Response
     */
    public function show(TestTrainer $testTrainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestTrainer  $testTrainer
     * @return \Illuminate\Http\Response
     */
    public function edit(TestTrainer $testTrainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TestTrainer  $testTrainer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestTrainer $testTrainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestTrainer  $testTrainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestTrainer $testTrainer)
    {
        //
    }
}
