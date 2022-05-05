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
        <a href="#" class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}"><span>Артқа қайту</span>
        </a>
        <div class="mp_blockhref"> Материал ақпаратын өзгерту</div>
    </div>
</div>
<section class="materials mc">
    <div class="cst_pd">
        <div class="mp_head mc_head">
            Материал ақпаратын өзгерту
        </div>
        <div class="m_block mp_block mc_block">
            <div class="mb-4">
                <label for="exampleFormControlInput1" class="form-label">Материал тақырыбы</label>
                <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="Ашық сабақ Ыбырай Алтынсарин 5 сынып">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Материалдың қысқаша түсінігі</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Қысқаша түсінік ретінде материалдың басқаларға пайдасы, негізгі ойы, форматы туралы ақпарат жазуға болады."></textarea>
            </div>
            <form class="m_form" action="">
            <div class="m_control mc_control">
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
            <button class="btn btn-primary m_btn">Өзгерту</button>
            <div class="mc_warning">
                Ескерту: сізге ақпаратты өзгерту үшін 1 ғана мүмкіндік беріледі, сол себепті мұқият жазуыңызды сұраймыз!
            </div>
        </form>
        </div>
    </div>
</section>
<script type="text/javascript">
    if ($(window).width() < '1099' && $(window).width() > '767') {
        select[0].textContent = "Пені";
        select[1].textContent = "Бағыты";
        select[2].textContent = "Сыныбы";
    } else {
        select[0].textContent = "Пәнді таңдаңыз";
        select[1].textContent = "Бағытын таңдаңыз";
        select[2].textContent = "Сыныбын таңдаңыз";
    }
    $(window).resize(function() {
        if ($(window).width() < '1099' && $(window).width() > '767') {
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
