<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestQuestionSaveRequest;
use App\Http\Requests\Admin\Test\TestSubjectOptionSaveRequest;
use App\Http\Requests\Admin\Test\TestSubjectQuestionStoreRequest;
use App\Http\Requests\Admin\Test\TestSubjectSaveRequest;
use App\Models\TestLanguage;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use App\Models\TestSubjectOptionQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TestSubjectOptionController extends Controller
{
    public function index($id, Request $request)
    {
        $name = $request->name;

        $subject = TestSubject::findOrFail($id);
        $options = TestSubjectOption::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
            ->subjectBy($subject->id)    
        // ->when($questionsCount, fn ($query) => $query->where('questions_count',$questionsCount))
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render(
            'Admin/Test/Subjects/Options/Index',
            compact('options', 'subject')
        );
    }

    public function edit($subjectId, $optionId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->findOrFail($optionId);
        return Inertia::render('Admin/Test/Subjects/Options/Edit', compact('subject', 'option'));
    }

    public function questions($subjectId, $optionId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)
        ->with('questions', fn($query) => $query->orderByPivot('number'))
        ->findOrFail($optionId);

        $options = TestSubjectOption::get();

        $questions = TestQuestion::subjectBy($subject->id)->orderBy('text')->get();
        $option_question_ids = $option->questions->pluck('id')->toArray();
        return Inertia::render('Admin/Test/Subjects/Options/Questions',
         compact('subject', 'option', 'questions', 'option_question_ids'));
    }

    public function saveQuestions($subjectId, $optionId, Request $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->with('questions')->findOrFail($optionId);
        $questionIds = $request->input('question_ids', []);
        if (empty($questionIds)) {
            $option->questions()->sync([]);
        } else {
            $optionQuestionIds = $option->questions->pluck('id')->toArray();
            $countOptionQuestionIds = count($optionQuestionIds);
            $isNotquestionIds = array_diff($questionIds, $optionQuestionIds);
            $isNotOptionQuestionIds = array_diff($optionQuestionIds, $questionIds);
            DB::beginTransaction();
            $option->questions()->detach($isNotOptionQuestionIds);
            $numbers = [];
            for($i = 0; $i < count($isNotquestionIds); $i++) {
               
                    array_push($numbers,[
                        'number' => ++$countOptionQuestionIds
                    ]);
            }
            $isNotquestionIds = array_combine($isNotquestionIds, $numbers);
            $option->questions()->attach($isNotquestionIds);
            DB::commit();
        }
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function createQuestions($subjectId, $optionId, TestSubjectQuestionStoreRequest $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->with('questions')->findOrFail($optionId);
        $answers = array_map(function ($answer) use ($request) {
            return [
                'number' => $answer['number'],
                'text' => $answer['text'],
                'is_correct' => $answer['number'] == $request->correct_answer_number
            ];
        }, $request->answers);
        DB::beginTransaction();
        $question = new TestQuestion();
        $question->text = $request->text;
        $question->answers = $answers;
        $question->subject_id = $subject->id;
        $question->is_active = $request->is_active == 'true';
        $question->save();
        $option->questions()->attach([$question->id => [
            'number' => $option->questions->count() + 1 
        ]]);
        DB::commit();
        return redirect()->back()->withSuccess('Успешно добавлено');
    }

    public function deleteQuestions($subjectId, $optionId, $questionId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->findOrFail($optionId);

        $optionQuestion = TestSubjectOptionQuestion::where('option_id', $option->id)
        ->where('id', $questionId)
        ->firtOrFail();
        $optionQuestion->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function saveQuestionsNumbers($subjectId, $optionId, Request $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subject->id)->findOrFail($optionId);
        $questions = $request->questions;
        foreach($questions as $question) {
            $option->questions()->updateExistingPivot($question['id'], [
                    'number' => $question['number'],
                ]);
        }     
        return redirect()->back()->withSuccess('Успешно обнавлено');
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
        
        $questionsIds = TestQuestion::subjectBy($subject->id)
        ->inRandomOrder()
        ->limit($subject->questions_count)
        ->get()
        ->pluck('id')
        ->toArray();

        DB::beginTransaction();
        $option = new TestSubjectOption();

        $option->name = $request->name;
        $option->subject_id = $subject->id;
        $option->save();

        $questionsCount = count($questionsIds);
        $numbers = [];
        for($i = 0; $i < $questionsCount; $i++) {
                array_push($numbers,[
                    'number' => $i
                ]);
        }
        $questionsIds = array_combine($questionsIds, $numbers);
        $option->questions()->sync($questionsIds);
        DB::commit();
        return redirect()->route('admin.test.subjectOptions.index', $subject->id)->withSuccess('Успешно добавлено');
    }

    public function destroy(TestSubject $subject, TestSubjectOption $option)
    {
        $option->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
