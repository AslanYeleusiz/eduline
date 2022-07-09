<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqSaveRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $question = $request->question;
        $answer = $request->answer;
        $faqs = Faq::when($question, fn ($query) => $query->where('question', 'like', "%$question%"))
            ->when($answer, fn ($query) => $query->where('answer', 'like', "%$answer%"))
            ->latest()
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => $faqs
        ]);
    }

    public function edit(Faq $faq)
    {
        return Inertia::render('Admin/Faqs/Edit', [
            'faq' => $faq
        ]);
    }

    public function update(Faq $faq, FaqSaveRequest $request)
    {
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/Faqs/Create');
    }

    public function store(FaqSaveRequest $request)
    {
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('admin.faqs.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
