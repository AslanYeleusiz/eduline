<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\TestQuestion;
use App\Models\TestQuestionAppeal;
use App\Models\TestSubjectPreparationAppeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestPreparationAppealController extends Controller
{
    public function index(Request $request)
    {
        $comment = $request->comment;
        $userName = $request->user_name;
        $title = $request->title;
        $type = $request->appeal_type;

        // $preparationAppeal = new TestSubjectPreparationAppeal();
        // $preparationAppeal->preparation_id = $preparation->id;
        // $preparationAppeal->type = $request->type;
        // $preparationAppeal->comment = $request->comment;
        // $user = auth()->guard('api')->user();
        // if (!empty($user)) {
        //     $preparationAppeal->user_id = $user->id;
        // }
        $appeals = TestSubjectPreparationAppeal::with('preparation:id,title,subject_id',
         'user:id,full_name')
            ->when($comment, function($query) use ($comment) {
                return $query->where('comment', 'like', "%$comment%");
            })
            ->when($userName, function($query) use ($userName) {
                return $query->whereHas('user', function($query) use ($userName) {
                    return $query->where('full_name', 'like', "%$userName%");
                });
            })
            ->when($title, function($query) use ($title) {
                return $query->whereHas('preparation', function($query) use ($title) {
                    return $query->where('title', 'like', "%$title%");
                });
            })
            ->when($type, function($query) use ($type) {
                return $query->where('type', $type);
            })
            ->orderByDesc('created_at')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        return Inertia::render('Admin/Test/PreparationAppeals/Index', [
            'appeals' => $appeals,
            'appeal_types' => TestSubjectPreparationAppeal::TYPES
        ]);
    }

    public function destroy($id)
    {
        $appeal = TestSubjectPreparationAppeal::findOrFail($id);
        $appeal->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
