<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestLanguageSaveRequest;
use App\Http\Requests\Admin\Test\TestQuestionSaveRequest;
use App\Models\TestLanguage;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class TestQuestionController extends Controller
{
    public function index(Request $request)
    {
        $text = $request->text;
        $subjectId = $request->subject_id;
        $isActive = $request->is_active;
        $questions = TestQuestion::with('subject')
        ->latest()
        ->when($subjectId,  fn ($query) => $query->where('subject_id', $subjectId))
        ->when($isActive, function ($query) use ($isActive) {
            if($isActive == "true") return $query->where('is_active', 1);
            else if($isActive == "false") return $query->where('is_active', 0);
        })
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));
        $subjects = TestSubject::orderBy('name')->get();
        return Inertia::render('Admin/Test/Questions/Index', compact('questions', 'subjects'));
    }

    public function edit(TestQuestion $question)
    {
        $subjects = TestSubject::with(['language', 'preparationChilds:id,subject_id,title'])->orderBy('name')->get();
        $question->load('preparations');
        $preparation_ids = $question->preparations->pluck('id')->toArray();
        return Inertia::render('Admin/Test/Questions/Edit',compact('question', 'subjects', 'preparation_ids'));
    }

    public function update(TestQuestion $question, TestQuestionSaveRequest $request)
    {
        $preparationIds = $request->input('preparation_ids', []);
        $answers = array_map(function ($answer) use ($request) {
            return [
                'number' => $answer['number'],
                'text' => $answer['text'],
                'is_correct' => $answer['number'] == $request->correct_answer_number
            ];
        }, $request->answers);
        DB::beginTransaction();
        $question->text = $request->text;
        $question->answers = $answers;
        $question->subject_id = $request->subject_id;
        $question->is_active = $request->is_active == 'true';
        $question->save();
        $question->preparations()->sync($preparationIds);
        DB::commit();
        return redirect()->route('admin.test.questions.index')->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $subjects = TestSubject::with(['language', 'preparationChilds'])->orderBy('name')->get();
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
        $preparationIds = $request->input('preparation_ids', []);
        DB::beginTransaction();
        $question = new TestQuestion();
        $question->text = $request->text;
        $question->answers = $answers;
        $question->subject_id = $request->subject_id;
        $question->is_active = $request->is_active == 'true';
        $question->save();
        $question->preparations()->sync($preparationIds);
        DB::commit();
        return redirect()->route('admin.test.questions.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(TestLanguage $language)
    {
        $language->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
