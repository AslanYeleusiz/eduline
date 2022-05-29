<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestSubjectOptionSaveRequest;
use App\Http\Requests\Admin\Test\TestSubjectPreparationSaveRequest;
use App\Http\Requests\Admin\Test\TestSubjectQuestionStoreRequest;
use App\Models\TestClass;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use App\Models\TestSubjectOptionQuestion;
use App\Models\TestSubjectPreparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TestSubjectPreparationController extends Controller
{
    public function index($id, Request $request)
    {
        $name = $request->name;

        $subject = TestSubject::findOrFail($id);
        $preparations = TestSubjectPreparation::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
            ->with('childs')  
            ->isParent()
            ->subjectBy($subject->id)  
            ->get();
            $testClasses = TestClass::with(['preparations' =>  fn($query) => $query->where('subject_id', $subject->id)])
            ->withCount(['preparations' => fn($query) => fn($query) => $query->where('subject_id', $subject->id)])
            ->get(); 
        return Inertia::render(
            'Admin/Test/Subjects/Preparations/Index',
            compact('preparations', 'subject', 'testClasses')
        );
    }

    public function edit($subjectId, $preparationId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $preparation = TestSubjectPreparation::subjectBy($subject->id)
        ->findOrFail($preparationId);
        $parentPreparations = TestSubjectPreparation::subjectBy($subject->id)
        ->isParent()
        ->get();
        return Inertia::render('Admin/Test/Subjects/Preparations/Edit', compact('subject', 
        'preparation', 'parentPreparations'));
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
        return Inertia::render('Admin/Test/Subjects/Preparations/Questions',
         compact('subject', 'option', 'questions', 'option_question_ids'));
    }

    // public function saveQuestions($subjectId, $optionId, Request $request)
    public function saveClassPreparations($subjectId, $classId, Request $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $classItem = TestClass::with('preparations' => fn($query) => $query->where('subject_id', $subject->id))
        ->findOrFail($classId);
        $preparationIds = $request->input('preparation_ids', []);
        if (empty($questionIds)) {
            $classItem->preparations()->where('subject_id', $subject->id)->sync([]);
        } else {
            $optionQuestionIds = $classItem->preparations->pluck('id')->toArray();
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
    public function update($subjectId, $preparationId, TestSubjectPreparationSaveRequest $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $preparation = TestSubjectPreparation::subjectBy($subject->id)->findOrFail($preparationId);
        $preparation->title = $request->title;
        $preparation->description = $request->description;
        $preparation->video_link = $request->video_link;
        $preparation->subject_id = $subject->id;
        $preparation->parent_id = $request->parent_id;
        $preparation->save();
        return redirect()->route('admin.test.subjectPreparations.index', $subject->id)->withSuccess('Успешно сохранено');
    }

    public function create($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $parentPreparations = TestSubjectPreparation::subjectBy($subject->id)
        ->isParent()
        ->get();
        return Inertia::render('Admin/Test/Subjects/Preparations/Create', compact('subject', 'parentPreparations'));
    }

    public function store($subjectId, TestSubjectPreparationSaveRequest $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $preparation = new TestSubjectPreparation();

        $preparation->title = $request->title;
        $preparation->description = $request->description;
        $preparation->video_link = $request->video_link;
        $preparation->subject_id = $subject->id;
        $preparation->parent_id = $request->parent_id;
        $preparation->save();
        return redirect()->route('admin.test.subjectPreparations.index', $subject->id)->withSuccess('Успешно добавлено');
    }

    public function destroy(TestSubject $subject, TestSubjectPreparation $preparation)
    {
        $preparation->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
