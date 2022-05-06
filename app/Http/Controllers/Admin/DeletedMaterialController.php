<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialClass;
use App\Models\MaterialDirection;
use App\Models\MaterialSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeletedMaterialController extends Controller
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
        $deletedMaterials = Material::when($title, fn($query) => $query->where('title', 'like', "%$title%"))
        ->when($fullName, function($query) use($fullName) {
            $query->whereHas('material.user', fn($query) => $query->where('full_name', 'like', "%$fullName%"));
        })
        ->when($subjectId, fn($query) => $query->where('subject_id', 'like', "%$subjectId%"))
        ->when($directionId, fn($query) => $query->where('direction_id', 'like', "%$directionId%"))
        ->when($classId, fn($query) => $query->where('class_id', 'like', "%$classId%"))
        ->whereNotNull('status_deleted')
        ->when($status !== 'all', fn ($query) => $query->where('status_deleted', $status))
        ->with(['user','subject', 'direction','class'])
        ->latest()
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));

        $materialClasses =  MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        return Inertia::render('Admin/DeletedMaterials/Index', [
            'deletedMaterials' => $deletedMaterials,
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
        ]);
    }
    public function edit($id)
    {
        $material = Material::with('user', 'subject', 'direction', 'class')->findOrFail($id);
        return Inertia::render('Admin/DeletedMaterials/Edit', [
            'material' => $material,
        ]);
    }
    public function update( $materialId, Request $request)
    {
        $material = Material::findOrFail($materialId);
        $material->status_deleted = $request->status_deleted ?? null;
        $material->comment_refusal_delete = $request->comment_refusal_delete ?? null;
        $material->save();
      
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->status_deleted = null;
        $material->comment_refusal_delete = null;
        $material->save();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
