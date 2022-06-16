@extends('layouts.main')
@section('title', 'Аттестация | Eduline.kz')
@section('app')
<div class="mb_dop_info">
    <button class="btn store_button mb_btn">@lang('site.Телефонға орнату')</button>
</div>
@endsection
@section('content')
<div class="mail_send_pupup">
    <div class="send_block t_pupup">
        <div class="esc_btn"><img class="esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="t_pupup_head">
            @lang('site.Смс арқылы жүктеу сілтемесін жібереміз')
        </div>
        <span class="t_p_num">
            @lang('site.Телефон номеріңіз'):
        </span>
        <form action="" method="post" class="needs-validation">
            @csrf
            <input type="text" class="form-control phone_mask" placeholder="+7 (___) ___-__-__" id="phone" name="phone" required>
            <button class="btn t_pupup_btn">
                @lang('site.Жіберу')
            </button>
        </form>

    </div>
</div>
<section class="calculate t_sec">
    <div class="cst_pd">
        <div class="heading t_head">@lang('site.Ұлттық біліктілік тестілеуінің <span class="_orange">онлайн <br>байқау сынағы</span>')</div>
        <div class="row">
            <div class="col-md-6">
                <div class="dl_block t_dl_block">
                    <div class="dl_info t_dl_info">
                        @lang('site.<span class="_orange">Eduline.kz</span> – сайтында сіз тегін ұлттық біліктілік тестілеуіне онлайн дайындала аласыз. Сайт 24 сағат бойы жұмыс істейді. Тестке сіз телефон  арқылы қатыса аласыз')
                    </div>
                    <div class="add_info t_add_info">
                        @lang('site.Әр айдың 10-на тест сұрақтары жаңарып отырады. Сондықтан қайта тапсырғанда жаңа сұрақтарды көре аласыз')
                    </div>
                    <div class="store_info t_store_info">
                        @lang('site.Аттестацияға онлайн дайындалу үшін біздің бағдарламаны телефоныңызға орнатыңыз')
                    </div>
                    <div class="stores t_stores">
                        <a href="#"><img src="{{asset('images/appStoreIcon.png')}}"></a>
                        <a href="#"><img src="{{asset('images/gpStoreIcon.png')}}"></a>
                    </div>
                    <button class="btn store_button t_store_button pupup">@lang('site.Телефонға орнату')</button>
                </div>
            </div>
            <div class="col-md-6">
                <img class="asl_img t_img" src="{{asset('images/test.png')}}">
            </div>
        </div>

    </div>
</section>
<section class="calc_comments">
<!--owl-stage-->
    <div class="cst_pd">
        <div class="com_info">
            @lang('site.Біздің бағдарлама жайлы ұстаздардың пікірлері')
        </div>
    </div>
    <div class="owl-stage-outer">
        <div class="cst_com_slider owl-carousel com_cst_pd">
            <div class="com_block">
                <div class="com_head">
                    <div class="row">
                        <div class="col-2"><img class="com_avatar" src="{{asset('images/avatar.png')}}"></div>
                        <div class="col">
                            <div class="com_stars">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Сембиев Нартай Аманғалиұлы
                            </div>
                            <div class="com_user_info">
                                @lang('site.Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі')
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        @lang('site.Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін')
                    </div>
                </div>
            </div>
            <div class="com_block">
                <div class="com_head">
                    <div class="row">
                        <div class="col-2"><img class="com_avatar" src="{{asset('images/avatar.png')}}"></div>
                        <div class="col">
                            <div class="com_stars">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Сембиев Нартай Аманғалиұлы
                            </div>
                            <div class="com_user_info">
                                @lang('site.Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі')
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        @lang('site.Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін')
                    </div>
                </div>
            </div>
            <div class="com_block">
                <div class="com_head">
                    <div class="row">
                        <div class="col-2"><img class="com_avatar" src="{{asset('images/avatar.png')}}"></div>
                        <div class="col">
                            <div class="com_stars">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Сембиев Нартай Аманғалиұлы
                            </div>
                            <div class="com_user_info">
                                @lang('site.Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі')
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        @lang('site.Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін')
                    </div>
                </div>
            </div>
            <div class="com_block">
                <div class="com_head">
                    <div class="row">
                        <div class="col-2"><img class="com_avatar" src="{{asset('images/avatar.png')}}"></div>
                        <div class="col">
                            <div class="com_stars">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                                <img src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Сембиев Нартай Аманғалиұлы
                            </div>
                            <div class="com_user_info">
                                @lang('site.Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі')
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        @lang('site.Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="consult_res">
    <div class="cst_pd">
        <div class="com_info">
            @lang('site.Консультация нәтижесі')
        </div>
        <div class="cns row">
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">556 @lang('site.ұстаз')</div>
                    <div class="cns_info">
                        @lang('site.Біздің бағдарламаны орнатқан ұстаздар саны')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">355 965</div>
                    <div class="cns_info">
                        @lang('site.Біздегі тест сұрақтарының саны')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">45 @lang('site.мектеп')</div>
                    <div class="cns_info">
                        @lang('site.Бізбен бірігіп біліктілік тестілеуге дайындалуда')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="video_review">
    <div class="cst_pd">
        <div class="com_info">
            @lang('site.Видео пікірлер')
        </div>
    </div>
    <div class="v-carousel">
        <div class="owl-carousel cst-carousel">
        <div class="v_block">
            <div class="v_play"></div>
            <video class="video" controls="controls" poster="{{asset('images/banners/v1.png')}}">
                <source src="{{asset('videos/v1.mp4')}}">
            </video>
        </div>
        <div class="v_block">
           <div class="v_play"></div>
            <video class="video" controls="controls" poster="{{asset('images/banners/v1.png')}}">
                <source src="{{asset('videos/v1.mp4')}}">
            </video>
        </div>
        <div class="v_block">
           <div class="v_play"></div>
            <video class="video" controls="controls" poster="{{asset('images/banners/v1.png')}}">
                <source src="{{asset('videos/v1.mp4')}}">
            </video>
        </div>
        <div class="v_block">
           <div class="v_play"></div>
            <video class="video" controls="controls" poster="{{asset('images/banners/v1.png')}}">
                <source src="{{asset('videos/v1.mp4')}}">
            </video>
        </div>
    </div>
    </div>

</section>
<section class="free_cns">
    <div class="cns_bg_block"></div>
    <div class="cns_free_block">
        <div class="row">
            <div class="col-md-7">
                <div class="com_info">
                    @lang('site.Тегін консультация')
                </div>
                <p>
                    @lang('site.Программаны телефонға орнатудан түсінбесеңіз немесе біздің орталық туралы сұрақтарыңыз болса бізге хабарласыңыз, біздің менеджерлер сізге түсіндіріп береді')
                </p>
            </div>
            <div class="col-md-1">
                <div class="vl"></div>
            </div>
            <div class="col-md-4">
                <p>@lang('site.Редакциямен байланыс')</p>
                <span class="num">8(701)-026-95-95</span>
                <a href="#"><button class="btn chat-btn">@lang('site.Чатқа қосылу')</button></a>
            </div>
        </div>
    </div>
</section>
@endsection
