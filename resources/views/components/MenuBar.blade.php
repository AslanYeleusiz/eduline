<div class="menubar">

    <a href="{{ route('index') }}">
        <img class="logo-img" src="{{ asset('images/menu-icons/logo-icon.svg') }}" alt="eduline.kz">
    </a>

    <ul class="menu-ul">
        @guest
            <li class="menu-li">
                <a class="menu-link" onclick="openLogin()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                            stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22"
                              stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    @lang('site.Кіру') / @lang('site.Тіркелу')
                </a>
            </li>
        @endguest

        @auth
            <li class="menu-li">
                <a class="menu-link @if(request()->routeIs('profile.*') || request()->routeIs('profile')) active @endif" href="{{ route('profile') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                            stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22"
                              stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Менің кабинетім
                </a>
            </li>
            <li class="menu-li">
                <a class="menu-link" href="{{ route('logout') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.90002 7.56023C9.21002 3.96023 11.06 2.49023 15.11 2.49023H15.24C19.71 2.49023 21.5 4.28023 21.5 8.75023V15.2702C21.5 19.7402 19.71 21.5302 15.24 21.5302H15.11C11.09 21.5302 9.24002 20.0802 8.91002 16.5402"
                            stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 12H3.62" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M5.85 8.65039L2.5 12.0004L5.85 15.3504" stroke="#3E6CED" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Шығу
                </a>
            </li>
        @endauth
    </ul>

    <div class="menulinia"></div>

    <ul class="menu-ul">
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('index')) active @endif" href="{{ route('index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.02 2.84001L3.63 7.04001C2.73 7.74001 2 9.23001 2 10.36V17.77C2 20.09 3.89 21.99 6.21 21.99H17.79C20.11 21.99 22 20.09 22 17.78V10.5C22 9.29001 21.19 7.74001 20.2 7.05001L14.02 2.72001C12.62 1.74001 10.37 1.79001 9.02 2.84001Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 17.99V14.99" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                @lang('site.Жаңалықтар')
            </a>
        </li>

        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('attestation')) active @endif" href="{{ route('attestation') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21.66 10.44L20.68 14.62C19.84 18.23 18.18 19.69 15.06 19.39C14.56 19.35 14.02 19.26 13.44 19.12L11.76 18.72C7.59 17.73 6.3 15.67 7.28 11.49L8.26 7.29999C8.46 6.44999 8.7 5.70999 9 5.09999C10.17 2.67999 12.16 2.02999 15.5 2.81999L17.17 3.20999C21.36 4.18999 22.64 6.25999 21.66 10.44Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path
                        d="M15.06 19.39C14.44 19.81 13.66 20.16 12.71 20.47L11.13 20.99C7.15998 22.27 5.06997 21.2 3.77997 17.23L2.49997 13.28C1.21997 9.31001 2.27997 7.21001 6.24997 5.93001L7.82997 5.41001C8.23997 5.28001 8.62997 5.17001 8.99997 5.10001C8.69997 5.71001 8.45997 6.45001 8.25997 7.30001L7.27997 11.49C6.29997 15.67 7.58998 17.73 11.76 18.72L13.44 19.12C14.02 19.26 14.56 19.35 15.06 19.39Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.64 8.53L17.49 9.76" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M11.66 12.4L14.56 13.14" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                @lang('site.Аттестация')
            </a>
        </li>
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('calculator')) active @endif" href="{{ route('calculator') }}">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.33333 18.3334H11.6667C15.8333 18.3334 17.5 16.6667 17.5 12.5V7.50002C17.5 3.33335 15.8333 1.66669 11.6667 1.66669H8.33333C4.16667 1.66669 2.5 3.33335 2.5 7.50002V12.5C2.5 16.6667 4.16667 18.3334 8.33333 18.3334Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path
                        d="M13.75 6.31665V7.14998C13.75 7.83332 13.1917 8.39998 12.5 8.39998H7.5C6.81667 8.39998 6.25 7.84165 6.25 7.14998V6.31665C6.25 5.63332 6.80833 5.06665 7.5 5.06665H12.5C13.1917 5.06665 13.75 5.62498 13.75 6.31665Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.7801 11.6667H6.78973" stroke="#3E6CED" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M9.99604 11.6667H10.0057" stroke="#3E6CED" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M13.212 11.6667H13.2216" stroke="#3E6CED" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M6.7801 14.5834H6.78973" stroke="#3E6CED" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M9.99604 14.5834H10.0057" stroke="#3E6CED" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M13.212 14.5834H13.2216" stroke="#3E6CED" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                @lang('site.Калькулятор')
            </a>
        </li>
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('consultation')) active @endif"
               href="{{ route('consultation') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 18.4301H13L8.54999 21.39C7.88999 21.83 7 21.3601 7 20.5601V18.4301C4 18.4301 2 16.4301 2 13.4301V7.42999C2 4.42999 4 2.42999 7 2.42999H17C20 2.42999 22 4.42999 22 7.42999V13.4301C22 16.4301 20 18.4301 17 18.4301Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round"/>
                    <path
                        d="M12 11.36V11.15C12 10.47 12.42 10.11 12.84 9.82001C13.25 9.54001 13.66 9.18002 13.66 8.52002C13.66 7.60002 12.92 6.85999 12 6.85999C11.08 6.85999 10.34 7.60002 10.34 8.52002"
                        stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9955 13.75H12.0045" stroke="#3E6CED" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                @lang('site.Жеке кеңес')
            </a>
        </li>
        <li class="menu-li">
            <a class="menu-link @if(request()->routeIs('materials') || request()->routeIs('materials.*')) active @endif"
               href="{{ route('materials') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z"
                        stroke="#3E6CED" stroke-width="1.5" stroke-miterlimit="10"/>
                </svg>
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
