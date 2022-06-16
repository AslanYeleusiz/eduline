<div class="mb_menu-slide">
    <div class="mb_header-slide">
        <a href="/">
            <img class="mb_header-logo-img" src="{{asset('images/menu-icons/logo-icon.svg')}}" alt="eduline.kz">
        </a>
        <svg onclick="openMobileSlideMenu()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>

    <div class="body">
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
                <a class="menu-link @if(request()->routeIs('index')||request()->routeIs('news.*')) active @endif" href="{{ route('index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="img-svg replaced-svg">
                        <path d="M9.02 2.84001L3.63 7.04001C2.73 7.74001 2 9.23001 2 10.36V17.77C2 20.09 3.89 21.99 6.21 21.99H17.79C20.11 21.99 22 20.09 22 17.78V10.5C22 9.29001 21.19 7.74001 20.2 7.05001L14.02 2.72001C12.62 1.74001 10.37 1.79001 9.02 2.84001Z" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12 17.99V14.99" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Жаңалықтар
                </a>
            </li>

            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('attestation')) active @endif" href="{{ route('attestation') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="img-svg replaced-svg">
                        <path d="M21.66 10.44L20.68 14.62C19.84 18.23 18.18 19.69 15.06 19.39C14.56 19.35 14.02 19.26 13.44 19.12L11.76 18.72C7.59 17.73 6.3 15.67 7.28 11.49L8.26 7.29999C8.46 6.44999 8.7 5.70999 9 5.09999C10.17 2.67999 12.16 2.02999 15.5 2.81999L17.17 3.20999C21.36 4.18999 22.64 6.25999 21.66 10.44Z" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.06 19.39C14.44 19.81 13.66 20.16 12.71 20.47L11.13 20.99C7.15998 22.27 5.06997 21.2 3.77997 17.23L2.49997 13.28C1.21997 9.31001 2.27997 7.21001 6.24997 5.93001L7.82997 5.41001C8.23997 5.28001 8.62997 5.17001 8.99997 5.10001C8.69997 5.71001 8.45997 6.45001 8.25997 7.30001L7.27997 11.49C6.29997 15.67 7.58998 17.73 11.76 18.72L13.44 19.12C14.02 19.26 14.56 19.35 15.06 19.39Z" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.64 8.53L17.49 9.76" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.66 12.4L14.56 13.14" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Аттестация
                </a>
            </li>
            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('calculator')) active @endif" href="{{ route('calculator') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="img-svg replaced-svg">
                        <path d="M8.33333 18.3334H11.6667C15.8333 18.3334 17.5 16.6667 17.5 12.5V7.50002C17.5 3.33335 15.8333 1.66669 11.6667 1.66669H8.33333C4.16667 1.66669 2.5 3.33335 2.5 7.50002V12.5C2.5 16.6667 4.16667 18.3334 8.33333 18.3334Z" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.75 6.31665V7.14998C13.75 7.83332 13.1917 8.39998 12.5 8.39998H7.5C6.81667 8.39998 6.25 7.84165 6.25 7.14998V6.31665C6.25 5.63332 6.80833 5.06665 7.5 5.06665H12.5C13.1917 5.06665 13.75 5.62498 13.75 6.31665Z" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.7801 11.6667H6.78973" stroke="#3E6CED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.99604 11.6667H10.0057" stroke="#3E6CED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.212 11.6667H13.2216" stroke="#3E6CED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.7801 14.5834H6.78973" stroke="#3E6CED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.99604 14.5834H10.0057" stroke="#3E6CED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.212 14.5834H13.2216" stroke="#3E6CED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Калькулятор
                </a>
            </li>
            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('consultations') || request()->routeIs('consultation')) active @endif" href="{{ route('consultations') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="img-svg replaced-svg">
                        <path d="M17 18.4301H13L8.54999 21.39C7.88999 21.83 7 21.3601 7 20.5601V18.4301C4 18.4301 2 16.4301 2 13.4301V7.42999C2 4.42999 4 2.42999 7 2.42999H17C20 2.42999 22 4.42999 22 7.42999V13.4301C22 16.4301 20 18.4301 17 18.4301Z" stroke="#3E6CED" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12 11.36V11.15C12 10.47 12.42 10.11 12.84 9.82001C13.25 9.54001 13.66 9.18002 13.66 8.52002C13.66 7.60002 12.92 6.85999 12 6.85999C11.08 6.85999 10.34 7.60002 10.34 8.52002" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.9955 13.75H12.0045" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Жеке кеңес
                </a>
            </li>
            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('materials') || request()->routeIs('materials.*')) active @endif" href="{{ route('materials') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="img-svg replaced-svg">
                        <path d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z" stroke="#3E6CED" stroke-width="1.5" stroke-miterlimit="10"></path>
                    </svg>
                    Материалдар
                </a>
            </li>
        </ul>

        <a href="tel:+77057455678" class="menuphone">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="img-svg replaced-svg">
                <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#3E6CED" stroke-width="1.5" stroke-miterlimit="10"></path>
            </svg>
            +7 (705) 745 56 78
        </a>

        <div class="dropdown show">
            <a class="tilder dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
</div>

<div class="overlay" onclick="openMobileSlideMenu()"></div>
