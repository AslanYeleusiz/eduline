@extends('pages.layouts.main')
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
        <a href="#" class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}"><span>Артқа қайту</span>
        </a>
        <div class="mp_blockhref"> Материал ақпаратын өзгерту</div>
    </div>
</div>
<section class="materials mc">
    <div class="cst_pd">
        <div class="mp_head mc_head">
            Материалыңызды жариялап марапаттар алыңыз!
        </div>
        <div class="m_block mp_block mc_block pub_block">
            <div class="takyryb pub">
                <div class="pub_body">
                    <img src="{{asset('images/myprofile.svg')}}">
                    <div class="tak_name">Автор: Сембиев Нартай Амангалиулы <img class="question" src="{{asset('images/question-circle.svg')}}">
                        <div class="hint">Сіз тек өз атыңыздан материал жариялай аласыз</div>
                        <br><span class="mekeni">Павлодар облысы Ақсу қаласы №16 сәбилер бақшасы тәрбиешісі</span>
                    </div>
                </div>
                <img class="tag_user" src="{{asset('images/tag-user.svg')}}">
            </div>
        </div>
        <div class="m_block mp_block mc_block">
            <form class="m_form" action="" method="" enctype="multipart/form-data">

                <!--FILE DROPZONE-->
                <div class="mb-4 w-100">
                    <label class="form-label">Материал файлын жүктеу</label>
                    <div class="dropzone my_drop" id="dropzoneForm">
                        <div class="expectations active">
                            <div class="ex"></div>
                            <div class="extension_message">
                                <span class="b">doc, docx, ppt, pptx, pdf</span><br>
                                файлдарын жүктеуге болады
                            </div>
                            <a href="#">Файлды жүктеу</a>
                        </div>
                        <div class="loadedmode">
                            <h4 class="matzharproc"><span id="procofp">0</span>% жүктелуде...</h4>
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
                                Сіздің файлыңыз <span class="drop-zone__thumb">asdasd.svg</span> сәтті жүктелді
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="file" multiple class="drop-zone__input">
                    </div>
                </div>
                <!--               FILE DROPZONE-->
                <div class="mb-4 w-100">
                    <label for="exampleFormControlInput1" class="form-label">Материал тақырыбы</label>
                    <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="Ашық сабақ Ыбырай Алтынсарин 5 сынып">
                </div>
                <div class="mb-3 w-100">
                    <label for="exampleFormControlTextarea1" class="form-label">Материалдың қысқаша түсінігі</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Қысқаша түсінік ретінде материалдың басқаларға пайдасы, негізгі ойы, форматы туралы ақпарат жазуға болады."></textarea>
                </div>

                <div class="m_control mc_control">
                    <select class="form-select m_box m_cbox g1">
                        <option hidden selected id="select">Пәнді таңдаңыз</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="form-select m_box m_cbox g2">
                        <option hidden selected id="select">Бағытын таңдаңыз</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="form-select m_box m_cbox g3">
                        <option hidden selected id="select">Сыныбын таңдаңыз</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <button class="btn btn-primary m_btn">Өзгерту</button>
                <div class="mc_warning">
                    Сіз материалды жариялау арқылы <a href="#">сайттың ережелерімен</a> келіскеніңізді растайсыз.
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

    if ($(window).width() < '1099' && $(window).width() > '767') {
        select[0].textContent = "Пені";
        select[1].textContent = "Бағыты";
        select[2].textContent = "Сыныбы";
    } else {
        select[0].textContent = "Пәнді таңдаңыз";
        select[1].textContent = "Бағытын таңдаңыз";
        select[2].textContent = "Сыныбын таңдаңыз";
    }
    $(window).resize(function() {
        if ($(window).width() < '1099' && $(window).width() > '767') {
            select[0].textContent = "Пені";
            select[1].textContent = "Бағыты";
            select[2].textContent = "Сыныбы";
        } else {
            select[0].textContent = "Пәнді таңдаңыз";
            select[1].textContent = "Бағытын таңдаңыз";
            select[2].textContent = "Сыныбын таңдаңыз";
        }
    });
    // DROPZONE из materialpublication
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });

    $('.drop-zone__input').on('change', e => {
        e.preventDefault();
        $('.expectations').removeClass("active");
        $('.loadedmode').addClass("active");
        var dataName = e.target.files[0];
        var formData  = new FormData();
        var $percentdata = 0;
        $('.lineload2').width('0%');
        $('#procofp').text("0");
        $.ajax({
            url: "{{route('ajaxupload.action')}}",
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                        $percentdata = percentComplete;
                    }
                }, false);
                return xhr;
            },
            success: function () {
                //Дейстиве при успешности
                console.log(dataName);
                $('.lineload2').width($percentdata + '%');
                $('#procofp').text($percentdata);
                setTimeout(function(){
                    $('.loadedmode').removeClass("active");
                    $('.successmode').addClass("active");
                    $('.my_drop').addClass("active");
                },1000);


            },
            error: function(data){
                //Действте при ошибки
                console.log(dataName);
                $('.lineload2').width($percentdata + '%');
                $('#procofp').text($percentdata);
                setTimeout(function(){
                    $('.loadedmode').removeClass("active");
                    $('.successmode').addClass("active");
                    $('.my_drop').addClass("active");
                },1000);
            }
        });

    })
</script>
@endsection
