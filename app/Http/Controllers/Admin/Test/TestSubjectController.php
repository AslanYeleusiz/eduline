<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestSubjectSaveRequest;
use App\Models\TestDirection;
use App\Models\TestLanguage;
use App\Models\TestSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestSubjectController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $isPedagogy = $request->is_pedagogy;
        $questionsCount = $request->questions_count;
        $languageId = $request->language_id;

        $directions = TestDirection::get();
        $languages = TestLanguage::get();
        // directions array
        $subjects = TestSubject::with('language')
        ->withCount('questions as all_questions_count')
        ->when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
        ->when($description, fn ($query) => $query->where('description', 'like', "%$description%"))
        ->when($questionsCount, fn ($query) => $query->where('questions_count',$questionsCount))
        ->when($languageId, fn ($query) => $query->where('language_id',$languageId))
        ->when($isPedagogy, fn ($query) => $query->where('is_pedagogy', ($isPedagogy == 'true') ? 1 : 0))
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));
        return Inertia::render('Admin/Test/Subjects/Index', compact('directions', 'languages', 'subjects'));
    }

    public function edit(TestSubject $subject)
    {

        $languages = TestLanguage::get();
        return Inertia::render('Admin/Test/Subjects/Edit',compact('subject', 'languages'));
    }

    public function update(TestSubject $subject, TestSubjectSaveRequest $request)
    {
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->questions_count = $request->questions_count;
        $subject->language_id = $request->language_id;
        $subject->is_pedagogy = $request->is_pedagogy == 'true';
        $subject->is_soon = $request->is_soon == 'true';
        $subject->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $languages = TestLanguage::get();
        return Inertia::render('Admin/Test/Subjects/Create', compact('languages'));
    }

    public function store(TestSubjectSaveRequest $request)
    {
        $subject = new TestSubject();
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->questions_count = $request->questions_count;
        $subject->language_id = $request->language_id;
        $subject->is_pedagogy = $request->is_pedagogy == 'true';
        $subject->is_soon = $request->is_soon == 'true';
        $subject->save();
        return redirect()->route('admin.test.subjects.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(TestSubject $subject)
    {
        $subject->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
