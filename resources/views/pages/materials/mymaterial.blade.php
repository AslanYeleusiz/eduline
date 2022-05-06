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
<div id="popup1" class="my_popup">
    <div class="popup_body">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="popup_main">
            <h2>Материалды жоюға сенімдісіз бе?</h2>
            <p>Материалмен қоса, материал статисткасы жойылады және материал үшін берілген марапаттарды жүктеу мүмкіндігі де қол жетімсіз болады.</p>
            <span>Өтінішті қарау үшін, жою себебін толық жазыңыз</span>
            <form action="" class="needs-validation">
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Материалды жоямын деп шешкен себебім..." required></textarea>
                <button class="btn btn-primary m_btn my_m_btn">Материалды жою</button>
            </form>
        </div>
    </div>
</div>

<div id="popup2" class="my_popup">
    <div class="popup_body">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="popup_main">
            <h2>Журналға жариялауға өтініш жіберу</h2>
            <hr>
            <div class="takyryb">
                <img src="{{asset('images/myfolder.svg')}}" alt="">
                <div class="tak_name">Тақырыбы: Ашық сабақ Ыбырай Алтынсарин 5 сынып</div>
            </div>
            <div class="takyryb">
                <img src="{{asset('images/myprofile.svg')}}" alt="">
                <div class="tak_name">Автор: Сембиев Нартай Амангалиулы<br><span class="mekeni">Павлодар облысы Ақсу қаласы №16 сәбилер бақшасы тәрбиешісі</span></div>
            </div>
            <button class="btn btn-primary m_btn my_m_btn">Журналға жіберу</button>
        </div>
    </div>
    <div class="send_block my_send_block">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="success_message"> Сіздің сұранысыңыз сәтті қабылданды. Сайт әкімшілігі тексерген соң сізге хабарласады</div>
    </div>
</div>
<div class="m_href">
    <div class="cst_pd">
        <div class="m_center">
            <a href="/materials" class="my_materials">
                <img src="{{asset('images/folder-2.png')}}">
                <span>Материалдар</span>
            </a>
            <a href="/materials/my-materials" class="my_materials active">
                <img src="{{asset('images/folder-cloud.png')}}">
                <span>Менің материалдарым</span>
            </a>
        </div>
    </div>
</div>
<section class="materials">
    <div class="cst_pd">
        <div class="m_head">
            Менің материалдарым
        </div>
        <div class="m_info">
            Бұл бетте сіз жариялаған барлық материалдар сайттан өшпей сақталып қалады. Өзіңіздің барлық материалдарыңызды осында тегін жариялап архив ретінде сақтауға болады
        </div>
        <a href="/materials/my-materials/publication"><button class="btn btn-primary m_btn my_m_btn">Материал жариялау</button></a>
        <div class="m_val">
            Барлығы: <span id="value">{value}</span> материал
        </div>
        <div class="m_content">
            <div class="m_block my_m_block">
                <div class="my_m_block_h">
                    <div class="my_m_info">
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
                    <div class="my_edit">
                        <a href="/materials/my-materials/change" class="editBtn"><img src="{{asset('images/edit-2.png')}}"><span>Өзгерту</span></a>
                        <button class="btn deleteBtn pupup1"><img src="{{asset('images/trash.png')}}"><span>Жою</span></button>
                    </div>
                </div>
                <div class="my_m_block_b">
                    <a href="#" id="m_head" class="m_block_head">
                        Ашық сабақ "Сап және оның элементтері. Саптық тұрыс"
                    </a>
                    <div class="m_item my_item">
                        <img src="{{asset('images/profile-c.png')}}">
                        <span id="name">Сембиев Нартай</span>
                    </div>
                    <div id="m_body" class="m_body">
                        Түркістан облысы Бәйдібек ауданының адами әлеуетті дамыту бөліміне қарасты "С.Ерубаев атындағы жалпы орта мектебі" коммуналдық мемлекеттік мекемесінің тәлімгері
                    </div>
                    <div class="my_admin_btns">
                        <a href="#"><button class="btn my_btn c1">
                                Сертификатты жүктеу
                            </button></a>
                        <a href="#"><button class="btn my_btn c2">
                                Алғыс хатты жүктеу
                            </button></a>
                        <a href="#"><button class="btn my_btn c3">
                                Құрмет грамотасын жүктеу
                            </button></a>
                        <button class="btn my_btn c4 popup2">
                            Жинаққа жіберу
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
