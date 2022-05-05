<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsTypeSaveRequest;
use App\Models\NewsType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsTypeController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $newsTypes = NewsType::when($name, fn ($query) => $query->where('name->kk', 'like', "%$name%"))
            ->orderBy('name')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/NewsTypes/Index', [
            'newsTypes' => $newsTypes
        ]);
    }
    
    public function edit(NewsType $newsType)
    {
        return Inertia::render('Admin/NewsTypes/Edit', [
            'newsType' => $newsType
        ]);
    }

    public function update(NewsType $newsType, NewsTypeSaveRequest $request)
    {
        $newsType->name = $request->name;
        $newsType->is_main = $request->is_main == 'true';
        $newsType->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/NewsTypes/Create');
    }

    public function store(NewsTypeSaveRequest $request)
    {
        $newsType = new NewsType();
        $newsType->name = $request->name;
        $newsType->is_main = $request->is_main == 'true';
        $newsType->save();
        return redirect()->route('admin.newsTypes.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(NewsType $newsType)
    {
        $newsType->news()->delete();
        $newsType->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
