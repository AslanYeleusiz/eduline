@extends('layouts.main')
@section('title', 'Eduline.kz')
@section('app')
    <div class="mb_dop_info">
        <button class="btn store_button mb_btn">@lang('site.Телефонға орнату')</button>
    </div>
@endsection
@section('content')
    <style>
        .content {
            background: #ffffff;
        }

        .right_btn {
            background-image: url({{asset('images/arrow-right.png')}})
        }

        .left_btn {
            background-image: url({{asset('images/arrow-right.png')}})
        }
    </style>
    <div class="mail_send_pupup">
        <div class="send_block">
            <div class="esc_btn"><img src="{{asset('images/escape.png')}}"></div>
            <div class="success_info">@lang('site.Сіздің сұранысыңыз сәтті қабылданды')!</div>
            <div class="success_message">@lang('site.Сізге сайт менеджерлері хабарласады')</div>
        </div>
    </div>
    <section class="kenes">
        <div class="cst_pd">
            <div class="heading k_heading">Авторлық бағдарлама <br>жасауды <span class="_orange">тренермен үйрену</span>
            </div>
            <div class="dl_info k_dl_info">
                Құрметті әріптес, тренермен бетпе бет отырып авторлық бағдарламаға тақырып таңдап, жасау жолын және
                қандай бөлімдерден тұрады, бағандарын қалай толтыру керек, коммисия мүшелеріне қалай өткізу керек,
                қандай стандартқа сай болу керек барлығын үйреніп шығыңыз.
            </div>
            <div class="add_info k_add_info">
                @lang('site.Сабақ онлайн немесе офлайн форматта тренермен жалғыз өзіңіз отырып үйреніп шығасыз. Сабақтың соңында сізге үлгілері мен стандарттарды және қалай толтыру керектігі туралы толық нұсқаулықты береді.')
            </div>
        </div>
        <div class="k_form_block">
            <div class="cst_pd">
                <div class="k_form_head">@lang('site.Консультация бағасы') - 7700 ₸</div>

                <form method="post" action="{{url('kenes/send')}}" class="k_form needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md">
                            <input type="text" class="form-control k_cst_inp" placeholder="@lang('site.Аты-жөніңіз')" id="name"
                                   name="name" required>
                        </div>
                        <div class="col-md">
                            <input type="text" class="form-control k_cst_inp phone_mask" placeholder="+7 (___) ___ __ __"
                                   id="phone" name="phone" required>
                        </div>
                        <div class="col-md">
                            <button class="btn chat-btn k_btn" type="submit">@lang('site.Консультацияға жазылу')</button>
                        </div>
                    </div>
                </form>
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
                        <div class="cns_val">95% балл</div>
                        <div class="cns_info">
                            @lang('site.Бізден консультация алған ұстаздардың қойған баллы')
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cns_block">
                        <div class="cns_val">556 @lang('site.ұстаз')</div>
                        <div class="cns_info">
                            @lang('site.Бізден консультация алған ұстаздардың саны')
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cns_block">
                        <div class="cns_val">45 @lang('site.мектеп')</div>
                        <div class="cns_info">
                            @lang('site.Бізден ұжымдық консультация алған мектептер')
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
                        @lang('site.Тегін консултация')
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
                    <span class="num">+7 701 026 95 95</span>
                    <a href="#">
                        <button class="btn chat-btn">@lang('site.Чатқа қосылу')</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        form.classList.add('was-validated');
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            //Свой код вставить сюда при условии что обе input заполнены(input`s in kenes.blade.php)
                        }
                    }, false)
                })
        })();
    </script>
@endsection
