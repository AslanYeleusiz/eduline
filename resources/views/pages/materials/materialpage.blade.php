@extends('layouts.main')
@section('title', $pageName)
@section('meta')
<meta name="description" content="{{$material->description}}">
<meta name="keywords" content="eduline, ұстаздар, мұғалімдер, аттестация, материалдар, білім беру, мектеп">
<link rel="canonical" href="https://eduline.kz/materials/{{$material->slug($material->title)}}-{{$material->id}}.html">
@endsection
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
<div id="popup2" class="my_popup">
    <div class="popup_body">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="popup_main">
            <h2>@lang('site.Журналға жариялауға өтініш жіберу')</h2>
            <hr>


            <div class="takyryb">
                <img src="{{asset('images/myfolder.svg')}}" alt="">
                <div class="tak_name">@lang('site.Тақырыбы'): <span id="journal_title">{{$material->title}}</span></div>
            </div>
            <div class="takyryb">
                <img src="{{asset('images/myprofile.svg')}}" alt="">
                <div class="tak_name">Автор: <span id="journal_author">{{$material->user->full_name}}</span><br><span class="mekeni">{{$material->user->place_work}}</span>
                </div>
            </div>
            <form action="" method="get" id="ajax-form">
                @csrf
                <input type="hidden" name="material_id" id="material_id" value="{{$material->id}}">
                <button type="button" id="journal_button" class="btn btn-primary m_btn my_m_btn popup_m_btn">@lang('site.Журналға жіберу')</button>
            </form>
        </div>
    </div>
    <div class="send_block my_send_block">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="success_message">
            <div style="display:flex;" id="ajax-loading">
                <div style="margin: 0 auto;" class="spinner-border" role="status">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m_href mp_href">
    <div class="cst_pd mp_thref">
        <a href="/materials" class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}"><span>@lang('site.Артқа қайту')</span>
        </a>
        <div class="mp_blockhref"><span><a href="/materials">@lang('site.Материалдар')</a> /</span> {{$material->title}}</div>
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
            <div class="mp_sert">
                <img src="{{asset('images/sertif.svg')}}">
                <div class="p">@lang('site.Бұл сертификат «Ustaz tilegi» Республикалық ғылыми – әдістемелік журналының желілік басылымына өз авторлық жұмысын жарияланғанын растайды. Журнал Қазақстан Республикасы Ақпарат және Қоғамдық даму министрлігінің №KZ09VPY00029937 куәлігін алған. Сондықтан материал бұқаралық ақпарат құралына жариялаған болып саналады.')</div>
                <div class="mp_btn_group">
                    <a @guest onclick="openLogin()" @else @if($userSub==null)href="{{route('profile.subscription')}}" @else href="/materials/{{$material->id}}/certificate" @endif @endguest><button class="btn mp_btn">@lang('site.Сертификатты жүктеу')</button></a>
                    <a href="/materials/{{$material->id}}/download"><button class="btn mp_btn">@lang('site.Материалды жүктеу')</button></a>
                    <a @guest onclick="openLogin()" @else @if($userSub==null)href="{{route('profile.subscription')}}" @endif @endguest><button class="btn mp_btn @auth @if($userSub!=null) popup2 @endif @endauth">@lang('site.Журналға жіберу')</button></a>
                </div>
            </div>
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
                    <a onclick="open('https://api.whatsapp.com/send?text={{url()->current()}}&amp;utm_source=share2','send',`scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`)" title="WhatsApp">
                        <div class="mp_seti mp_cross w"><img src="{{asset('images/whatsapp.svg')}}">@lang('site.Ватсапта бөлісу')</div>
                    </a>
                    <a onclick="open('https://t.me/share/url?url={{url()->current()}}&amp;utm_source=share2','send',`scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`)" title="Telegram">
                        <div class="mp_seti mp_cross t"><img src="{{asset('images/telegram.svg')}}">@lang('site.Телеграммда бөлісу')</div>
                    </a>
                    <a onclick="open('https://www.facebook.com/sharer.php?src=sp&amp;u={{url()->current()}}&amp;utm_source=share2','send',`scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`)" title="Facebook">
                        <div class="mp_seti mp_cross f"><img src="{{asset('images/facebook.svg')}}">@lang('site.Фейсбукта бөлісу')</div>
                    </a>
                    <a href="#" class="urlLite">
                        <input type="hidden" name="copyUrl" class="copyUrl" value="{{url()->current()}}">
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
<script>
    $(document).on('click', '#ajax-form #journal_button', function() {
        let data = $(this).closest('#ajax-form');
        $.ajax({
            url: '/materials/my-materials/send/journal',
            type: "get",
            datatype: "html",
            data: data.serialize(),
            beforeSend: function() {
                $('.my_send_block').show();
            },
            success: function(response) {
                $('.success_message').html(response);
            },
            error: function(response) {
                $('.success_message').html("Error 404");
            },
        })
    });
    $('.urlLite').on('click', function(e) {
        e.preventDefault();
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($('.copyUrl').val()).select();
        document.execCommand("copy");
        alert("@lang('site.Сілтеме көшірілді')!");
    })

</script>
@endsection
