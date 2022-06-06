@extends('layouts.main')
@section('title', 'Eduline.kz')
@section('content')

<style>
    .menuactive5 {
        background: #3E6CED !important;
        color: #fff !important;
    }

    .menuactive5 .img-svg path,
    .img-svg polygon {
        stroke: #fff;
    }

</style>
<div class="m_href mp_href">
    <div class="cst_pd mp_thref">
        <a href="/materials/my-materials" class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}"><span>@lang('site.Артқа қайту')</span>
        </a>
        <div class="mp_blockhref"> @lang('site.Материал ақпаратын жариялау')</div>
    </div>
</div>
<section class="materials mc">
    <div class="cst_pd">
        <div class="mp_head mc_head">
            @lang('site.Материалыңызды жариялап марапаттар алыңыз')!
        </div>
        <div class="m_block mp_block mc_block pub_block">
            <div class="takyryb pub">
                <div class="pub_body">
                    <img src="{{asset('images/myprofile.svg')}}">
                    <div class="tak_name">Автор: {{Auth::user()->full_name}} <img class="question" src="{{asset('images/question-circle.svg')}}">
                        <div class="hint">@lang('site.Сіз тек өз атыңыздан материал жариялай аласыз')</div>
                        <br><span class="mekeni">{{Auth::user()->place_work}}</span>
                    </div>
                </div>
                <img class="tag_user" src="{{asset('images/tag-user.svg')}}">
            </div>
        </div>
        <div class="m_block mp_block mc_block">
            <form class="m_form" action="{{route('materials.ajaxupload.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <!--FILE DROPZONE-->
                <div class="mb-4 w-100">
                    <label class="form-label">@lang('site.Материал файлын жүктеу')</label>
                    <div class="dropzone my_drop" id="dropzoneForm">
                        <div class="expectations active">
                            <div class="ex"></div>
                            <div class="extension_message">
                                <span class="b">@lang('site.doc, docx, ppt, pptx, pdf')</span><br>
                                @lang('site.файлдарын жүктеуге болады')
                            </div>
                            <a href="#">@lang('site.Файлды жүктеу')</a>
                        </div>
                        <div class="loadedmode">
                            <h4 class="matzharproc"><span id="procofp">0</span>% @lang('site.жүктелуде')...</h4>
                            <div class="lineload">
                                <div class="lineload2"></div>
                            </div>
                        </div>
                        <div class="successmode">
                            <div class="success-animation">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                </svg>
                            </div>
                            <div class="success-informer">
                                @lang('site.Сіздің файлыңыз сәтті жүктелді')
                            </div>
                            <div class="drop-zone__thumb">
                                <span id="file_name">name.jpg</span><img src="{{asset('images/pen.svg')}}"><span class="ah">@lang('site.Өзгерту')</span>
                            </div>
                        </div>
                        <div class="help-block"></div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="file" id="js-file" multiple class="drop-zone__input" required>
                    </div>
                </div>
                <!--               FILE DROPZONE-->
                <div class="mb-4 w-100">
                    <label for="exampleFormControlInput1" class="form-label">@lang('site.Материал тақырыбы')</label>
                    <input name="name" class="form-control" id="exampleFormControlInput1" placeholder="@lang('site.Ашық сабақ Ыбырай Алтынсарин 5 сынып')" required>
                </div>
                <div class="mb-3 w-100">
                    <label for="exampleFormControlTextarea1" class="form-label">@lang('site.Материалдың қысқаша түсінігі')</label>
                    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" placeholder="@lang('site.Қысқаша түсінік ретінде материалдың басқаларға пайдасы, негізгі ойы, форматы туралы ақпарат жазуға болады.')" required></textarea>
                </div>

                <div class="m_control mc_control">
                    <select class="form-select m_box m_cbox g1" name="subject" required>
                        <option value="" disabled hidden selected id="select">Пәнді таңдаңыз</option>
                        @foreach($sub as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-select m_box m_cbox g2" name="direction" required>
                        <option value="" disabled hidden selected id="select">Бағытын таңдаңыз</option>
                        @foreach($dir as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-select m_box m_cbox g3" name="class" required>
                        <option value="" disabled hidden selected id="select">Сыныбын таңдаңыз</option>
                        @foreach($class as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary m_btn">@lang('site.Жариялау')</button>
                <div class="mc_warning">
                    @lang('site.Сіз материалды жариялау арқылы') <a href="#">@lang('site.сайттың ережелерімен')</a> @lang('site.келіскеніңізді растайсыз.')
                </div>
            </form>
        </div>

    </div>
</section>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim.js/4.0.7/Slim.min.js" integrity="sha512-xt1hkdXiNbyEBTZ6SmRqZ4PS/MbhLRB4Lmh6sdwva/n8SsK1YObdaem5ZRKOtyQ32XGukMubvwFow1KnnfzdFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js" integrity="sha512-8cU710tp3iH9RniUh6fq5zJsGnjLzOWLWdZqBMLtqaoZUA6AWIE34lwMB3ipUNiTBP5jEZKY95SfbNnQ8cCKvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
    if ($(window).width() <= '917') {
        select[0].textContent = "@lang('site.Пәні')";
        select[1].textContent = "@lang('site.Бағыты')";
        select[2].textContent = "@lang('site.Сыныбы')";
    } else {
        select[0].textContent = "@lang('site.Пәнді таңдаңыз')";
        select[1].textContent = "@lang('site.Бағытын таңдаңыз')";
        select[2].textContent = "@lang('site.Сыныбын таңдаңыз')";
    }
    $(window).resize(function() {
        if ($(window).width() <= '917') {
            select[0].textContent = "@lang('site.Пәні')";
            select[1].textContent = "@lang('site.Бағыты')";
            select[2].textContent = "@lang('site.Сыныбы')";
        } else {
            select[0].textContent = "@lang('site.Пәнді таңдаңыз')";
            select[1].textContent = "@lang('site.Бағытын таңдаңыз')";
            select[2].textContent = "@lang('site.Сыныбын таңдаңыз')";
        }
    });

</script>
@endsection
