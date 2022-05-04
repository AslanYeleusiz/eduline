@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('app')
<div class="mb_dop_info">
    <button class="btn store_button mb_btn">Телефонға орнату</button>
</div>
@endsection
@section('content')
<style>
    .menuactive4 {
        background: #3E6CED!important;
        color: #fff!important;
    }
    .menuactive4 .img-svg path, .img-svg polygon {
        stroke: #fff;
    }
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
        <div class="success_info">Сіздің сұранысыңыз сәтті қабылданды!</div>
        <div class="success_message"> Сізге сайт менеджерлері хабарласады</div>
    </div>
</div>
<section class="kenes">
    <div class="cst_pd">
        <div class="heading k_heading">Авторлық бағдарлама <br>жасауды <span class="_orange">тренермен үйрену</span></div>
        <div class="dl_info k_dl_info">
            Құрметті әріптес, тренермен бетпе бет отырып авторлық бағдарламаға тақырып таңдап, жасау жолын және қандай бөлімдерден тұрады, бағандарын қалай толтыру керек, коммисия мүшелеріне қалай өткізу керек, қандай стандартқа сай болу керек барлығын үйреніп шығыңыз.
        </div>
        <div class="add_info k_add_info">
            Сабақ онлайн немесе офлайн форматта тренермен жалғыз өзіңіз отырып үйреніп шығасыз. Сабақтың соңында сізге үлгілері мен стандарттарды және қалай толтыру керектігі туралы толық нұсқаулықты береді.
        </div>
    </div>
    <div class="k_form_block">
        <div class="cst_pd">
            <div class="k_form_head">Консультация бағасы - 7700тг</div>

            <form method="post" action="{{url('kenes/send')}}" class="k_form needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md">
                        <input type="text" class="form-control k_cst_inp" placeholder="Аты-жөніңіз" id="name" name="name" required>
                    </div>
                    <div class="col-md">
                        <input type="text" class="form-control k_cst_inp phone_mask" placeholder="Телефон номеріңіз" id="phone" name="phone" required>
                    </div>
                    <div class="col-md">
                        <button class="btn chat-btn k_btn" type="submit">Консультацияға жазылу</button>
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
            Біздің бағдарлама ұстаздардың пікірлері
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
                                Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін
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
                                Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін
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
                                Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін
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
                                Алматы қаласы, №25 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Нұржамал ханымнан консультация алып, бір ай аралығында авторлық бағларламамды қорғап шықтым. Қазір педагог шебер болдым. Сіздерге үлкен рақмет. Бұрын қиын деп жүрген көп жұмыстарымды оңай бітіріп берді. Сіздерге шығармашылық табыс тілеймін
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="consult_res">
    <div class="cst_pd">
        <div class="com_info">
            Консультация нәтижесі
        </div>
        <div class="cns row">
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">95% балл</div>
                    <div class="cns_info">
                        Бізден консультация алған ұстаздардың қойған баллы
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">556 ұстаз</div>
                    <div class="cns_info">
                        Бізден консультация алған ұстаздардың саны
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">45 мектеп</div>
                    <div class="cns_info">
                        Бізден ұжымдық консультация алған мектептер
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="video_review">
    <div class="cst_pd">
        <div class="com_info">
            Видео отзывтар
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
                    Тегін консултация
                </div>
                <p>
                    Программаны телефонға орнатудан түсінбесеңіз немесе біздің орталық туралы сұрақтарыңыз болса бізге хабарласыңыз, біздің менеджерлер сізге түсіндіріп береді
                </p>
            </div>
            <div class="col-md-1">
                <div class="vl"></div>
            </div>
            <div class="col-md-4">
                <p>Редакциямен байланыс</p>
                <span class="num">8(701)-026-95-95</span>
                <a href="#"><button class="btn chat-btn">Чатқа қосылу</button></a>
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
