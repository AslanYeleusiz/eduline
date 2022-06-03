<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Models\Material;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;
use App\Models\SendingMaterialJournal;
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

    public function materials(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $materials = Material::where('status_deleted','=',null)->orWhere('status_deleted','<',3)->orderBy('created_at','desc')->paginate(5);
        $pageName = __('site.Материалдар');
        return view('pages.materials.index', [
            'materials' => $materials,
            'materialCount' => $materials->count(),
            'materialSubject' => MaterialSubject::get(),
            'materialDirection' => MaterialDirection::get(),
            'materialClass' => MaterialClass::get(),
            'pageName' => $pageName
        ]);
    }
    public function search(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pan = $request->pan;
        $bagyt = $request->bagyt;
        $synyp = $request->synyp;
        $materials = new Material();
        if($pan>1) $materials = $materials->where('subject_id','=',"{$pan}");
        if($bagyt>1) $materials = $materials->where('direction_id','=',"{$bagyt}");
        if($synyp>1) $materials = $materials->where('class_id','=',"{$synyp}");
        if($request->s!=null) $materials = $materials->where('title','LIKE',"%{$request->s}%");
        $materialCount = $materials->count();
        $materials = $materials->orderBy('id','desc')->paginate(5);

        $pageName = __('site.Материалдар');
        return view('pages.materials.index', [
            'materials' => $materials,
            'materialCount' => $materialCount,
            'materialSubject' => MaterialSubject::get(),
            'materialDirection' => MaterialDirection::get(),
            'materialClass' => MaterialClass::get(),
            'pan' => $pan,
            'bagyt' => $bagyt,
            'synyp' => $synyp
        ], compact('pageName'));
    }
    public function material($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $material = Material::find($id);
        $material->increment('view');
        $pageName = __('site.Материал');
        return view('pages.materials.materialpage', [
            'material' => $material
        ], compact('pageName'));
    }

    public function myMaterials(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $material = Material::where('user_id','=',auth()->user()->id)->where('status_deleted','=',null)->orWhere('status_deleted','<',3)->orderBy('created_at','desc')->paginate(5);
        $pageName = __('site.Менің материалдарым');
        return view('pages.materials.my-materials',compact('pageName','material'));
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
    public function changed($id, Request $request)
    {
        $material = Material::find($id);
        $material -> title = $request -> name;
        $material -> description = $request -> text;
        $material -> subject_id = $request -> subject;
        $material -> direction_id = $request -> direction;
        $material -> class_id = $request -> class;
        $material -> save();
        return redirect()->back()->withSuccess('Материял сатты жуктелды');
    }

    public function delete(Request $request)
    {
        $material = Material::find($request->material_id);
        $material -> comment_when_deleted = $request -> comment;
        $material -> status_deleted = 1;
        $material -> save();
        return redirect()->back()->withSuccess('Материял қарастыруға жуктелды');
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
                return "Сіздің сұранысыңыз қабылдау барысында. Сайт әкімшілігі тексерген соң сізге хабарласады";

            $data = 'Сіздің сұранысыңыз тексерілді. Сайт әкімшілігі жинаққа жіберуді ';
            $journal->status==1 ? $data.="қабылдамады" : $data.="қабылдады";
            return $data;
        }
        return "Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң сізге хабарласады";
    }


}
