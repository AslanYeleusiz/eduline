<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestDirectionSaveRequest;
use App\Models\TestDirection;
use App\Models\TestSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestDirectionController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $isActive = $request->is_active;
        $directions = TestDirection::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
        ->when($isActive, fn ($query) => $query->where('is_active', ($isActive == 'true') ? 1 : 0))
        ->get();
        return Inertia::render('Admin/Test/Directions/Index', compact('directions'));
    }
    
    public function edit(TestDirection $direction)
    {
        $subjects = TestSubject::with('language')->orderBy('name')->get();
        $direction->load('subjects');
        $subject_ids = $direction->subjects->pluck('id')->toArray();
        return Inertia::render('Admin/Test/Directions/Edit',compact('direction', 'subjects', 'subject_ids'));
    }
    
    public function update(TestDirection $direction, TestDirectionSaveRequest $request)
    {
        $direction->name = $request->name;
        $direction->is_active = $request->is_active == 'true';
        $direction->save();
        $direction->subjects()->sync($request->input('subject_ids', []));
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $subjects = TestSubject::with('language')->orderBy('name')->get();
        return Inertia::render('Admin/Test/Directions/Create', compact('subjects'));
    }

    public function store(TestDirectionSaveRequest $request)
    {
        $direction = new TestDirection();
        $direction->name = $request->name;
        $direction->is_active = $request->is_active == 'true';
        $direction->save();
        $direction->subjects()->sync($request->input('subject_ids', []));
        return redirect()->route('admin.test.directions.index')->withSuccess('Успешно добавлено');
    }
    
    public function destroy(TestDirection $direction)
    {
        $direction->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
