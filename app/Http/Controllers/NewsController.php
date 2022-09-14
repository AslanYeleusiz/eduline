<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsComment;
use App\Models\UserNewsSaved;
use App\Models\Slider;
use App\Services\NewsService;
use Carbon\Carbon;

class NewsController extends Controller
{
    private $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    public function index(Request $request){
        $slider = Slider::where('in_app', 1)->get();
        $news = News::orderBy('created_at','desc')->with(['newsType', 'comments', 'thisUserSaved'])->paginate(2);
        $now = Carbon::now();
        if ($request->ajax()) {
            return $this->newsService->craft($news);
        }
        return view('pages.home',[
            'news' => $news,
            'slider' => $slider,
            'url' => '/'
        ]);
    }
    public function announcement(Request $request){
        $news = News::where('news_types_id','=','8')->orderBy('created_at','desc')->with(['newsType', 'comments', 'thisUserSaved'])->paginate(2);
        $now = Carbon::now();
        if ($request->ajax()) {
            return $this->newsService->craft($news);
        }
        return view('pages.home',[
            'news' => $news,
            'slider' => null,
            'url' => 'Announcement'
        ]);
    }
    public function popular(Request $request){
        $news = News::orderBy('view','desc')->with(['newsType', 'comments', 'thisUserSaved'])->paginate(2);
        $now = Carbon::now();
        if ($request->ajax()) {
            return $this->newsService->craft($news);
        }
        return view('pages.home',[
            'news' => $news,
            'slider' => null,
            'url' => 'Popular'
        ]);
    }
    public function news_saves(Request $request){
        $uns = UserNewsSaved::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->with('newsSaves')->paginate(2);
        $now = Carbon::now();
        if ($request->ajax()) {
            return $this->newsService->craftSave($uns);
        }
        return view('pages.home',[
            'news' => $uns,
            'slider' => null,
            'url' => 'Saves'
        ]);
    }
    public function save(Request $request){
        $uns = UserNewsSaved::where('user_id','=',auth()->user()->id)->where('news_id','=',$request->id_news)->first();
        if($uns === null){
            $ns = new UserNewsSaved();
            $ns->user_id=auth()->user()->id;
            $ns->news_id=$request->id_news;
            $ns->save();
        }
        else $uns->delete();
        return redirect()->back();

    }
    public function newspage($slug, $id, Request $request){
        $new = News::find($id);
        $comments = NewsComment::where('news_id','=',$id)->count();
        $now = Carbon::now();
        $new->increment('view');
        $date = Carbon::parse($new->created_at)->diffForHumans();
        return view('pages.newsPage',[
            'material' => $new,
            'comments' => $comments,
            'pageName' => $new->title,
            'date' => $date
        ]);
    }
}
