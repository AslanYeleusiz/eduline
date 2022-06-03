@extends('layouts.main')
@section('title', $pageName)
@section('content')

@component('components.NavBar')
@slot('materials') @endslot
@endcomponent


<section class="materials">
    <div class="cst_pd" id="app">
        <div class="m_head">
            @lang('site.Оқу-әдістемелік материалдар жинағы')
        </div>
        <div class="m_info">
            @lang('site.Сіз үшін 250 000 ұстаздардың еңбегі мен тәжірибесін біріктіріп, ең үлкен материалдар базасын жасадық. Барлық материалдарды сайт қолданушылары тегін жүктеп алып сабағына қолдана алады')
        </div>
        <form class="m_form" action="{{route('materials.search')}}" method="get">
            <div class="m_control">
                <input type="text" class="form-control m_box m_input" name="s" placeholder="@lang('site.Тақырып бойынша іздеу')">
                <button class="btn btn-primary m_btn">@lang('site.Іздеу')</button>
                <select class="form-select m_box m_cbox g1" name="pan">
                    <option value="0" hidden selected id="select">Пәнді таңдаңыз</option>
                    @foreach($materialSubject as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
                <select class="form-select m_box m_cbox g2" name="bagyt">
                    <option value="0" hidden selected id="select">Бағытын таңдаңыз</option>
                    @foreach($materialDirection as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
                <select class="form-select m_box m_cbox g3" name="synyp">
                    <option value="0" hidden selected id="select">Сыныбын таңдаңыз</option>
                    @foreach($materialClass as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="m_val">
            @if($materialCount)
            Барлығы: <span id="value">{{$materialCount}}</span> материал
            @else
            Бұндай материал табылмады.
            @endif
        </div>

        <div class="m_content">
            @foreach($materials as $material)
            <div class="m_block">
                <a target="_blank" href="/materials/item-{{$material->id}}" id="m_head" class="m_block_head">
                    {{$material->title}}
                </a>
                <div id="m_body" class="m_body">
                    {{$material->description}}
                </div>
                <div class="m_footer">
                    <div class="m_item">
                        <img src="{{asset('images/profile-c.png')}}">
                        <span id="name">{{$material->user->full_name}}</span>
                    </div>
                    <div class="m_item">
                        <img src="{{asset('images/calendar.png')}}">
                        <span id="date">{{$material->createdAt($material->created_at)}}</span>
                    </div>
                    <div class="m_item">
                        <img src="{{asset('images/eye.png')}}">
                        <span id="views">{{$material->view}}</span>
                    </div>
                    <div class="m_item">
                        <img src="{{asset('images/re-square.png')}}">
                        <span id="downloads">{{$material->download}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            {{$materials->links('vendor.pagination.default')}}
        </div>

    </div>

</section>

<script src="{{asset('js/app.js')}}"></script>

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
    $(window).resize(function() {
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
