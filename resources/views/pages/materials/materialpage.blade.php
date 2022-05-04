@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
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
        <button class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}">Артқа қайту
        </button>
        <div class="mp_blockhref"><span>Материалдар / Балабақша / Мақала / Мектепке дейінгі балалар /</span> Балабақшадағы балалардың...</div>
    </div>
</div>
<section class="materials">
    <div class="cst_pd">
        <div class="m_block mp_block">
            <div class="mp_head">
                Балабақшадағы балалардың психологиясы бойынша кеңестер
            </div>
            <div class="mp_info">
                Материал туралы қысқаша түсінік
                1.Балаларды отансүйгіштікке тәрбиелеу және қысқаша тарихына шолу жасай келе, болашақта Қазақстанды өркендетуге білімді жастар керек екендігін түсіндіру. 2.Топпен жұмыс істеу, ой қозғау, сипаттау, баяндау дағдыларын дамыту. 3.Ана тілін, отанын сүюге, елін, жерін қорғауға, қастерлеуге тәрбиелеу. Көрнекілік: Қ.Р рәміздері, Қ.Р конституциясы, компьютерлік слайдтар, қанатты сөздер.
            </div>
            <div class="m_footer">
                <div class="m_item">
                    <img src="{{asset('images/profile-c.png')}}">
                    <span id="name">Сембиев Нартай</span>
                </div>
                <div class="m_item">
                    <img src="{{asset('images/calendar.png')}}">
                    <span id="date">04.12.2021</span>
                </div>
                <div class="m_item">
                    <img src="{{asset('images/eye.png')}}">
                    <span id="views">200</span>
                </div>
                <div class="m_item">
                    <img src="{{asset('images/re-square.png')}}">
                    <span id="downloads">96</span>
                </div>
            </div>
            <div class="mp_sert">
                <img src="{{asset('images/sertif.svg')}}">
                <p>Бұл сертификат «Ustaz tilegi» Республикалық ғылыми – әдістемелік журналының желілік басылымына өз авторлық жұмысын жарияланғанын растайды. Журнал Қазақстан Республикасы Ақпарат және Қоғамдық даму министрлігінің №KZ09VPY00029937 куәлігін алған. Сондықтан материал бұқаралық ақпарат құралына жариялаған болып саналады.</p>
                <div class="mp_btn_group">
                    <button class="btn mp_btn">Сертификатты жүктеу</button>
                    <button class="btn mp_btn">Материалды жүктеу</button>
                    <button class="btn mp_btn">Журналға жіберу</button>
                </div>
            </div>
            <div class="mp_success">
                <img src="{{asset('images/success.svg')}}"> Мaтериалдың толық нұсқасын жүктеп алып, көруге болады
            </div>

            <iframe class="mp_frame" src="{{asset('dddd.htm')}}" frameborder="0"></iframe>

            <div class="mp_btn_pos">
                <button class="btn btn-dark mp_button">
                <img src="{{asset('images/receive.svg')}}" alt="">
                Материалды жүктеу
            </button>
            </div>

            <div class="mp_like">
                Материал ұнаса әріптестеріңізбен бөлісіңіз
                <div class="mp_socseti">
                    <div class="mp_seti s1"><img src="{{asset('images/whatsapp.svg')}}">Ватсапта бөлісу</div>
                    <div class="mp_seti s2"><img src="{{asset('images/telegram.svg')}}">Телеграммда бөлісу</div>
                    <div class="mp_seti s3"><img src="{{asset('images/facebook.svg')}}">Фейсбукта бөлісу</div>
                    <div class="mp_seti s4"><img src="{{asset('images/layer2.svg')}}">Сілтемені көшіру</div>
                </div>
            </div>
        </div>

        <form class="m_form" action="">
            <div class="m_control">
                <input type="text" class="form-control m_box m_input" placeholder="Тақырып бойынша іздеу">
                <button class="btn btn-primary m_btn">Іздеу</button>
                <select class="form-select m_box m_cbox g1">
                    <option hidden selected id="select">Пәнді таңдаңыз</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <select class="form-select m_box m_cbox g2">
                    <option hidden selected id="select">Бағытын таңдаңыз</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <select class="form-select m_box m_cbox g3">
                    <option hidden selected id="select">Сыныбын таңдаңыз</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </form>
        <div class="m_val">
            Барлығы: <span id="value">{value}</span> материал
        </div>

        <div class="m_content">
            <div class="m_block">
                <a target="_blank" href="/materials/item" id="m_head" class="m_block_head">
                    Ашық сабақ "Сап және оның элементтері. Саптық тұрыс"
                </a>
                <div id="m_body" class="m_body">
                    Түркістан облысы Бәйдібек ауданының адами әлеуетті дамыту бөліміне қарасты "С.Ерубаев атындағы жалпы орта мектебі" коммуналдық мемлекеттік мекемесінің тәлімгері
                </div>
                <div class="m_footer">
                    <div class="m_item">
                        <img src="{{asset('images/profile-c.png')}}">
                        <span id="name">Сембиев Нартай</span>
                    </div>
                    <div class="m_item">
                        <img src="{{asset('images/calendar.png')}}">
                        <span id="date">04.12.2021</span>
                    </div>
                    <div class="m_item">
                        <img src="{{asset('images/eye.png')}}">
                        <span id="views">200</span>
                    </div>
                    <div class="m_item">
                        <img src="{{asset('images/re-square.png')}}">
                        <span id="downloads">96</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@endsection
