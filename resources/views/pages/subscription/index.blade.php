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
                @include('components.subscription')
            @else
                <div class="page-card">
                    <div class="page-card-title">@lang('site.Жазылым уақыты')</div>
                    <div class="page-card-body">
                        <div class="page-card-info">
                            <div class="page-card-info-title">@lang('site.Жазылым аты'):</div>
                            <div class="page-card-info-name">{{ $userSubscription->subscription->name }}</div>
                        </div>
                        <div class="page-card-info">
                            <div class="page-card-info-title">@lang('site.Уақыты'):</div>
                            <div class="page-card-info-name">{{ $userSubscription->from_date }}
                                - {{ $userSubscription->to_date }}</div>
                        </div>
                    </div>
                    <div class="page-card-actions">
                        <a href="{{ route('profile.show.subscription') }}" class="page-card-button">
                            @lang('site.Жазылымды ұзарту')
                        </a>
                        <div class="page-card-button" onclick="activeCodePopup()">
                            @lang('site.Промокодты енгізу')
                        </div>
                    </div>
                </div>
                <div class="page-card">
                    <div class="page-card-subtitle">@lang('site.Келесі автотөлем алынатын уақыт')</div>
                    <div class="page-card-date">{{ $userSubscription->to_date }}</div>
                    <div class="page-card-button page-card-outline-button">@lang('site.Автотөлемді өшіру')</div>
                </div>
            @endif
        </div>
    </section>
@endsection

@include('components.SubscriptionModal')
@include('components.activeCode')
@include('components.SuccessPromocode')

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

        function activeCodePopup () {
            $('.modal').modal('hide');

            setTimeout(() => {
                $('#activeCodePopup').modal('show');
            }, 500)
        }

        function closeActiveCodePopup () {
            $('.modal').modal('hide');

            if ($("#activeCodePopup").css("display") == "none") {
                window.location.reload();
            }
        }

        $(function () {
            $('#activeCodeForm').submit(function (e) {
                e.preventDefault();

                let code = $('#code').val();

                let _token = $('meta[name="csrf-token"]').attr('content');

                $(".loader").addClass("loading");

                clearInvalidFeedback()

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: {
                        'code': code,
                        '_token': _token
                    },
                    success: function (res) {
                        $(".loader").removeClass("loading");
                        // if (res.data && res.data.success) {
                        //     window.location.reload();
                        // }

                        $('.modal').modal('hide')

                        setTimeout(() => {
                            $('#successPromocode').modal('show');
                        }, 500)

                        $('#table_td_day').text(res.day + ' күн')
                        $('#table_td_time').text('')

                    },
                    error: function (err) {
                        $(".loader").removeClass("loading");

                        $('.invalid.error-code').text(err.responseJSON.message);
                        $('.invalid.error-code').css('display', 'block');

                    }
                });
            });
        })

    </script>
@endsection
