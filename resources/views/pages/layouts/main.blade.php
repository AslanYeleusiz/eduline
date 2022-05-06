<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    <title>@yield('title')</title>
</head>

<body>
    <div class="mb_menu">
        @yield('app')
        <div class="mb_menubar">
            <a href="/" class="mb_block">
                <img src="{{asset('images/home-2.svg')}}">
                {{__('site.Жаңалықтар')}}
            </a>
            <a href="/attestation" class="mb_block">
                <img src="{{asset('images/note-2.svg')}}">
                {{__('site.Аттестация')}}
            </a>
            <a href="/calculator" class="mb_block menuactive">
                <img src="{{asset('images/calculator.svg')}}">
                {{__('site.Калькулятор')}}
            </a>
            <a class="mb_block">
                <img src="{{asset('images/menubar.png')}}">
                {{__('site.Мәзір')}}
            </a>
        </div>
    </div>

    <div class="main_wrap">
        <div class="menubar">
            <a href="/">
                <img class="logoimg" src="{{asset('images/logo.png')}}">
            </a>
            <div class="aregistration menuBar">
                <img class="img-svg" src="{{asset('images/user.svg')}}">
                {{__('site.Кіру')}} / {{__('site.Тіркелу')}}
            </div>
            <div class="menulinia"></div>
            <ul class="menu-ul">
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive1" href="/" class="menu-a">
                        <img class="img-svg" src="{{asset('images/home.svg')}}">
                        {{__('site.Жаңалықтар')}}
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive2" href="/attestation" class="menu-a">
                        <img class="img-svg" src="{{asset('images/note.svg')}}">
                        {{__('site.Аттестация')}}
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive3" href="/calculator" class="menu-a">
                        <img class="img-svg" src="{{asset('images/calculator.svg')}}">
                        {{__('site.Калькулятор')}}
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive4" href="/consultation" class="menu-a">
                        <img class="img-svg" src="{{asset('images/question.svg')}}">
                        {{__('site.Жеке кеңес')}}
                    </a>
                </li>
                <li class="menu-li">
                    <a class="menubutton menuBar menuactive5" href="/materials" class="menu-a">
                        <img class="img-svg" src="{{asset('images/folder.svg')}}">
                        {{__('site.Материалдар')}}
                    </a>
                </li>
            </ul>
            <a href="tel:+77057455678" class="menuphone">
                <img class="img-svg" src="{{asset('images/phone.svg')}}">
                +7 (705) 745 56 78
            </a>
<!--             <div class="language_wrap desktop dropdown show">
                <div class="dropdown-menu show" aria-labelledby="dropdownMenu" x-placement="bottom-start">
                    <a href="{{route('set_locale','kk')}}">
                       <span class="flag-icon flag-icon-kk"></span> ҚАЗ
                    </a>
                    <a href="{{route('set_locale','ru')}}">
                       <span class="flag-icon flag-icon-ru"></span> РУС
                    </a>
                </div>
            </div> -->
            <div class="dropdown show">
                <a class="tilder dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(app()->isLocale('kk'))
                    <img src="{{asset('images/kz.svg')}}"> ҚАЗ
                    @else
                    <img src="{{asset('images/ru.svg')}}"> РУС
                    @endif
                </a>
              <div class="dropdown-menu tilder-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item tilder-item" href="{{route('set_locale','kk')}}">
                    <img src="{{asset('images/kz.svg')}}"> ҚАЗ
                </a>
                <a class="dropdown-item tilder-item" href="{{route('set_locale','ru')}}">
                    <img src="{{asset('images/ru.svg')}}"> РУС
                </a>
              </div>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
