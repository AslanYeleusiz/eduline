@extends('layouts.main')
@section('title', $pageName)
@section('content')

    @component('components.NavBar')
        @slot('materials') @endslot
    @endcomponent

    <section class="materials">
        <div class="cst_pd">
            <div class="m_head">
                Оқу-әдістемелік материалдар жинағы
            </div>
            <div class="m_info">
                Сіз үшін 250 000 ұстаздардың еңбегі мен тәжірибесін біріктіріп, ең үлкен материалдар базасын жасадық.
                Барлық материалдарды сайт қолданушылары тегін жүктеп алып сабағына қолдана алады
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
                        Түркістан облысы Бәйдібек ауданының адами әлеуетті дамыту бөліміне қарасты "С.Ерубаев атындағы
                        жалпы орта мектебі" коммуналдық мемлекеттік мекемесінің тәлімгері
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

    <script type="text/javascript">
        if ($(window).width() <= '917') {
            select[0].textContent = "Пені";
            select[1].textContent = "Бағыты";
            select[2].textContent = "Сыныбы";
        } else {
            select[0].textContent = "Пәнді таңдаңыз";
            select[1].textContent = "Бағытын таңдаңыз";
            select[2].textContent = "Сыныбын таңдаңыз";
        }
        $(window).resize(function () {
            if ($(window).width() <= '917') {
                select[0].textContent = "Пені";
                select[1].textContent = "Бағыты";
                select[2].textContent = "Сыныбы";
            } else {
                select[0].textContent = "Пәнді таңдаңыз";
                select[1].textContent = "Бағытын таңдаңыз";
                select[2].textContent = "Сыныбын таңдаңыз";
            }
        });
    </script>
@endsection
