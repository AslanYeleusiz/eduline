@extends('layouts.main')
@section('title', 'Калькулятор | Eduline.kz')
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
<section class="calculate">
    <div class="cst_pd">
        <div class="heading">@lang('site.Ұстаздарға айлық есептеу <br><span class="_orange">калькуляторы</span>')</div>
        <div class="row flex-wrap-reverse">
            <div class="col-md-6">
                <img class="asl_img" src="{{asset('images/appStorelike.png')}}">
            </div>
            <div class="col-md-6">
                <div class="dl_block">
                    <div class="dl_info">
                        @lang('site.Педагогтар мен білім беру ұйымдарының басқа да қызметкерлеріне арналған жалақы калькуляторы – ауылдық жерлерде жұмыс істегені үшін жалақының өсуін ескере отырып, жылдық түзету коэффициентін ескере отырып, біліктілік санатын және мамандығы бойынша жұмыс өтілін ескере отырып, лауазымдық жалақыны есептеуге көмектеседі. , аптасына стандартты оқу жүктемесіне байланысты 2021 жылдың 1 қыркүйегінен бастап белгіленген.')
                    </div>
                    <div class="add_info">
                        @lang('site.Сондай-ақ калькулятор мұғалімдердің лауазымдық жалақысына негізгі қосымша ақылар мен үстемеақыларды есептеуге көмектеседі.')
                    </div>
                    <div class="store_info">
                        @lang('site.Калькуляторды қолдану үшін біздің бағдарламаны телефонға орнатыңыз')
                    </div>
                    <div class="stores">
                        <a href="#"><img src="{{asset('images/appStoreIcon.png')}}" alt=""></a>
                        <a href="#"><img src="{{asset('images/gpStoreIcon.png')}}" alt=""></a>
                    </div>

                    <button class="btn store_button pupup">@lang('site.Телефонға орнату')</button>

                </div>
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
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
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
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
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
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
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
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
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
            @lang('site.Калькулятор нәтижесі')
        </div>
        <div class="cns row">
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">556 569</div>
                    <div class="cns_info">
                        @lang('site.Біздің калькуляторды қолданған жалпы ұстаздар саны')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">355 965</div>
                    <div class="cns_info">
                        @lang('site.Соңғы 30 күнде калькуляторды қолданған ұстаздар саны')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">658</div>
                    <div class="cns_info">
                        @lang('site.Бізден консультация алып айлығын көбейткен ұстаздар саны')
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
                <span class="num">8(778)-389-92-92</span>
                <a href="#"><button onclick="open('https://api.whatsapp.com/send?phone=+77783899292&text=Сәлеметсіз%20бе!%20Тегін%20консультацияға%20жазылғым%20келеді!&amp;utm_source=share2','send',`scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`)"  class="btn chat-btn">@lang('site.Чатқа қосылу')</button></a>
            </div>
        </div>
    </div>
</section>
@endsection
