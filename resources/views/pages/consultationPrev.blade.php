@extends('layouts.main')
@section('title', 'Eduline.kz')
@section('content')

<section class="kenesPrev">
    <div class="cst_pd">
        <div class="kp_head">
            @lang('site.Тренерден жеке кеңес')
        </div>
        <div class="kp_info">
            @lang('site.Құрметті әріптестер, Қазақстанның ең үздік тренерлерінен жеке кеңес алыңыз')
        </div>
        <div class="kp_block">
            <div class="kp_b_info">
                <span><span class="kp_b_head">Авторлық бағдарлама жасауды үйрену</span><br>@lang('site.Жеке кеңес')</span>
            </div>
            <div class="kp_b_url">
                <div class="kp_btn_1">
                    7700 ₸
                </div>
                <a href="/consultation/main" class="kp_btn_2">
                    @lang('site.Толығырақ')
                    <img src="{{asset('images/arrow-right.png')}}">
                </a>
            </div>
        </div>
         <div class="kp_block">
            <div class="kp_b_info">
                <span><span class="kp_b_head">Авторлық бағдарлама жасауды үйрену</span><br>@lang('site.Жеке кеңес')</span>
            </div>
            <div class="kp_b_url">
                <div class="kp_btn_1">
                    7700 ₸
                </div>
                <a href="/consultation/main" class="kp_btn_2">
                    @lang('site.Толығырақ')
                    <img src="{{asset('images/arrow-right.png')}}">
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
