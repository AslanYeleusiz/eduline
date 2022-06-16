<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Models\Material;
use App\Models\MaterialEdit;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;
use App\Models\PromoCode;
use App\Models\SendingMaterialJournal;
use App\Models\UsedPromocodes;
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
        $subscriptions = Subscription::query()->where('is_active', 1)->get();

        $userSubscription = UserSubscription::query()->where('user_id', auth()->id())
            ->with('subscription')->first();

        return view('pages.subscription.index', compact(['pageName', 'subscriptions', 'userSubscription']));
    }

    public function showSubscription(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pageName = __('site.Жазылым');
        $subscriptions = Subscription::query()->where('is_active', 1)->get();

        $userSubscription = UserSubscription::query()->where('user_id', auth()->id())
            ->with('subscription')->first();

        return view('pages.subscription.subscription', compact(['pageName', 'subscriptions', 'userSubscription']));
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
        $materials = $materials->where(function ($query) {
               $query->where('status_deleted', '=', null)
                     ->orWhere('status_deleted', '<', 3);
        });
        $materialCount = $materials->count();
        $materials = $materials->orderBy('created_at','desc')->paginate(20);
        $pageName = __('site.Материалдар');
        $data = '';
        if ($request->ajax()) {
            foreach ($materials as $material) {
                $data.='<div class="m_block"><a target="_blank" href="/materials/'.$material->slug($material->title).'-'.$material->id.'.html" id="m_head" class="m_block_head">'.$material->title.'</a><div id="m_body" class="m_body">'.$material->description.'</div><div class="m_footer"><div class="m_item"><img src="'.asset('images/profile-c.png').'"><span id="name">'.$material->user->full_name.'</span></div><div class="m_item"><img src="'.asset('images/calendar.png').'"><span id="date">'.$material->createdAt($material->created_at).'</span></div><div class="m_item"><img src="'.asset('images/eye.png').'"><span id="views">'.$material->view.'</span></div><div class="m_item"><img src="'.asset('images/re-square.png').'"><span id="downloads">'.$material->download.'</span></div></div></div>';
            }
            $data.=$materials->links('vendor.pagination.default');
            return ['data'=>$data, 'count'=>$materialCount];
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
        $material = MaterialEdit::where('material_id','=',$request->material_id)->first();
        if($material == null){
            $edit = new MaterialEdit();
            $edit -> user_id = auth()->user()->id;
            $edit -> material_id = $request->material_id;
            $edit -> title = $request -> name;
            $edit -> description = $request -> text;
            $edit -> subject_id = $request -> subject;
            $edit -> direction_id = $request -> direction;
            $edit -> class_id = $request -> class;
            $edit -> status_edited = 1;
            $edit -> save();
            return __('site.Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң өзгертіледі');
        }
        switch($material->status_edited) {
            case 1: {
                return __('site.Сіздің сұранысыңыз тексеру барысында. Сайт әкімшілігі тексерген соң өзгертіледі');
                break;
            }case 2: {
                return __('site.Өкінішке орай сайт әкімшілігі сіздің сұранысыңызды өзгертуден бас тартты.');
                break;
            }case 3: {
                return __('site.Сіз материады тек бір рет қана өзгерте аласыз. Сіз материалды соңғы рет өзгерткен мерзім:').'<br/>'.$material->updated_at;
                break;
            }
        }
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

    public function activePromocode(Request $request) {
        $model = PromoCode::where('is_active', '=', 1)->where('code', '=', $request->code)->first();

        if (!$model) {
            abort(404, __('validation.promocode.later'));
        } else {
            $usedPromocodesCount = UsedPromocodes::where('promo_code_id', '=', $model->id)->where('user_id', '=', auth()->user()->id)->count();
        }

        if ($model->to_date < now()) {
            abort(404, __('validation.promocode.later'));
        }

        if ($model->from_date > now()) {
            abort(404, __('validation.promocode.not_found'));
        }

        if ($usedPromocodesCount > 0 ) {
            abort(404, __('validation.promocode.used'));
        }

        $user_subscriptions =  UserSubscription::where('user_id', '=', auth()->user()->id)->first();

        $date = Carbon::createFromFormat('d.m.Y', $user_subscriptions->to_date);
        $date = $date->addDays($model->day);
        $user_subscriptions->to_date = $date;
        $user_subscriptions->save();

        UsedPromocodes::create([
           'user_id' => auth()->user()->id,
           'promo_code_id' => $model->id
        ]);

        return $model;
    }

}
