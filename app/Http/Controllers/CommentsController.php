<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsComment;
use App\Models\NewsCommentAnswer;
use App\Models\NewsCommentLike;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request) {
//        $data = $request;
//        dd($data->id_news);
        $com = new NewsComment();
        $com->user_id = auth()->user()->id;
        $com->news_id = $request->id_news;
        $com->text = $request->text;
        $com->save();
        return redirect()->back();
    }
public function show($id, Request $request) {
//        $data = $request;
//        dd($request);

        $coms = NewsComment::where('news_id','=',$id)->orderBy('created_at','desc')->paginate(2);
        $data = '';
        if ($request->ajax()) {
            foreach ($coms as $com) {

                $data .= '<div class="cm_block"><div class="cm_avatar" style="background-image: url('.asset("images/avatar.png").')"></div><div class="cm_content"><div class="cm_head">'.$com->user->full_name.'</div><div class="cm_body">'.$com->text.'</div><div class="cm_footer"><button type="button" class="btn cm_likes';
                if($com->thisUserLiked) $data .= ' active';
                $data .= '"><div class="cm_like"></div><span id="like_count">'.$com->thisLikes->count().'</span></button><button class="btn cm_qsts"><div class="cm_qst"></div>'.__('site.Жауап жазу').'</button></div><form action="" id="ajax_form" method="post" class="cm_form a" style="display:none"><input type="text" class="form-control cm_input" name="text" placeholder="';
                Auth::user() ? $data.=''.__('site.Өз пікіріңізді жазыңыз').'...' : $data.=''.__('site.Пікірді тек тіркелген қолданушылар қалдыра алады').'...'; $data .= '" autocomplete="off"><input type="hidden" name="comment_id" class="comment_id" value="'.$com->id.'"><button type="button" class="btn-primary btn cm_btn">'.__('site.Жіберу').' <img src="'.asset("images/news/send.svg").'" alt=""></button></form>';
                $answer_count = NewsCommentAnswer::where('news_comment_id','=',$com->id)->count();
                if($answer_count>0){
                    $data .= '<div id="answer_results"></div><button class="btn cm_anothers">Жауаптарды көру (<span id="answer_count">'.$answer_count.'</span>)<div class="cm_arrow"></div></button>';
                    $answer = NewsCommentAnswer::where('news_comment_id','=',$com->id)->get();
                    $data .= '<div id="answer_list" style="display:none">';
                    foreach ($answer as $an){
                        $data .= '<div class="cm_block mini"><div class="cm_avatar" style="background-image: url('.asset("images/avatar.png").')"></div><div class="cm_content"><div class="cm_head">'.$an->user->full_name.'</div><div class="cm_body">'.$an->text.'</div></div></div>';
                    }
                    $data .= '</div>';
                }
                $data .= '</div></div>';
            }
            return $data;
        }
    }
    public function answer(Request $request) {
        $com = new NewsCommentAnswer();
        $com->user_id = auth()->user()->id;
        $com->news_comment_id = $request->comment_id;
        $com->text = $request->text;
        $com->save();
        return redirect()->back();
    }
    function another($id){
        $coms = NewsCommentAnswer::where('news_comment_id','=',$id)->orderBy('created_at');
        $data = '';
        if ($request->ajax()) {
            foreach ($coms as $com) {
                $data .= '<div class="cm_block mini"><div class="cm_avatar" style="background-image: url('.asset("images/avatar.png").')"></div><div class="cm_content"><div class="cm_head">'.$com->user->full_name.'</div><div class="cm_body">'.$com->text.'</div></div></div>';
            }
            return $data;
        }
    }
    public function likes(Request $request){
        $like = NewsCommentLike::where('news_comment_id','=',$request->comment_id)->where('user_id','=',auth()->user()->id)->first();
        if($like === null){
            $com = new NewsCommentLike();
            $com->user_id = auth()->user()->id;
            $com->news_comment_id = $request->comment_id;
            $com->save();
        }else {
           $like->delete();
        }
        return redirect()->back();
    }
}
