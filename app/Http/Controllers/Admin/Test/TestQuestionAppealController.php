<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestLanguageSaveRequest;
use App\Http\Requests\Admin\Test\TestQuestionSaveRequest;
use App\Models\TestSubject;
use App\Models\TestQuestion;
use App\Models\TestQuestionAppeal;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestQuestionAppealController extends Controller
{
    public function index(Request $request)
    {
        $comment = $request->comment;
        $userName = $request->user_name;
        $questionText = $request->question_text;
        $type = $request->appeal_type;

        $appeals = TestQuestionAppeal::with('question:id,text', 'test:id', 'user:id,full_name')
            ->when($comment, function($query) use ($comment) {
                return $query->where('comment', 'like', "%$comment%");
            })
            ->when($userName, function($query) use ($userName) {
                return $query->whereHas('user', function($query) use ($userName) {
                    return $query->where('full_name', 'like', "%$userName%");
                });
            })
            ->when($questionText, function($query) use ($questionText) {
                return $query->whereHas('question', function($query) use ($questionText) {
                    return $query->where('text', 'like', "%$questionText%");
                });
            })
            ->when($type, function($query) use ($type) {
                return $query->where('type', $type);
            })
            ->orderByDesc('created_at')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/Test/QuestionAppeals/Index', [
            'appeals' => $appeals,
            'appeal_types' => TestQuestionAppeal::TYPES
        ]);
    }

    public function edit($id)
    {
        $question = TestQuestion::findOrFail($id);
        $subjects = TestSubject::with(['language', 'preparationChilds:id,subject_id,title'])->orderBy('name')->get();
        $question->load('preparations');
        $preparation_ids = $question->preparations->pluck('id')->toArray();
        return Inertia::render('Admin/Test/QuestionAppeals/Edit',compact('question', 'subjects', 'preparation_ids'));
    }

    public function update($id, TestQuestionSaveRequest $request)
    {
        $question = TestQuestion::findOrFail($id);
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
        return redirect()->route('admin.test.questionAppeals.index')->withSuccess('Успешно сохранено');
    }

    public function destroy($id)
    {
        $appeal = TestQuestionAppeal::findOrFail($id);
        $appeal->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
