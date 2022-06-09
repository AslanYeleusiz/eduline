<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Models\Material;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;
use App\Models\SendingMaterialJournal;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    function set_locale($locale): \Illuminate\Http\RedirectResponse
    {
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function profile(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Профиль');
        $user = Auth::user();

        return view('pages.profile.index', compact(['pageName', 'user']));
    }

    public function subscription(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Жазылым');
        $subscriptions = Subscription::query()->where('is_active', 0)->get();

        $userSubscription = UserSubscription::query()->where('user_id', auth()->id())
            ->with('subscription')->first();

        return view('pages.subscription.index', compact(['pageName', 'subscriptions', 'userSubscription']));
    }

    public function ajaxMaterials(Request $request)
    {
        $materials = new Material();
        if ($request->ajax()){
            if($request->pan > 1) $materials = $materials->where('subject_id','=',$request->pan);
            if($request->bagyt > 1) $materials = $materials->where('direction_id','=',$request->bagyt);
            if($request->synyp > 1) $materials = $materials->where('class_id','=',$request->synyp);
            if($request->s != null) $materials = $materials->where('title','like','%'.$request->s.'%');
        }
        $materials = $materials->where('status_deleted','=',null)->orWhere('status_deleted','<',3);
        $materialCount = $materials->count();
        $materials = $materials->orderBy('created_at','desc')->paginate(20);
        $pageName = __('site.Материалдар');
        $data = '';
        if ($request->ajax()) {
            foreach ($materials as $material) {
                $data.='<div class="m_block"><a target="_blank" href="/materials/'.$material->slug($material->title).'-'.$material->id.'.html" id="m_head" class="m_block_head">'.$material->title.'</a><div id="m_body" class="m_body">'.$material->description.'</div><div class="m_footer"><div class="m_item"><img src="'.asset('images/profile-c.png').'"><span id="name">'.$material->user->full_name.'</span></div><div class="m_item"><img src="'.asset('images/calendar.png').'"><span id="date">'.$material->createdAt($material->created_at).'</span></div><div class="m_item"><img src="'.asset('images/eye.png').'"><span id="views">'.$material->view.'</span></div><div class="m_item"><img src="'.asset('images/re-square.png').'"><span id="downloads">'.$material->download.'</span></div></div></div>';
            }
            $data.=$materials->links('vendor.pagination.default');
            return $data;
        }
        return view('pages.materials.index', [
            'materialCount' => $materialCount,
            'materialSubject' => MaterialSubject::get(),
            'materialDirection' => MaterialDirection::get(),
            'materialClass' => MaterialClass::get(),
            'pageName' => $pageName
        ]);

    }

    public function material($slug, $id)
    {
        $material = Material::find($id);
        $userSub = null;
        if(Auth::user()){
            $userSub = UserSubscription::where('user_id','=',auth()->user()->id)->where('to_date','>',Carbon::now())->first();
        }
        $material->increment('view');
        $pageName = __('site.Материал');
        return view('pages.materials.materialpage', compact('material','pageName','userSub'));
    }

    public function myMaterials()
    {
        $material = Material::where('user_id','=',auth()->user()->id)->where(function ($query) {
               $query->where('status_deleted', '=', null)
                     ->orWhere('status_deleted', '<', 3);
           })->orderBy('created_at','desc')->paginate(20);
        $userSub = UserSubscription::where('user_id','=',auth()->user()->id)->where('to_date','>',Carbon::now())->first();
        $pageName = __('site.Менің материалдарым');
        return view('pages.materials.my-materials',compact('pageName','material','userSub'));
    }

    public function change($id, Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $material = Material::where('id','=',$id)->first();
        $pageName = __('site.Менің материалдарым');
        return view('pages.materials.materialchange', compact('material'), [
            'sub' => MaterialSubject::get(),
            'dir' => MaterialDirection::get(),
            'class' => MaterialClass::get()
        ]);
    }
    public function changed(Request $request)
    {
        $material = Material::find($request->material_id);
        if($material->created_at == $material->updated_at){
            $material -> title = $request -> name;
            $material -> description = $request -> text;
            $material -> subject_id = $request -> subject;
            $material -> direction_id = $request -> direction;
            $material -> class_id = $request -> class;
            $material -> save();
        }else {
            return __('site.Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң өзгертіледі');
        }
        return __('site.Материал сәтті өзгертілді');
    }

    public function delete(Request $request)
    {
        $material = Material::find($request->material_id);
        $material -> comment_when_deleted = $request -> comment;
        $material -> status_deleted = 1;
        $material -> save();
        return redirect()->back()->withSuccess(__('site.Материал қарастыруға жүктелді'));
    }
    public function journal(Request $request)
    {
        $journal = SendingMaterialJournal::where('material_id','=', $request->material_id)->first();
        if($journal === null){
            $send = new SendingMaterialJournal;
            $send->user_id = auth()->user()->id;
            $send->material_id = $request->material_id;
            $send->save();
        }else{
            if($journal->status==null)
                return __('site.Сіздің сұранысыңыз қабылдау барысында. Сайт әкімшілігі тексерген соң сізге хабарласады');

            $data = __('site.Сіздің сұранысыңыз тексерілді. Сайт әкімшілігі жинаққа жіберуді');
            $journal->status==1 ? $data.=__('site.қабылдамады') : $data.= __('site.қабылдады');
            return $data;
        }
        return __('site.Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң сізге хабарласады');
    }


}
