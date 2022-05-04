@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('content')
<style>
    .menuactive4 {
        background: #3E6CED!important;
        color: #fff!important;
    }
    .menuactive4 .img-svg path, .img-svg polygon {
        stroke: #fff;
    }
</style>
<section class="kenesPrev">
    <div class="cst_pd">
        <div class="kp_head">
            Тренерден жеке кеңес
        </div>
        <div class="kp_info">
            Құрметті әріптестер, Қазақстанның ең үздік тренерлерінен жеке кеңес алыңыз
        </div>
        <div class="kp_block">
            <div class="kp_b_info">
                <span><span class="kp_b_head">Авторлық бағдарлама жасауды үйрену</span><br>Консультация</span>
            </div>
            <div class="kp_b_url">
                <div class="kp_btn_1">
                    7700 тг
                </div>
                <a href="/consultation/main" class="kp_btn_2">
                    Толығырақ
                    <img src="{{asset('images/arrow-right.png')}}">
                </a>
            </div>
        </div>
         <div class="kp_block">
            <div class="kp_b_info">
                <span><span class="kp_b_head">Авторлық бағдарлама жасауды үйрену</span><br>Консультация</span>
            </div>
            <div class="kp_b_url">
                <div class="kp_btn_1">
                    7700 тг
                </div>
                <a href="/consultation/main" class="kp_btn_2">
                    Толығырақ
                    <img src="{{asset('images/arrow-right.png')}}">
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
