<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <meta name="description" content="Ұстаздар мен тәрбиешілерге арналған материалдар, файлдар. Eduline.kz">
    <meta name="keywords" content="eduline, ұстаздар, мұғалімдер, аттестация, материалдар, білім беру, мектеп">
    <link rel="canonical" href="{{ route('index') }}"/>
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/PNG">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v=1.14">
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
