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
        $testClasses = TestClass::with(['preparations' =>  fn($query) => $query->where('test_subject_preparations.subject_id', $subject->id)])
            ->withCount(['preparations' => fn($query) => fn($query) => $query->where('test_subject_preparations.subject_id', $subject->id)])
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
        ->with('classItems')
        ->findOrFail($preparationId);
        $parentPreparations = TestSubjectPreparation::subjectBy($subject->id)
        ->isParent()
        ->get();
        $classItems = TestClass::orderBy('name')->get();
        $class_ids = $preparation->classItems->pluck('id')->toArray();
        return Inertia::render('Admin/Test/Subjects/Preparations/Edit', compact('subject',
        'preparation', 'parentPreparations', 'classItems', 'class_ids'));
    }
    public function update($subjectId, $preparationId, TestSubjectPreparationSaveRequest $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $classIds = $request->class_ids;
        $subjectId = [];
        for($i = 0; $i < count($classIds); $i++) {

                array_push($subjectId,[
                    'subject_id' => $subject->id
                ]);
        }
        $classIds = array_combine($classIds, $subjectId);
        $preparation = TestSubjectPreparation::subjectBy($subject->id)->findOrFail($preparationId);
        DB::beginTransaction();
        $preparation->title = $request->title;
        $preparation->description = $request->description;
        $preparation->video_link = $request->video_link;
        $preparation->subject_id = $subject->id;
        $preparation->parent_id = $request->parent_id;
        $preparation->save();
        $preparation->classItems()->sync($classIds);

        DB::commit();
        return redirect()->back()->withSuccess('Успешно сохранено');
        // return redirect()->route('admin.test.subjectPreparations.index', $subject->id)->withSuccess('Успешно сохранено');
    }

    public function create($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $parentPreparations = TestSubjectPreparation::subjectBy($subject->id)
        ->isParent()
        ->get();
        $classItems = TestClass::orderBy('name')->get();
        return Inertia::render('Admin/Test/Subjects/Preparations/Create', compact('subject', 'parentPreparations', 'classItems'));
    }

    public function store($subjectId, TestSubjectPreparationSaveRequest $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $classIds = $request->class_ids;
        $parrentId = $request->parent_id;
        if($classIds){
            $subjectId = [];
            for($i = 0; $i < count($classIds); $i++) {

                    array_push($subjectId,[
                        'subject_id' => $subject->id
                    ]);
            }
            $classIds = array_combine($classIds, $subjectId);
        }else if($parrentId){
            return redirect()->back()->withErrors([
                'class_ids' => 'Сынып тандалмады'
            ]);
        }


        DB::beginTransaction();
        $preparation = new TestSubjectPreparation();


        $preparation->title = $request->title;
        $preparation->description = $request->description;
        $preparation->video_link = $request->video_link;
        $preparation->subject_id = $subject->id;
        $preparation->parent_id = $request->parent_id;
        $preparation->save();
        if($classIds) $preparation->classItems()->sync($classIds);
        DB::commit();

        return redirect()->route('admin.test.subjectPreparations.index', $subject->id)->withSuccess('Успешно добавлено');
    }

    public function destroy(TestSubject $subject, TestSubjectPreparation $preparation)
    {
        $preparation->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
