@extends('layouts.main')
@section('title', 'Жеке кеңес | Eduline.kz')
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
            <div class="heading k_heading">{{$consultation->title}}</span>
            </div>
            <div class="dl_info k_dl_info">
                {{$consultation->description}}
            </div>
            <div class="add_info k_add_info">
                @lang('site.Сабақ онлайн немесе офлайн форматта тренермен жалғыз өзіңіз отырып үйреніп шығасыз. Сабақтың соңында сізге үлгілері мен стандарттарды және қалай толтыру керектігі туралы толық нұсқаулықты береді.')
            </div>
        </div>
        <div class="k_form_block">
            <div class="cst_pd">
                <div class="k_form_head">@lang('site.Консультация бағасы') - {{$consultation->price}} ₸</div>

                <form method="post" action="{{route('consultation.store',['id' => $consultation->id])}}" class="k_form needs-validation forma-ajax">
                    @csrf
                    <div class="row">
                        <div class="col-md">
                            <input type="text" class="form-control k_cst_inp" placeholder="@lang('site.Аты-жөніңіз')" id="name"
                                   name="name" required>
                        </div>
                        <div class="col-md">
                            <input type="text" class="form-control k_cst_inp phone_mask" placeholder="+7 (___) ___-__-__" id="phone" name="phone" required>
                        </div>
                        <div class="col-md">
                            <input type="hidden" name="id" id="id" value="{{ $consultation->id }}">
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
    <div class="owl-stage-outer-wrap">
        <div class="cst_com_slider owl-carousel com_cst_pd">
            <div class="com_block">
                <div class="com_head">
                    <div class="wrap">
                        <img class="com_avatar" src="{{asset('images/comment/Icon_trip1.png')}}">
                        <div>
                            <div class="com_stars">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Жасағанберген Жанар
                            </div>
                            <div class="com_user_info">
                                Алматы қаласы, №11 ЖОМ бастауыш сынып мұғалімі
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
                    <div class="wrap">
                        <img class="com_avatar" src="{{asset('images/comment/Icon_trip2.png')}}">
                        <div>
                            <div class="com_stars">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Сабырбекова Назгул
                            </div>
                            <div class="com_user_info">
                                Шымкент қаласы, №55 ЖОМ химия пәні мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Консултация маған ұнады. Химия пәнінен ғылыми жобаны қалай жазуды толықтай үйреніп шықтым. Алдағы уақытта ҚМЖ бойынша да кеңес алғым келеді. Біз сияқты жас педагогтарға керек екен
                    </div>
                </div>
            </div>
            <div class="com_block">
                <div class="com_head">
                    <div class="wrap">
                        <img alt="avatar" class="com_avatar" src="{{asset('images/comment/Icon_trip3.png')}}">
                        <div>
                            <div class="com_stars">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Калбанова Перизат
                            </div>
                            <div class="com_user_info">
                                Нұр-сұлтан қаласы, №2 ағылшын тілі мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Сіздерге рақмет. Көп көмеген тигізді. Приложение де керемет екен. ҚМЖ жасау бойынша біраз ақпарат алып алдым. Ағылшын тілінен бұрын интернет көп іздеп таба алмайтын едім. Енді өзім жасай беретін болдым
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
                    <a href="#">
                        <button onclick="open('https://api.whatsapp.com/send?phone=+77783899292&text=Сәлеметсіз%20бе!%20Тегін%20консультацияға%20жазылғым%20келеді!&amp;utm_source=share2','send',`scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`)" class="btn chat-btn">@lang('site.Чатқа қосылу')</button>
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

            $('.forma-ajax').submit(function(){


                var id = $("#id").val();
                var name = $("#name").val();
                var phone = $("#phone").val();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    type: "POST",
                    data: {
                        'id': id,
                        'name': name,
                        'phone': phone,
                    },
                    success: function (res) {
                        // $(".loader").removeClass("loading");
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 1500)
                        var tess = id+' - '+name+' - '+phone;
                        // alert(tess);
                        // alert(res);
                    },
                    error: function (err) {
                        // $(".loader").removeClass("loading");
                        // let response_text = JSON.parse(err.responseText);

                        // if (response_text.errors && typeof response_text.errors == 'object') {
                        //     Object.entries(response_text.errors).forEach(([key, value]) => {
                        //         $('#error-register-' + key).text(value[0]);
                        //         $('#error-register-' + key).css('display', 'block');
                        //     })
                        // }
                        // alert("Мәлімет енгізілмеді!");
                    }
                });
            });
        });
    </script>
@endsection
