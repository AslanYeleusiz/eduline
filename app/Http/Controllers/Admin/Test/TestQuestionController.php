<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestLanguageSaveRequest;
use App\Http\Requests\Admin\Test\TestQuestionSaveRequest;
use App\Models\TestLanguage;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;


class TestQuestionController extends Controller
{
    public function index(Request $request)
    {
        $text = $request->text;
        $subjectId = $request->subject_id;
        $questions = TestQuestion::with('subject')
        ->latest()
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));
        $subjects = TestSubject::orderBy('name')->get();
        return Inertia::render('Admin/Test/Questions/Index', compact('questions', 'subjects'));
    }

    public function edit(TestQuestion $question)
    {
        $subjects = TestSubject::with('language')->orderBy('name')->get();
        
        return Inertia::render('Admin/Test/Questions/Edit',compact('question', 'subjects'));
    }
    
    public function update(TestQuestion $question, TestQuestionSaveRequest $request)
    {
        $answers = array_map(function ($answer) use ($request) {
            return [
                'number' => $answer['number'],
                'text' => $answer['text'],
                'is_correct' => $answer['number'] == $request->correct_answer_number
            ];
        }, $request->answers);
        $question->text = $request->text;
        $question->answers = $answers;
        $question->subject_id = $request->subject_id;
        $question->is_active = $request->is_active == 'true';
        $question->save();
        return redirect()->route('admin.test.questions.index')->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $subjects = TestSubject::with('language')->orderBy('name')->get();
        return Inertia::render('Admin/Test/Questions/Create', compact('subjects'));
    }

    public function store(TestQuestionSaveRequest $request)
    {
        $answers = array_map(function ($answer) use ($request) {
            return [
                'number' => $answer['number'],
                'text' => $answer['text'],
                'is_correct' => $answer['number'] == $request->correct_answer_number
            ];
        }, $request->answers);
        $question = new TestQuestion();
        $question->text = $request->text;
        $question->answers = $answers;
        $question->subject_id = $request->subject_id;
        $question->is_active = $request->is_active == 'true';
        $question->save();
        return redirect()->route('admin.test.questions.index')->withSuccess('Успешно добавлено');
    }
    
    public function destroy(TestLanguage $language)
    {
        $language->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
