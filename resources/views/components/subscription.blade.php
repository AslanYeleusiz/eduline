<div class="dt_head">@lang('site.Сайтқа жазылып, барлық мүмкіндіктерді шексіз қолданыңыз')!</div>
<div class="dt_advantage">
    <div class="dt_adv_list">
        <div>
            <div class="dt_adv_block">
                <img
                    src="{{asset('images/success_circle.png')}}"><span>@lang('site.Аттестацияға шексіз тегін қатысу')</span>
            </div>
            <div class="dt_adv_block">
                <img
                    src="{{asset('images/success_circle.png')}}"><span>@lang('site.Материал жариялап - сертификат алу')</span>
            </div>
            <div class="dt_adv_block">
                <img
                    src="{{asset('images/success_circle.png')}}"><span>@lang('site.Материал жариялап - алғыс хат алу')</span>
            </div>
        </div>
        <div>
            <div class="dt_adv_block">
                <img src="{{asset('images/success_circle.png')}}"><span>@lang('site.Материал жариялап - құрмет грамотасын алу')</span>
            </div>
            <div class="dt_adv_block">
                <img src="{{asset('images/success_circle.png')}}"><span>@lang('site.Материалды «Eduline.kz» журналына жариялау')</span>
            </div>
            <div class="dt_adv_block">
                <img src="{{asset('images/success_circle.png')}}"><span>@lang('site.Тренермен жеке кеңеске 15% жеңілдік алу')</span>
            </div>
        </div>
    </div>
</div>
<div class="row dt_cards">
    @php
        $backgrounds = [0 => 'dt_1',1 => 'dt_2', 2 => 'dt_3' , 3 => 'dt_4'];
    @endphp

    @if($subscriptions->count() > 0)
        @foreach($subscriptions as $key => $subscription)
            <div class="col-md-6 dt_col">
                <div class="dt_block {{ $backgrounds[$key] }}">
                    <div class="dt_mounth">{{ $subscription->name }}</div>
                    <div class="dt_price">{{ number_format($subscription->price, 0, ' ', ' ') }}
                        @lang('site.₸/айына')
                    </div>
                    <div class="dt_list">
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">@lang('site.30 күн бойы аттестацияға шексіз қатыса аласыз')</span>
                        </div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">@lang('site.Материал жариялап сертификат, алғыс хат, грамота аласыз')</span>
                        </div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">@lang('site.Материалды айына бір рет жинаққа жібере аласыз')</span>
                        </div>
                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">@lang('site.Тренермен жеке кеңеске 15% жеңілдік беріледі')</span>
                        </div>
                    </div>
                    <div class="dt_btn_block">
                        <button class="btn dt_btn" onclick="subscriptionModal(this)">@lang('site.Таңдау')</button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
