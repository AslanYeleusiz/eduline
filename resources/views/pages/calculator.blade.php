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
                        @lang('site.Құрметті педагогтер eduline.kz сайтында сіздер өз еңбекақыңызды есептей аласыздар. Калькулятор облыстық, қалалық және аудандық деңгейдегі жалпы білім беретін мектептер қызметкерлерінің жалақысын есептеуге арналған.')
                    </div>
                    <div class="add_info">
                        @lang('site.eduline.kz сайтында арнайы форманы толтырған соң автоматты түрде нақты жалақы сомасы шығады. Сосын оны pdf форматта сақтап алуға болады. Онлайн калькулятор есебін қағазға шығарып, бухгалтерге қайта санатып алыңыз. Еңбек кодексіне сәйкес, бухгалтер сізге ай сайынғы еңбекақыңыз бен ондағы төлемдер, аударымдар жайлы анықтама беруге міндетті.')
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
                                Қарабаева Дана
                            </div>
                            <div class="com_user_info">
                                Алматы қаласы, №35 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Едулайн ұжымы сіздерге рақмет. Сіздердің арқаларыңызда педагог-сарапшы санатына сәтті өттім. Алдағы уақытта зерттеушіге тапсырғым келеді. Менде доступ бір жылға алып тұрақты дайындаламын
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
                                Молбаева Динара
                            </div>
                            <div class="com_user_info">
                                Ақтау қаласы, №85 ЖОМ химия пәні мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Рақмет айналайын, тесттен сәтті өттім. Енді портфолио тапсырамын. Сіздердің мынау бағдарламаны телефонға орнатып алып күнде дайындалдым. Педагогикадан сұрақтар жақсы екен. Оңай тапсырдым
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
                                Утепбергенова Акнур
                            </div>
                            <div class="com_user_info">
                                Шымкент қаласы, №54 ЖОМ қазақ тілі мен әдебиеті мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Қайырлы күн. Сіздер ұсынған тестпен дайындалып, 14.07.2022 жылы қазақ тілі пен әдебиеті пәнінен 57, ал педагогикадан 15 балл алып, жалпы 72 балмен өттім. Істеріңізге сәттілік тілеймін. Ұстаздарға көмектеріңіз тие берсін
                    </div>
                </div>
            </div>
            <div class="com_block">
                <div class="com_head">
                    <div class="wrap">
                        <img alt="com_avatar" class="com_avatar" src="{{asset('images/avatar.png')}}">
                        <div>
                            <div class="com_stars">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Оспанова Жанар
                            </div>
                            <div class="com_user_info">
                                Семей қаласы, №21 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Сәлеметсіздерме! Мер бүгін сіздердің тесттеріңіздің арқасында жақсы балл жинап өттім, рақмет сіздерге. Алла разы болсын, еңбектеріңіздің жемісін көре беріңіздер. 2 сағатта барлық сұрақтарға жауап беріп өтіп кеттім. Ең бастысы тестті қайталай берген дұрыс екен. Барлығы сіздердің берген тесттен келді рақмет көп көп!
                    </div>
                </div>
            </div>
            <div class="com_block">
                <div class="com_head">
                    <div class="wrap">
                        <img alt="com_avatar" class="com_avatar" src="{{asset('images/avatar_default.png')}}">
                        <div>
                            <div class="com_stars">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                                <img alt="star" src="{{asset('images/star.png')}}">
                            </div>
                            <div class="com_user_nm">
                                Мулдиярова Мадина
                            </div>
                            <div class="com_user_info">
                                Семей қаласы, №21 ЖОМ бастауыш сынып мұғалімі
                            </div>
                        </div>
                    </div>
                    <div class="com_body">
                        Қайырлы күн, мен 2 апта бұрын сіздердің приложениені жүктеп тестке жазылғанмын. Шынымды айтсам маған қатты ұнады. Дайындалу өте оңай. Рақмет сіздердің осындай түсінікті қылып дацындалдырып жатқандарыңызға. Кеше күйемді де тіркедім. Оған да ұнаған секілді. Енді кез келген уақытта дайындаламын деп жүр
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
                    <div class="cns_val">425 569</div>
                    <div class="cns_info">
                        @lang('site.Біздің калькуляторды қолданған жалпы ұстаздар саны')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cns_block">
                    <div class="cns_val">25 965</div>
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
