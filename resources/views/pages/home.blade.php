@extends('layouts.main')
@section('title', 'Eduline.kz')
@section('content')
<div class="m_href">
    <div class="cst_pd">
        <div class="m_center">
            <a href="/" class="my_materials active">
                <img class="img-svg" src="{{asset('images/zhan-1.svg')}}">
                <span>{{__('site.Барлығы')}}</span>
            </a>
            <a href="#" class="my_materials">
                <img class="img-svg" src="{{asset('images/zhan-2.svg')}}">
                <span>{{__('site.Хабарландыру')}}</span>
            </a>
            <a href="#" class="my_materials">
                <img class="img-svg" src="{{asset('images/zhan-2.svg')}}">
                <span>{{__('site.Танымал')}}</span>
            </a>
            <a href="#" class="my_materials">
                <img class="img-svg" src="{{asset('images/zhan-3.svg')}}">
                <span>{{__('site.Сақталғандар')}}</span>
            </a>
        </div>
    </div>
</div>

    <section class="welcome">
        <div class="container">
            {{__('site.Продукты')}}
        </div>
    </section>
@endsection
