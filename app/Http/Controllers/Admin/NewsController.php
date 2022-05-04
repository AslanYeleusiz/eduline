<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsSaveRequest;
use App\Models\News;
use App\Models\NewsComment;
use App\Models\NewsType;
use App\Services\Admin\NewsService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class NewsController extends Controller
{

    public $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    
    public function index(Request $request)
    {
        $title = $request->title;
        $shortDescription = $request->short_description;
        $view = $request->view;
        $newsTypeId = $request->news_type_id;
        $news = News::when($title, fn ($query) => $query->where('title', 'like', "%$title%"))
            ->when($shortDescription, fn ($query) => $query->where('short_description', 'like', "%$shortDescription%"))
            ->when($view, fn ($query) => $query->where('view', '<=', $view))
            ->when($newsTypeId, fn ($query) => $query->where('news_type_id', $newsTypeId))
            ->with('newsType')
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        $newsTypes = NewsType::get();
        return Inertia::render('Admin/News/Index', [
            'news' => $news,
            'newsTypes' => $newsTypes
        ]);
    }
    public function edit(News $news)
    {
        $newsTypes = NewsType::get();
        // dd($news->image['ru']);
        // $news->image['ru'] = Storage::disk('public')->url(News::IMAGE_PATH . $news->image['ru']);
        // $news->image['kk'] = Storage::disk('public')->url(News::IMAGE_PATH . $news->image['kk']);
        
        return Inertia::render('Admin/News/Edit', [
            'news' => $news,
            'newsTypes' => $newsTypes
        ]);
    }
    public function update(News $news, NewsSaveRequest $request)
    {
        $this->newsService->save($news, $request);
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $newsTypes = NewsType::get();
        return Inertia::render('Admin/News/Create',[
            'newsTypes' => $newsTypes
        ]);
    }

    public function store(NewsSaveRequest $request)
    {
        $news = new News();
        $this->newsService->save($news, $request);
        return redirect()->route('admin.news.index')->withSuccess('Успешно добавлено');
    }

    public function comments($id, Request $request)
    {
        $fullName = $request->full_name;
        $text = $request->text;
        $news = News::with(['comments' => function($query) use ($fullName) {
            if($fullName) {
              return   $query->whereHas('user', fn($query) => $query->where('full_name', 'like', "%$fullName%"));
            }
            return $query;
        }, 'comments.user'])
        ->when($text, fn($query) => $query->where('text', 'like', "%$text%"))
        ->findOrFail($id);
        return Inertia::render('Admin/News/Comments',[
            'news' => $news
        ]);
    }
    
    public function commentDelete($news, $commentId)
    {
        NewsComment::destroy($commentId);
        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
