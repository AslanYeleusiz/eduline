<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialEdit;
use App\Models\MaterialClass;
use App\Models\MaterialDirection;
use App\Models\MaterialSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterialEditController extends Controller
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
        $editedMaterials = MaterialEdit::when($title, fn($query) => $query->where('title', 'like', "%$title%"))
        ->when($fullName, function($query) use($fullName) {
            $query->whereHas('material.user', fn($query) => $query->where('full_name', 'like', "%$fullName%"));
        })
        ->when($subjectId, fn($query) => $query->where('subject_id', 'like', "%$subjectId%"))
        ->when($directionId, fn($query) => $query->where('direction_id', 'like', "%$directionId%"))
        ->when($classId, fn($query) => $query->where('class_id', 'like', "%$classId%"))
        ->whereNotNull('status_edited')
        ->when($status !== 'all', fn ($query) => $query->where('status_edited', $status))
        ->with(['user','subject', 'direction','class'])
        ->latest()
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));

        $materialClasses =  MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        return Inertia::render('Admin/EditedMaterials/Index', [
            'editedMaterials' => $editedMaterials,
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
        ]);
    }

    public function edit($id)
    {

        $material = MaterialEdit::with('user','material', 'subject', 'direction', 'class')->findOrFail($id);
        $oldMaterial = Material::with('user', 'subject', 'direction', 'class')->findOrFail($material->material_id);
        $materialClasses =  MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        return Inertia::render('Admin/EditedMaterials/Edit', [
            'material' => $material,
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
            'oldMaterial' => $oldMaterial,
        ]);
    }


    public function update($materialId, Request $request)
    {
        $materialEdit = MaterialEdit::findOrFail($materialId);
        if($request->status_edited == 3){
            $material = Material::findOrFail($materialEdit->material_id);
            $material->title = $request->title;
            $material->description = $request->description;
            $material->subject_id = $request->subject_id;
            $material->direction_id = $request->direction_id;
            $material->class_id = $request->class_id;
            $material->save();
        }
        $materialEdit->status_edited = $request->status_edited ?? null;
        $materialEdit->save();
        return redirect('/admin/edited-materials')->withSuccess('Успешно сохранено');
    }

    public function destroy($id)
    {
        $material = MaterialEdit::findOrFail($id);
        $material->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
