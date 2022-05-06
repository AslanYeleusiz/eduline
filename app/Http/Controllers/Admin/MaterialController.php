<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Material\MaterialSaveRequest;
use App\Models\Material;
use App\Models\MaterialClass;
use App\Models\MaterialComment;
use App\Models\MaterialDirection;
use App\Models\MaterialSubject;
use App\Services\FileService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        $subjectId = $request->subject_id;
        $directionId = $request->direction_id;
        $classId = $request->class_id;
        $materials = Material::when($title, fn ($query) => $query->where('title', 'like', "%$title%"))
        ->when($description, fn ($query) => $query->where('description', 'like', "%$description%"))
        ->when($subjectId, fn ($query) => $query->where('subject_id', $subjectId))
        ->when($directionId, fn ($query) => $query->where('direction_id', $directionId))
        ->when($classId, fn ($query) => $query->where('class_id', $classId))
        ->with('subject','direction', 'class', 'user')
        ->latest()
        ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        $materialClasses = MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        return Inertia::render('Admin/Materials/Index', [
            'materials' => $materials,
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
        ]);
    }
    public function edit(Material $material)
    {
        $materialClasses = MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        $material->load('user');
        return Inertia::render('Admin/Materials/Edit', [
            'material' => $material,
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
        ]);
    }
    public function update(Material $material, MaterialSaveRequest $request)
    {
        // $newsType->name = $request->name;
        // $newsType->save();
        $material->title = $request->title;
        $material->description = $request->description;
        $material->subject_id = $request->subject_id;
        $material->direction_id = $request->direction_id;
        $material->class_id = $request->class_id;
        $material->date = $request->date;
        $material->view = $request->view;
        $material->download = $request->download;
        if($request->hasFile('file_name')) {
        
            $year = (int) ($material->created_at?->format('Y') ?? now()->format('Y'));
            $month = (int) ($material->created_at?->format('m') ?? now()->format('m'));
            $path = Material::FILE_PATH . $year . '/'. $month;
            $material->file_name = FileService::saveFile($request->file('file_name'), $path, $material->file_name);
        }
        $material->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $materialClasses = MaterialClass::get();
        $materialSubjects = MaterialSubject::get();
        $materialDirections = MaterialDirection::get();
        return Inertia::render('Admin/Materials/Create', [
            'materialClasses' => $materialClasses,
            'materialSubjects' => $materialSubjects,
            'materialDirections' => $materialDirections,
        ]);
    }

    public function comments($id, Request $request)
    {
        $fullName = $request->full_name;
        $text = $request->text;
        $material = Material::with(['comments' => function($query) use ($fullName) {
            if($fullName) {
              return   $query->whereHas('user', fn($query) => $query->where('full_name', 'like', "%$fullName%"));
            }
            return $query;
        }, 'comments.user'])
        ->when($text, fn($query) => $query->where('text', 'like', "%$text%"))
        ->findOrFail($id);
        return Inertia::render('Admin/Materials/Comments',[
            'material' => $material
        ]);
    }
    
    public function commentDelete($material, $commentId)
    {
        MaterialComment::destroy($commentId);
        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function destroy(Material $material)
    {
        //file delete
        $material->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
