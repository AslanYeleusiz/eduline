@extends('layouts.main')
@section('title', $pageName)
@section('content')
<style>
    .menuactive5 {
        background: #3E6CED !important;
        color: #fff !important;
    }

    .menuactive5 .img-svg path,
    .img-svg polygon {
        stroke: #fff;
    }
</style>
<div class="m_href mp_href">
    <div class="cst_pd mp_thref">
        <a href="/materials" class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}"><span>@lang('site.Артқа қайту')</span>
        </a>
        <div class="mp_blockhref"><span><a href="/materials">@lang('site.Материалдар')</a> / <a href="#">{{$material->subject->name}}</a> / <a href="#">{{$material->direction->name}}</a> / <a href="#">{{$material->class->name}}</a> /</span> {{$material->title}}</div>
    </div>
</div>
<section class="materials">
    <div class="cst_pd">
        <div class="m_block mp_block">
            <div class="mp_head">
                {{$material->title}}
            </div>
            <div class="mp_info">
                @lang('site.Материал туралы қысқаша түсінік')
                {{$material->description}}
            </div>
            <div class="m_footer mp_footer">
                <div class="m_item">
                    <img src="{{asset('images/profile-circle2.svg')}}">
                    <span id="name">{{$material->user->full_name}}</span>
                </div>
                <div class="m_item">
                    <img src="{{asset('images/calendar2.svg')}}">
                    <span id="date">{{$material->createdAt($material->created_at)}}</span>
                </div>
                <div class="m_item">
                    <img src="{{asset('images/eye2.svg')}}">
                    <span id="views">{{$material->view}}</span>
                </div>
                <div class="m_item">
                    <img src="{{asset('images/receive2.svg')}}">
                    <span id="downloads">{{$material->download}}</span>
                </div>
            </div>
            @if($userSub != null)
            <div class="mp_sert">
                <img src="{{asset('images/sertif.svg')}}">
                <div class="p">@lang('site.Бұл сертификат «Ustaz tilegi» Республикалық ғылыми – әдістемелік журналының желілік басылымына өз авторлық жұмысын жарияланғанын растайды. Журнал Қазақстан Республикасы Ақпарат және Қоғамдық даму министрлігінің №KZ09VPY00029937 куәлігін алған. Сондықтан материал бұқаралық ақпарат құралына жариялаған болып саналады.')</div>
                <div class="mp_btn_group">
                    <a href="#"><button class="btn mp_btn">@lang('site.Сертификатты жүктеу')</button></a>
                    <a href="#"><button class="btn mp_btn">@lang('site.Материалды жүктеу')</button></a>
                    <a href="#"><button class="btn mp_btn">@lang('site.Журналға жіберу')</button></a>
                </div>
            </div>
            @endif
            <div class="mp_success">
                <img src="{{asset('images/success.svg')}}"> @lang('site.Мaтериалдың толық нұсқасын жүктеп алып, көруге болады')
            </div>

            @if(pathinfo(storage_path().$material->file_name, PATHINFO_EXTENSION) == 'pdf')
            <iframe src="{{asset('storage')}}/{{$material->file_name}}" width="100%" height="720" frameborder="0"></iframe>
            @else
            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=eduline.kz{{asset('storage')}}/{{$material->file_name}}" width="100%" height="720" frameborder="0"></iframe>
            @endif

            <div class="mp_btn_pos">
                <a href="/materials/{{$material->id}}/download">
                    <button class="btn btn-primary mp_button" id="downloadFile">
                        <img src="{{asset('images/receive.svg')}}" alt="">
                        @lang('site.Материалды жүктеу')
                    </button>
                </a>
            </div>

            <div class="mp_like">
                <span>@lang('site.Материал ұнаса әріптестеріңізбен бөлісіңіз')</span>
                <div class="mp_socseti">
                    <a href="#">
                        <div class="mp_seti mp_cross w"><img src="{{asset('images/whatsapp.svg')}}">@lang('site.Ватсапта бөлісу')</div>
                    </a>
                    <a href="#">
                        <div class="mp_seti mp_cross t"><img src="{{asset('images/telegram.svg')}}">@lang('site.Телеграммда бөлісу')</div>
                    </a>
                    <a href="#">
                        <div class="mp_seti mp_cross f"><img src="{{asset('images/facebook.svg')}}">@lang('site.Фейсбукта бөлісу')</div>
                    </a>
                    <a href="#">
                        <div class="mp_seti s"><img src="{{asset('images/layer2.svg')}}">@lang('site.Сілтемені көшіру')</div>
                    </a>
                </div>
            </div>
            <div class="mp_sert mp_foot_sert">
                <img src="{{asset('images/info-circle.svg')}}">
                <div class="mp_foot_body">
                    @lang('site.БАҚ тіркелгендігі туралы куәлік: 15685-ИА. Материалдарды қайта басуға және де басқа түрде қолдануға, сонымен қоса электрондық БАҚ-да тек қана сайттың әкімшілігінің жазбаша рұқсатымен ғана жүзеге асырылады. Сонымен қатар сайқа сілтеме міндетті түрде болу керек. Егер Сіз біздің сайтта заңсыз түрде материалдар қолданғанын көрсеңіз, сайт әкімшілігіне жеткізіңіз - материалдар жойылады. Редакцияның көзқарасы автордың көзқарасымен сәйкес келмеуі мүмкін.')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
