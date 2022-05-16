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
