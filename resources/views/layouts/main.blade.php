<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <meta name="description" content="Ұстаздар мен тәрбиешілерге арналған материалдар, файлдар. Eduline.kz">
    <meta name="keywords" content="eduline, ұстаздар, мұғалімдер, аттестация, материалдар, білім беру, мектеп">
    <link rel="canonical" href="{{ route('index') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/PNG">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v=1.16">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}?v=1.1">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}?v=1.1">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}?v=1.1">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">

    @yield('styles')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-v5.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js?v=1') }}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <title>@yield('title')</title>
</head>

<body>
    @yield('modals')
    @include('components.MobileHeader')
    @include('components.MobileMenuSlide')
    @include('components.MobileMenu')

    <div class="loader">
        @include('components.Loader')
    </div>

    <div class="main_wrap">
        @include('components.MenuBar')
        <div class="content">
            @yield('content')
        </div>
    </div>

    @guest
    @include('components.LoginModal')
    @include('components.RegisterModal')
    @include('components.SmsRegisterModal')
    <script>

        let fullName;
        let email;
        let phone;

        let password;
        let password_confirmation;

        let roleId;
        let _token;

        $(".smsCode").keyup(function() {
            console.log('ergerg')
            if (this.value.length == this.maxLength) {
                $(this).next('input').focus();
            }
        });

        $("#registerForm").submit(function(e) {
            e.preventDefault();

            fullName = $('#full_name').val();
            email = $('#register-email').val();
            phone = $('#register-phone').val();

            password = $('#register-password').val();
            password_confirmation = $('#register-password_confirmation').val();

            roleId = $("input[name=role_id]:checked").val();
            _token = $('meta[name="csrf-token"]').attr('content');

            clearInvalidFeedback()

            $(".loader").addClass("loading");

            $.ajax({
                url: "/register/sms-send",
                method: "POST",
                type: "POST",
                data: {
                    '_token': _token,
                    'full_name': fullName,
                    'email': email,
                    'phone': phone,
                    'password': password,
                    'password_confirmation': password_confirmation,
                    'role_id': roleId,
                },
                success: function(res) {
                    $(".loader").removeClass("loading");
                    $("#smsModal .modal-phone").text(phone);
                    $("#smsModal #thisPhone").val(phone);

                    $('.modal').modal('hide');

                    setTimeout(() => {
                        $('#smsModal').modal('show');
                        stopTimer();
                        startTimer();
                    }, 500);
                },
                error: function(err) {
                    $(".loader").removeClass("loading");
                    let response_text = JSON.parse(err.responseText);

                    if (response_text.errors && typeof response_text.errors == 'object') {
                        Object.entries(response_text.errors).forEach(([key, value]) => {
                            $('#error-register-' + key).text(value[0]);
                            $('#error-register-' + key).css('display', 'block');
                        })
                    }

                }
            });



        });

        $('#loginForm').submit(function(e) {
            e.preventDefault();

            let phone = $('#login-phone').val();
            let password = $('#password').val();
            let _token = $('meta[name="csrf-token"]').attr('content');
            let endRoute = $('.endRoute').val();

            $(".loader").addClass("loading");

            clearInvalidFeedback()

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: {
                    'phone': phone,
                    'password': password,
                    '_token': _token,
                    'endRoute': endRoute
                },
                success: function(res) {
                    $(".loader").removeClass("loading");
                    if (res.data && res.data.success) {
                        if (res.data.endRoute != null) window.location.href = '/' + res.data.endRoute;
                        else window.location.reload();
                    }
                },
                error: function(err) {
                    $(".loader").removeClass("loading");
                    let response_text = JSON.parse(err.responseText);
                    if (response_text.errors && typeof response_text.errors == 'object') {
                        Object.entries(response_text.errors).forEach(([key, value]) => {
                            $('#error-login-' + key).text(value[0]);
                            $('#error-login-' + key).css('display', 'block');
                        })
                    }
                }
            });
        });

        $('#smsRegisterForm').submit(function(e) {
            e.preventDefault();

            let code1 = $('.smsCode1').val();
            let code2 = $('.smsCode2').val();
            let code3 = $('.smsCode3').val();
            let code4 = $('.smsCode4').val();

            let code = code1 + code2 + code3 + code4

            let phone = $('#thisPhone').val();

            let _token = $('meta[name="csrf-token"]').attr('content');

            $(".loader").addClass("loading");

            console.log(email)

            clearInvalidFeedback()

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: {
                    '_token': _token,
                    'code': code,
                    'full_name': fullName,
                    'email': email,
                    'phone': phone,
                    'password': password,
                    'role_id': roleId,
                },
                success: function(res) {
                    $(".loader").removeClass("loading");
                    $('.modal').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                },
                error: function(err) {
                    $(".loader").removeClass("loading");
                    let response_text = JSON.parse(err.responseText);
                    if (response_text.errors && typeof response_text.errors == 'object') {
                        Object.entries(response_text.errors).forEach(([key, value]) => {
                            $('#error-sms-modal').text(value[0]);
                            $('#error-sms-modal').css('display', 'block');
                        })
                    }
                }
            });
        });

    </script>
    @endguest


    <script src="{{ asset('js/main.js') }}?v=1"></script>

    @yield('scripts')

    <script>
        @if(session('success'))
        alertModal("{{ session('success') }}")
        @endif

        @error('invalid_link')
        alertWarningModal("{{ $message }}")
        @enderror

    </script>
</body>

</html>
