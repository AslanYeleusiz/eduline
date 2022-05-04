@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('content')
<style>
    .menuactive5 {
        background: #3E6CED!important;
        color: #fff!important;
    }
    .menuactive5 .img-svg path, .img-svg polygon {
        stroke: #fff;
    }
</style>
<div class="m_href">
    <div class="cst_pd">
        <div class="m_center">
            <a href="/materials" class="my_materials">
                <img src="{{asset('images/folder-2.png')}}">
                <span>Материалдар</span>
            </a>
            <a href="/materials/edit" class="my_materials active">
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

        <button class="btn btn-primary m_btn my_m_btn">Материал жариялау</button>


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
                        <a href="#" class="editBtn"><img src="{{asset('images/edit-2.png')}}"><span>Өзгерту</span></a>
                        <a href="#" class="deleteBtn"><img src="{{asset('images/trash.png')}}"><span>Жою</span></a>
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
                        <button class="btn my_btn c1">
                            Сертификатты жүктеу
                        </button>
                        <button class="btn my_btn c2">
                            Алғыс хатты жүктеу
                        </button>
                        <button class="btn my_btn c3">
                            Құрмет грамотасын жүктеу
                        </button>
                        <button class="btn my_btn c4">
                            Жинаққа жіберу
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>
@endsection
