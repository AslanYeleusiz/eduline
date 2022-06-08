<div class="menubar">

    <a href="{{ route('index') }}">
        <img class="logo-img" src="{{ asset('images/menu-icons/logo-icon.svg') }}" alt="eduline.kz">
    </a>

    <ul class="menu-ul">
        @guest
            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('profile.*') || request()->routeIs('profile')) active @endif" onclick="openLogin()">
                    <img class="img-svg" src="{{asset('images/user.svg')}}">
                    @lang('site.Кіру') / @lang('site.Тіркелу')
                </a>
            </li>
        @endguest

        @auth
            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('profile.*') || request()->routeIs('profile')) active @endif" href="{{ route('profile') }}">
                    <img class="img-svg" src="{{asset('images/user.svg')}}">
                    @lang('site.Жеке кабинет')
                </a>
            </li>
            <li class="menu-li">
                <a class="menu-link" href="{{ route('logout') }}">
                    <img class="img-svg" src="{{asset('images/logout.svg')}}">
                    @lang('site.Шығу')
                </a>
            </li>
        @endauth
    </ul>

    <div class="menulinia"></div>

    <ul class="menu-ul">
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('index')) active @endif" href="{{ route('index') }}">
                <img class="img-svg" src="{{asset('images/home.svg')}}">
                @lang('site.Жаңалықтар')
            </a>
        </li>

        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('attestation')) active @endif" href="{{ route('attestation') }}">
                <img class="img-svg" src="{{asset('images/note.svg')}}">
                @lang('site.Аттестация')
            </a>
        </li>
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('calculator')) active @endif" href="{{ route('calculator') }}">
                <img class="img-svg" src="{{asset('images/calculator.svg')}}">
                @lang('site.Калькулятор')
            </a>
        </li>
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('consultations') || request()->routeIs('consultation')) active @endif" href="{{ route('consultations') }}">
                <img class="img-svg" src="{{asset('images/question.svg')}}">
                @lang('site.Жеке кеңес')
            </a>
        </li>
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('materials') || request()->routeIs('materials.*')) active @endif" @guest onclick="openLogin('materials')" @endguest @auth href="{{ route('materials') }}" @endauth >
                <img class="img-svg" src="{{asset('images/folder.svg')}}">
                @lang('site.Материалдар')
            </a>
        </li>
    </ul>

    <a href="tel:+77057455678" class="menuphone">
        <img class="img-svg" src="{{asset('images/phone.svg')}}">
        +7 (705) 745 56 78
    </a>

    <div class="dropdown show">
        <a class="tilder dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
           aria-expanded="false">
            @if(app()->isLocale('kk'))
                <img src="{{ asset('images/kz.svg') }}"> ҚАЗ
            @else
                <img src="{{ asset('images/ru.svg') }}"> РУС
            @endif
        </a>
        <div class="dropdown-menu tilder-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item tilder-item" href="{{ route('set_locale','kk') }}">
                <img src="{{ asset('images/kz.svg') }}"> ҚАЗ
            </a>
            <a class="dropdown-item tilder-item" href="{{ route('set_locale','ru') }}">
                <img src="{{ asset('images/ru.svg') }}"> РУС
            </a>
        </div>
    </div>
</div>
