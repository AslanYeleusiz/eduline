@extends('layouts.main')
@section('title', $pageName)
@section('content')
    <style>
        body {
            background: #F9F9F9;
        }
    </style>

    @component('components.NavBar')
        @slot('profile') @endslot
    @endcomponent

    <section class="donat">
        <div class="cst_pd">

            @if(!$userSubscription)
                <div class="dt_head">Сайтқа жазылып, барлық мүмкіндіктерді шексіз қолданыңыз!</div>
                <div class="dt_advantage">
                    <div class="dt_adv_list">
                        <div>
                            <div class="dt_adv_block">
                                <img
                                    src="{{asset('images/success_circle.png')}}"><span>Аттестацияға шексіз тегін қатысу</span>
                            </div>
                            <div class="dt_adv_block">
                                <img
                                    src="{{asset('images/success_circle.png')}}"><span>Материал жариялап - сертификат алу</span>
                            </div>
                            <div class="dt_adv_block">
                                <img
                                    src="{{asset('images/success_circle.png')}}"><span>Материал жариялап - алғыс хат алу</span>
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
                    @php
                        $backgrounds = [0 => 'dt_1',1 => 'dt_2', 2 => 'dt_3' , 3 => 'dt_4'];
                    @endphp

                    @if($subscriptions->count() > 0)
                        @foreach($subscriptions as $key => $subscription)
                            <div class="col-md-6 dt_col">
                                <div class="dt_block {{ $backgrounds[$key] }}">
                                    <div class="dt_mounth">{{ $subscription->name }}</div>
                                    <div class="dt_price">{{ number_format($subscription->price, 0, ' ', ' ') }}
                                        тг/айына
                                    </div>
                                    <div class="dt_list">
                                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">30 күн бойы аттестацияға шексіз қатыса аласыз</span>
                                        </div>
                                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материал жариялап сертификат, алғыс хат, грамота аласыз</span>
                                        </div>
                                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Материалды айына 1 рет жинаққа жібере аласыз</span>
                                        </div>
                                        <div><img src="{{asset('images/circle_b.png')}}"><span class="dt_info">Тренермен жеке кеңеске 15% жеңілдік беріледі</span>
                                        </div>
                                    </div>
                                    <div class="dt_btn_block">
                                        <button class="btn dt_btn" onclick="subscriptionModal(this)">Таңдау</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="page-card">
                    <div class="page-card-title"> Жазылым уақыты</div>
                    <div class="page-card-body">
                        <div class="page-card-info">
                            <div class="page-card-info-title">Жазылым аты:</div>
                            <div class="page-card-info-name">{{ $userSubscription->subscription->name }}</div>
                        </div>
                        <div class="page-card-info">
                            <div class="page-card-info-title">Уақыты:</div>
                            <div class="page-card-info-name">{{ $userSubscription->from_date }}
                                - {{ $userSubscription->to_date }}</div>
                        </div>
                    </div>
                    <div class="page-card-actions">
                        <div class="page-card-button">
                            Жазылымды ұзарту
                        </div>
                        <div class="page-card-button">
                            Промокодты енгізу
                        </div>
                    </div>
                </div>
                <div class="page-card">
                    <div class="page-card-subtitle">Келесі автотөлем алынатын уақыт</div>
                    <div class="page-card-date">{{ $userSubscription->to_date }}</div>
                    <div class="page-card-button page-card-outline-button">Автотөлемді өшіру</div>
                </div>
            @endif
        </div>
    </section>
@endsection

@include('components.SubscriptionModal')

@section('scripts')
    <script>
        function subscriptionModal(event) {
            $('.modal').modal('hide');

            let subscriptionName = $.trim($(event).closest('.dt_col').find('.dt_mounth').text())
            let subscriptionPrice = $.trim($(event).closest('.dt_col').find('.dt_price').text())

            let whatsappSendPhone = "77712345599";
            let whatsappSendText = `Сәлеметсізбе! Бағасы ${subscriptionPrice} тұратын, "${subscriptionName}" атты жазылым бойынша жазып тұр едім`

            let whatsappHrefAttribute = `https://api.whatsapp.com/send?phone=${whatsappSendPhone}&text=${whatsappSendText}`;

            $(".pay-variant-item").each(function () {
                $(this).attr("href", whatsappHrefAttribute)
            })

            setTimeout(() => {
                $('#subscriptionPayPopup').modal('show');
            }, 500)
        }
    </script>
@endsection
