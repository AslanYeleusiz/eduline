<div class="menubar">
    <a href="/">
        <img class="logoimg" src="{{asset('images/logo.png')}}">
    </a>
    <div class="aregistration menuBar" onclick="openLogin()">
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
    <div class="dropdown show">
        <a class="tilder dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
           aria-expanded="false">
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
