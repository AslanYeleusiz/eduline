@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('app')
<div class="mb_dop_info">
    <button class="btn store_button mb_btn">Телефонға орнату</button>
</div>
@endsection
@section('content')
<style>
    .menuactive3 {
        background: #3E6CED!important;
        color: #fff!important;
    }
    .menuactive3 .img-svg path, .img-svg polygon {
        stroke: #fff;
    }
    .right_btn {
        background-image: url({{asset('images/arrow-right.png')}})
    }

    .left_btn {
        background-image: url({{asset('images/arrow-right.png')}})
    }
</style>
<div class="mail_send_pupup">
    <div class="send_block t_pupup">
        <div class="esc_btn"><img class="esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="t_pupup_head">
            Смс арқылы жүктеу сілтемесін жібереміз
        </div>
        <span class="t_p_num">
            Телефон номері:
        </span>
        <form action="" method="post" class="needs-validation" novalidate>
            @csrf
            <input type="text" class="form-control t_input" placeholder="+7 (7__) ___-__-__" id="phone" name="phone" required>
            <button class="btn t_pupup_btn">
                Жіберу
            </button>
        </form>

    </div>
</div>
<section class="calculate">
    <div class="cst_pd">
        <div class="heading">Ұстаздарға айлық есептеу <br><span class="_orange">калькуляторы</span></div>
        <div class="row flex-wrap-reverse">
            <div class="col-md-6">
                <img class="asl_img" src="{{asset('images/appStorelike.png')}}">
            </div>
            <div class="col-md-6">
                <div class="dl_block">
                    <div class="dl_info">
                        Расчетчик заработной платы педагогов и других работников организаций образования – поможет рассчитать должностные оклады с учетом квалификационной категории и стажа работы по специальности с учетом ежегодного поправочного коэффициента, с учетом повышения оклада за работу в сельской местности в зависимости от нормативной учебной нагрузки в неделю, установленной с 1 сентября 2021 года.
                    </div>
                    <div class="add_info">
                        Также, расчетчик поможет исчислить основные доплаты и надбавки к должностному окладу педагогов.
                    </div>
                    <div class="store_info">
                        Калькуляторды қолдану үшін біздің бағдарламаны телефонға орнатыңыз
                    </div>
                    <div class="stores">
                        <a href="#"><img src="{{asset('images/appStoreIcon.png')}}" alt=""></a>
                        <a href="#"><img src="{{asset('images/gpStoreIcon.png')}}" alt=""></a>
                    </div>

                    <button class="btn store_button pupup">Телефонға орнату</button>

                </div>
            </div>
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
                    <div class="cns_val">556 569</div>
                    <div class="cns_info">
                        Біздің калькуляторды қолданған ұстаздар саны
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">355 965</div>
                    <div class="cns_info">
                        Соңғы 30 күнде калькуляторды қолданған ұстаздар саны
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">658</div>
                    <div class="cns_info">
                        Бізден консультация алып айлығын көбейткен ұстаздар саны
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
@endsection
