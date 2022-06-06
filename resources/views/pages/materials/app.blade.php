<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Materials</title>
</head>

<body>
    @include('components.MobileMenu')

    <div class="loader">
        @include('components.Loader')
    </div>

    <div class="main_wrap">
        @include('components.MenuBar')
        <div class="content">
            <section class="materials">
                <div class="cst_pd" id="app">
                    <div class="m_head">
                        Оқу-әдістемелік материалдар жинағы
                    </div>
                    <div class="m_info">
                        Сіз үшін 250 000 ұстаздардың еңбегі мен тәжірибесін біріктіріп, ең үлкен материалдар базасын жасадық.
                        Барлық материалдарды сайт қолданушылары тегін жүктеп алып сабағына қолдана алады
                    </div>
                    <form class="m_form" action="{{route('materials.search')}}" method="get">
                        <div class="m_control">
                            <input type="text" class="form-control m_box m_input" name="s" placeholder="Тақырып бойынша іздеу">
                            <button class="btn btn-primary m_btn">Іздеу</button>
                            <select class="form-select m_box m_cbox g1" name="pan">
                                <option value="0" hidden selected id="select">Пәнді таңдаңыз</option>
                                @foreach($materialSubject as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-select m_box m_cbox g2" name="bagyt">
                                <option value="0" hidden selected id="select">Бағытын таңдаңыз</option>
                                @foreach($materialDirection as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-select m_box m_cbox g3" name="synyp">
                                <option value="0" hidden selected id="select">Сыныбын таңдаңыз</option>
                                @foreach($materialClass as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <div class="m_val">
                        @if($materialCount)
                        Барлығы: <span id="value">{{$materialCount}}</span> материал
                        @else
                        Бұндай материал табылмады.
                        @endif
                    </div>

                    @inertia


                    <div class="m_content">
                        @foreach($materials as $material)
                        <div class="m_block">
                            <a target="_blank" href="/materials/item-{{$material->id}}" id="m_head" class="m_block_head">
                                {{$material->title}}
                            </a>
                            <div id="m_body" class="m_body">
                                {{$material->description}}
                            </div>
                            <div class="m_footer">
                                <div class="m_item">
                                    <img src="{{asset('images/profile-c.png')}}">
                                    <span id="name">{{$material->user->full_name}}</span>
                                </div>
                                <div class="m_item">
                                    <img src="{{asset('images/calendar.png')}}">
                                    <span id="date">{{$material->created_at}}</span>
                                </div>
                                <div class="m_item">
                                    <img src="{{asset('images/eye.png')}}">
                                    <span id="views">{{$material->view}}</span>
                                </div>
                                <div class="m_item">
                                    <img src="{{asset('images/re-square.png')}}">
                                    <span id="downloads">{{$material->download}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{$materials->links('vendor.pagination.default')}}
                    </div>

                </div>

            </section>

            <script src="{{asset('js/app.js')}}"></script>

            <script type="text/javascript">
                if ($(window).width() <= '917') {
                    select[0].textContent = "Пені";
                    select[1].textContent = "Бағыты";
                    select[2].textContent = "Сыныбы";
                } else {
                    select[0].textContent = "Пәнді таңдаңыз";
                    select[1].textContent = "Бағытын таңдаңыз";
                    select[2].textContent = "Сыныбын таңдаңыз";
                }
                $(window).resize(function() {
                    if ($(window).width() <= '917') {
                        select[0].textContent = "Пені";
                        select[1].textContent = "Бағыты";
                        select[2].textContent = "Сыныбы";
                    } else {
                        select[0].textContent = "Пәнді таңдаңыз";
                        select[1].textContent = "Бағытын таңдаңыз";
                        select[2].textContent = "Сыныбын таңдаңыз";
                    }
                });

            </script>
        </div>
    </div>

    @guest
    @include('components.LoginModal')
    @include('components.RegisterModal')
    @endguest

    <script src="{{ asset('js/sweetalert2.min.js?v=1') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

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
