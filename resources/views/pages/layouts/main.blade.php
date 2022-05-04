<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>

    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    <title>@yield('title')</title>
</head>

<body>
    <div class="mb_menu">
        @yield('app')
        <div class="mb_menubar">
            <a href="/" class="mb_block">
                <img src="{{asset('images/home-2.svg')}}">
                Жаңалықтар
            </a>
            <a href="/attestation" class="mb_block">
                <img src="{{asset('images/note-2.svg')}}">
                Аттестация
            </a>
            <a href="/calculator" class="mb_block menuactive">
                <img src="{{asset('images/calculator.svg')}}">
                Калькулятор
            </a>
            <a class="mb_block">
                <img src="{{asset('images/menubar.png')}}">
                Меню
            </a>
        </div>
    </div>

    <div class="main_wrap">
        <div class="menubar">
            <a href="/">
                <img class="logoimg" src="{{asset('images/logo.png')}}">
            </a>
            <div class="aregistration menuBar">
                <img class="img-svg" src="{{asset('images/user.svg')}}">Кіру / Тіркелу
            </div>
            <div class="menulinia"></div>
            <ul class="menu-ul">
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive1" href="/" class="menu-a">
                        <img class="img-svg" src="{{asset('images/home.svg')}}">
                        Жаңалықтар
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive2" href="/attestation" class="menu-a">
                        <img class="img-svg" src="{{asset('images/note.svg')}}">
                        Аттестация
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive3" href="/calculator" class="menu-a">
                        <img class="img-svg" src="{{asset('images/calculator.svg')}}">
                        Калькулятор
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive4" href="/consultation" class="menu-a">
                        <img class="img-svg" src="{{asset('images/question.svg')}}">
                        Жеке кеңес
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive5" href="/materials" class="menu-a">
                        <img class="img-svg" src="{{asset('images/folder.svg')}}">
                        Материалдар
                    </a>
                </li>
            </ul>
            <a href="tel:+77057455678" class="menuphone">
                <img class="img-svg" src="{{asset('images/phone.svg')}}">
                +7 (705) 745 56 78
            </a>
            <select class="menu-til">
                <option value="kz" selected><img src="{{asset('images/kz.svg')}}"> ҚАЗ</option>
                <!-- <option value="ru"><img src="/images/ru.svg"> РУС</option> -->
            </select>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
