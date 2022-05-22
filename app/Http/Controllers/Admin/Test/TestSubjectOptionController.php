<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestSubjectOptionSaveRequest;
use App\Http\Requests\Admin\Test\TestSubjectSaveRequest;
use App\Models\TestLanguage;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestSubjectOptionController extends Controller
{
    public function index($id, Request $request)
    {
        $name = $request->name;
        
        $subject = TestSubject::findOrFail($id);
        $options = TestSubjectOption::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
        // ->when($questionsCount, fn ($query) => $query->where('questions_count',$questionsCount))
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));
        return Inertia::render('Admin/Test/Subjects/Options/Index',
         compact('options', 'subject'));
    }
    
    public function edit($subjectId, $optionId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->findOrFail($optionId);
        return Inertia::render('Admin/Test/Subjects/Options/Edit',compact('subject', 'option'));
    }
    
    public function update($subjectId, $optionId, TestSubjectOptionSaveRequest $request)
    {
        
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->findOrFail($optionId);
        $option->name = $request->name;
        $option->save();
        return redirect()->route('admin.test.subjectOptions.index', $subject->id)->withSuccess('Успешно сохранено');
    }

    public function create($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        return Inertia::render('Admin/Test/Subjects/Options/Create', compact('subject'));
    }

    public function store($subjectId, TestSubjectOptionSaveRequest $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = new TestSubjectOption();

        $option->name = $request->name;
        $option->subject_id = $subject->id;
        $option->save();
        return redirect()->route('admin.test.subjectOptions.index', $subject->id)->withSuccess('Успешно добавлено');
    }
    
    public function destroy(TestSubject $subject, TestSubjectOption $option)
    {
        $option->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
