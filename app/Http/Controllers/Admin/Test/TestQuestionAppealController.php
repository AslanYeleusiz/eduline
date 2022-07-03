<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\TestQuestion;
use App\Models\TestQuestionAppeal;
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
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/Test/QuestionAppeals/Index', [
            'appeals' => $appeals,
            'appeal_types' => TestQuestionAppeal::TYPES
        ]);
    }


    public function destroy($id)
    {
        $appeal = TestQuestionAppeal::findOrFail($id);
        $appeal->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
