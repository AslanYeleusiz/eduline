@extends('layouts.main')
@section('title', 'Eduline.kz')
@section('content')
<section class="news">
    <div class="m_href">
        <div class="cst_pd">
            <div class="cst_container">
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
    <div class="cst_pd">
        <div class="cst_container ns_list">
            <div class="m_block">
                <div class="ns_pre">
                    <div class="ns_cat">Приказдар</div>
                    <div class="ns_time">2 сағат бүрын</div>
                </div>
                <div class="mp_head">
                    На смену ЕНТ может прийти портфолио - глава BTS Education о будущем образования
                </div>
                <div class="mp_info">
                    Әр адамның өз армандары, мақсаттары болады. Біреу тіл үйренгісі келсе, біреу қаржылық жағдайын жақсартқысы келеді...
                </div>
                <div class="ns_img" style="background-image: url({{asset('images/news1.png')}})"></div>
                <div class="ns_pre">
                    <div class="ns_likes">
                    <div class="ns_views"></div>
                    167
                    <div class="ns_comments"></div>
                    8
                    </div>
                    <div class="ns_savebut" style=""></div>
                </div>
            </div>
            <div class="m_block">
                <div class="ns_pre">
                    <div class="ns_cat">Приказдар</div>
                    <div class="ns_time">2 сағат бүрын</div>
                </div>
                <div class="mp_head">
                    На смену ЕНТ может прийти портфолио - глава BTS Education о будущем образования
                </div>
                <div class="mp_info">
                    Әр адамның өз армандары, мақсаттары болады. Біреу тіл үйренгісі келсе, біреу қаржылық жағдайын жақсартқысы келеді...
                </div>
                <div class="ns_img" style="background-image: url({{asset('images/news1.png')}})"></div>
                <div class="ns_pre">
                    <div class="ns_likes">
                    <div class="ns_views"></div>
                    167
                    <div class="ns_comments"></div>
                    8
                    </div>
                    <div class="ns_savebut" style=""></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
