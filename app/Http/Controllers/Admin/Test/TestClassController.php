<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestClassSaveRequest;
use App\Models\TestClass;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestClassController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;

        $classes = TestClass::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
            ->orderBy('name')
            ->get();
        return Inertia::render('Admin/Test/Classes/Index', [
            'classes' => $classes
        ]);
    }

    public function edit(TestClass $class)
    {
        return Inertia::render('Admin/Test/Classes/Edit', [
            'classItem' => $class
        ]);
    }

    public function update(TestClass $class, TestClassSaveRequest $request)
    {
        $class->name = $request->name;
        $class->save();
        return redirect()->route('admin.test.classes.index')->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/Test/Classes/Create');
    }

    public function store(TestClassSaveRequest  $request)
    {
        TestClass::create([
            'name' => $request->name
        ]);
        return redirect()->route('admin.test.classes.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(TestClass $class)
    {
        $class->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}