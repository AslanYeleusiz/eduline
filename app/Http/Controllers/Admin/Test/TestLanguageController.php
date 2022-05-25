<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\TestLanguageSaveRequest;
use App\Models\TestLanguage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestLanguageController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $code = $request->code;
        $languages = TestLanguage::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
            ->when($code, fn ($query) => $query->where('code', 'like', "%$code%"))
            ->get();
        return Inertia::render('Admin/Test/Languages/Index', compact('languages'));
    }

    public function edit(TestLanguage $language)
    {
        return Inertia::render('Admin/Test/Languages/Edit',compact('language'));
    }
    
    public function update(TestLanguage $language, TestLanguageSaveRequest $request)
    {
        $language->name = $request->name;
        $language->code = $request->code;
        $language->save();
        return redirect()->route('admin.test.languages.index')->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/Test/Languages/Create');
    }

    public function store(TestLanguageSaveRequest $request)
    {
        TestLanguage::create($request->validated());
        return redirect()->route('admin.test.languages.index')->withSuccess('Успешно добавлено');
    }
    
    public function destroy(TestLanguage $language)
    {
        $language->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
