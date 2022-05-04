<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialClass;
use App\Models\MaterialDirection;
use App\Models\MaterialSubject;
use App\Models\SendingMaterialJournal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterialJournalController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $authorName = $request->author_name;
        $fullName = $request->full_name;
        $subjectId = $request->subject_id;
        $directionId = $request->direction_id;
        $classId = $request->class_id;
        $status = $request->input('status', 'all');
        $materialJournals = SendingMaterialJournal::when($title, function($query) use($title) {
            $query->whereHas('material', fn($query) => $query->where('title', 'like', "%$title%"));
        })
        ->when($fullName, function($query) use($fullName) {
            $query->whereHas('user', fn($query) => $query->where('full_name', 'like', "%$fullName%"));
        })
        ->when($authorName, function($query) use($authorName) {
            $query->whereHas('material.user', fn($query) => $query->where('full_name', 'like', "%$authorName%"));
        })
        ->when($subjectId, function($query) use($subjectId) {
            $query->whereHas('material', fn($query) => $query->where('subject_id',$subjectId));
        })
        ->when($directionId, function($query) use($directionId) {
            $query->whereHas('material', fn($query) => $query->where('direction_id', $directionId));
        })
        ->when($classId, function($query) use($classId) {
            $query->whereHas('material', fn($query) => $query->where('class_id', $classId));
        })
        ->when($status !== 'all', fn ($query) => $query->where('status', $status))
        // ->when($subjectId, fn ($query) => $query->where('subject_id', $subjectId))
        // ->when($directionId, fn ($query) => $query->where('direction_id', $directionId))
        // ->when($classId, fn ($query) => $query->where('class_id', $classId))
        ->with(['user', 'material' => fn($query) =>$query->with('subject', 'direction','class', 'user')])
        ->latest()
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));

        $materialClasses =  MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        return Inertia::render('Admin/MaterialJournals/Index', [
            'materialJournals' => $materialJournals,
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
        ]);
    }
    public function edit(SendingMaterialJournal $materialJournal)
    {
        $materialJournal->load('material.user', 'material.subject', 'material.direction', 'material.class','user');
        return Inertia::render('Admin/MaterialJournals/Edit', [
            'materialJournal' => $materialJournal,
        ]);
    }
    public function update( $materialJournalId, Request $request)
    {
        $materialJournal = SendingMaterialJournal::findOrFail($materialJournalId);
        $materialJournal->status = $request->status ?? null;
        $materialJournal->save();
      
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function destroy(SendingMaterialJournal $material)
    {
        $material->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
