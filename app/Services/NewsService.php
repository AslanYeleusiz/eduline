<?php

namespace App\Services;

use Carbon\Carbon;
/**
 * Class NewsService.
 */
class NewsService
{
    public function craft($news) {
        $data = '';
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

    public function craftSave($news) {
        $data = '';
        foreach ($news as $new) {
            $date = Carbon::parse($new->newsSaves->created_at)->diffForHumans();
            $data.='<div class="m_block"><div class="ns_pre"><div class="ns_cat">'.$new->newsSaves->newsType->name.'</div>
            <div class="ns_time">'.$date.'</div></div><a href="/news/'.$new->newsSaves->slug($new->newsSaves->title).'-'.$new->newsSaves->id.'.html"><div class="mp_head">'.$new->newsSaves->title.'</div></a><div class="mp_info">'.$new->newsSaves->short_description.'</div><a href="/news/'.$new->newsSaves->slug($new->newsSaves->title).'-'.$new->newsSaves->id.'.html"><div class="ns_img" style="background-image:url('.asset("/storage/images/news").'/'.$new->newsSaves->image.')"></div></a><div class="ns_pre">
            <div class="ns_likes"><div class="ns_views"></div>'.$new->newsSaves->view.'<div class="ns_comments"></div>'.$new->newsSaves->comments->count().'
            </div><form method="get" action="" id="ajax-form">'.csrf_field().'<input type="hidden" name="id_news" value="'.$new->newsSaves->id.'"><button type="button" class="btn ns_savebut';
            if($new->newsSaves->thisUserSaved) $data .= ' active';
            $data .= '"></button></form></div></div>';
        }
        return $data;
    }


}
