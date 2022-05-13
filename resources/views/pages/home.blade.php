@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('content')
    <style>
    .menuactive1 {
        background: #3E6CED!important;
        color: #fff!important;
    }
    .menuactive1 .img-svg path, .img-svg polygon {
        stroke: #fff;
    }
    .my_materials {
        margin-right: 60px;
    }
</style>
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

<section class="materials">
    <div class="cst_pd">
        
    </div>
</section>
@endsection