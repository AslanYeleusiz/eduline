@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('content')
<style>
    body {
        background: #F9F9F9;
    }

</style>
<section class="donat">
    <div class="cst_pd">
        <div class="dt_head">Сайтқа жазылып, барлық мүмкіндіктерді шексіз қолданыңыз!</div>
        <div class="dt_advantage">
            <div class="dt_adv_list">
                <div>
                    <div class="dt_adv_block">
                        <img src="{{asset('images/success_circle.png')}}"><span>Аттестацияға шексіз тегін қатысу</span>
                    </div>
                    <div class="dt_adv_block">
                        <img src="{{asset('images/success_circle.png')}}"><span>Материал жариялап - сертификат алу</span>
                    </div>
                    <div class="dt_adv_block">
                        <img src="{{asset('images/success_circle.png')}}"><span>Материал жариялап - алғыс хат алу</span>
                    </div>
                </div>
                <div>
                    <div class="dt_adv_block">
                        <img src="{{asset('images/success_circle.png')}}"><span>Материал жариялап - құрмет грамотасын алу</span>
                    </div>
                    <div class="dt_adv_block">
                        <img src="{{asset('images/success_circle.png')}}"><span>Материалды "Зияткер" журналына жариялау</span>
                    </div>
                    <div class="dt_adv_block">
                        <img src="{{asset('images/success_circle.png')}}"><span>Тренермен жеке кеңеске 15% жеңілдік алу</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row dt_cards">
            <div class="col-md-6 dt_col">
                <div class="dt_block dt_1">
                    <div class="dt_mounth">1 айға жазылу</div>
                    <div class="dt_price">2 590 тг/айына</div>
                    <div class="dt_list">
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">30 күн бойы аттестацияға шексіз қатыса аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материал жариялап сертификат, алғыс хат, грамота аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материалды айына 1 рет жинаққа жібере аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Тренермен жеке кеңеске 15% жеңілдік беріледі</span></div>
                    </div>
                    <div class="dt_btn_block"><button class="btn dt_btn">Таңдау</button></div>
                </div>
                <div class="dt_block dt_2">
                    <div class="dt_mounth">3 айға жазылу</div>
                    <div class="dt_price">1 990 тг/айына</div>
                    <div class="dt_list">
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">30 күн бойы аттестацияға шексіз қатыса аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материал жариялап сертификат, алғыс хат, грамота аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материалды айына 1 рет жинаққа жібере аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Тренермен жеке кеңеске 15% жеңілдік беріледі</span></div>
                    </div>
                    <div class="dt_btn_block"><button class="btn dt_btn">Таңдау</button></div>
                </div>
            </div>
            <div class="col-md-6 dt_col">
                <div class="dt_block dt_3">
                    <div class="dt_mounth">6 айға жазылу</div>
                    <div class="dt_price">1 490 тг/айына</div>
                    <div class="dt_list">
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">30 күн бойы аттестацияға шексіз қатыса аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материал жариялап сертификат, алғыс хат, грамота аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материалды айына 1 рет жинаққа жібере аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Тренермен жеке кеңеске 15% жеңілдік беріледі</span></div>
                    </div>
                    <div class="dt_btn_block"><button class="btn dt_btn">Таңдау</button></div>
                </div>
                <div class="dt_block dt_4">
                    <div class="dt_mounth">12 айға жазылу</div>
                    <div class="dt_price">990 тг/айына</div>
                    <div class="dt_list">
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">30 күн бойы аттестацияға шексіз қатыса аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материал жариялап сертификат, алғыс хат, грамота аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материалды айына 1 рет жинаққа жібере аласыз</span></div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Тренермен жеке кеңеске 15% жеңілдік беріледі</span></div>
                    </div>
                    <div class="dt_btn_block"><button class="btn dt_btn">Таңдау</button></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
