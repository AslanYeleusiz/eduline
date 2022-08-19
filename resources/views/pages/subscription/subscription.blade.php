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
            @include('components.subscription')
        </div>
    </section>
@endsection
@section('modals')
@include('components.SubscriptionModal')
@endsection
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
