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

        <?php 
        if(count($consultations) != 0)
        {
        foreach ($consultations as $key => $value) { ?>
            <div class="kp_block">
                <div class="kp_b_info">
                    <span>
                        <span class="kp_b_head">{{$value->title}}</span><br>
                        @lang('site.Жеке кеңес')
                    </span>
                </div>
                <div class="kp_b_url">
                    <div class="kp_btn_1">
                        {{$value->price}} ₸
                    </div>
                    <a href="/consultation/{{$value->id}}" class="kp_btn_2">
                        @lang('site.Толығырақ')
                        <img src="{{asset('images/arrow-right.png')}}">
                    </a>
                </div>
            </div>
        <?php } 
        } else { ?>
            <div class="kp_block">
                <div class="kp_b_info">
                    <span>
                        <span class="kp_b_head">@lang('site.Әзірше жеке кеңес сайтқа енгізілмеді.')</span><br>
                    </span>
                </div>
            </div>
        <?php } ?>
        
        <!--Пагинация қосу керек-->

    </div>
</section>

@endsection
