<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Services\Admin\TestTrainerService;
use App\Models\TestTrainer;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TrainerRequest;
use Inertia\Inertia;

class TestTrainerController extends Controller
{
    public $trainerService;
    public function __construct(TestTrainerService $trainerService)
    {
        $this->trainerService = $trainerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return Inertia::render('Admin/Test/Trainers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainerRequest $request)
    {
        $trainer = new TestTrainer();
        $this->trainerService->save($trainer, $request);
        return redirect()->route('admin.test.trainers.index')->withSuccess('Успешно добавлено');
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
    public function destroy($id)
    {
        $testTrainer = TestTrainer::findOrFail($id);
        $testTrainer->delete();
        return redirect()->route('admin.test.trainers.index')->withSuccess('Успешно удалено');
    }
}
