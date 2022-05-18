<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    @yield('styles')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>

<body>
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

<script src="{{ asset('js/sweetalert2.min.js?v=1') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

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
