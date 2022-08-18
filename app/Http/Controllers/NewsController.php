<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsComment;
use App\Models\UserNewsSaved;
use App\Models\Slider;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index(Request $request){
        $slider = Slider::orderByDesc('id')->get();
        $news = News::orderBy('created_at','desc')->paginate(2);
        $data = '';
        $now = Carbon::now();
        if ($request->ajax()) {
            foreach ($news as $new) {
                $date = Carbon::parse($new->created_at)->diffForHumans();
                $data.='<div class="m_block"><div class="ns_pre"><div class="ns_cat">'.$new->newsType->name.'</div>
                <div class="ns_time">'.$date.'</div></div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="mp_head">'.$new->title.'</div></a><div class="mp_info">'.$new->short_description.'</div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="ns_img" style="background-image:url('.asset("/storage/images/news").'/'.$new->image.')"></div></a><div class="ns_pre">
                <div class="ns_likes"><div class="ns_views"></div>'.$new->view.'<div class="ns_comments"></div>'.$new->comments->count().'
                </div><form method="get" action="" id="ajax-form">'.csrf_field().'<input type="hidden" name="id_news" value="'.$new->id.'"><button type="button" class="btn ns_savebut';
                if($new->thisUserSaved) $data .= ' active';
                $data .= '"></button></form></div></div>';
            }
            return $data;
        }
        return view('pages.home',[
            'news' => $news,
            'slider' => $slider,
            'url' => '/'
        ]);
    }
    public function announcement(Request $request){
        $news = News::where('news_types_id','=','8')->orderBy('created_at','desc')->paginate(2);
        $data = '';
        $now = Carbon::now();
        if ($request->ajax()) {
            foreach ($news as $new) {
                $date = Carbon::parse($new->created_at)->diffForHumans();
                $data.='<div class="m_block"><div class="ns_pre"><div class="ns_cat">'.$new->newsType->name.'</div>
                <div class="ns_time">'.$date.'</div></div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="mp_head">'.$new->title.'</div></a><div class="mp_info">'.$new->short_description.'</div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="ns_img" style="background-image:url('.asset("/storage/images/news").'/'.$new->image.')"></div></a><div class="ns_pre">
                <div class="ns_likes"><div class="ns_views"></div>'.$new->view.'<div class="ns_comments"></div>'.$new->comments->count().'
                </div><form method="get" action="" id="ajax-form">'.csrf_field().'<input type="hidden" name="id_news" value="'.$new->id.'"><button type="button" class="btn ns_savebut';
                if($new->thisUserSaved) $data .= ' active';
                $data .= '"></button></form></div></div>';
            }
            return $data;
        }
        return view('pages.home',[
            'news' => $news,
            'url' => 'Announcement'
        ]);
    }
    public function popular(Request $request){
        $news = News::orderBy('view','desc')->paginate(2);
        $data = '';
        $now = Carbon::now();
        if ($request->ajax()) {
            foreach ($news as $new) {
                $date = Carbon::parse($new->created_at)->diffForHumans();
                $data.='<div class="m_block"><div class="ns_pre"><div class="ns_cat">'.$new->newsType->name.'</div>
                <div class="ns_time">'.$date.'</div></div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="mp_head">'.$new->title.'</div></a><div class="mp_info">'.$new->short_description.'</div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="ns_img" style="background-image:url('.asset("/storage/images/news").'/'.$new->image.')"></div></a><div class="ns_pre">
                <div class="ns_likes"><div class="ns_views"></div>'.$new->view.'<div class="ns_comments"></div>'.$new->comments->count().'
                </div><form method="get" action="" id="ajax-form">'.csrf_field().'<input type="hidden" name="id_news" value="'.$new->id.'"><button type="button" class="btn ns_savebut';
                if($new->thisUserSaved) $data .= ' active';
                $data .= '"></button></form></div></div>';
            }
            return $data;
        }
        return view('pages.home',[
            'news' => $news,
            'url' => 'Popular'
        ]);
    }
    public function news_saves(Request $request){
        $uns = UserNewsSaved::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->paginate(2);
        $data = '';
        $now = Carbon::now();
        if ($request->ajax()) {
            foreach ($uns as $news) {
                $new = $news -> newsSaves;
                if($new->thisUserSaved){
                $date = Carbon::parse($new->created_at)->diffForHumans();
                $data.='<div class="m_block"><div class="ns_pre"><div class="ns_cat">'.$new->newsType->name.'</div>
                <div class="ns_time">'.$date.'</div></div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="mp_head">'.$new->title.'</div></a><div class="mp_info">'.$new->short_description.'</div><a href="/news/'.$new->slug($new->title).'-'.$new->id.'.html"><div class="ns_img" style="background-image:url('.asset("/storage/images/news").'/'.$new->image.')"></div></a><div class="ns_pre">
                <div class="ns_likes"><div class="ns_views"></div>'.$new->view.'<div class="ns_comments"></div>'.$new->comments->count().'
                </div><form method="get" action="" id="ajax-form">'.csrf_field().'<input type="hidden" name="id_news" value="'.$new->id.'"><button type="button" class="btn ns_savebut active"></button></form></div></div>';}
            }
            return $data;
        }
        return view('pages.home',[
            'news' => $uns,
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
