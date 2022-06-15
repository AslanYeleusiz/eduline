@extends('layouts.main')
@section('title', 'Жаңалықтар | Eduline.kz')
@section('meta')
<meta name="description" content="Ұстаздар мен мұғалімдерге арналған жаңалықтар. Аттестация жаңалықтары. Eduline.kz">
<meta name="keywords" content="eduline, ұстаздар, мұғалімдер, аттестация, материалдар, білім беру, мектеп">
<link rel="canonical" href="https://eduline.kz">
@endsection
@section('content')
<section class="news">
    <div class="m_href">
        <div class="cst_pd">
            <div class="cst_container">
                <a href="/" class="my_materials @if($url=='/') active @endif">
                    <img alt="zhan" class="img-svg" src="{{asset('images/zhan-1.svg')}}">
                    <span>{{__('site.Барлығы')}}</span>
                </a>
                <a href="/Announcement" class="my_materials @if($url=='Announcement') active @endif">
                    <img alt="zhan" class="img-svg" src="{{asset('images/zhan-2.svg')}}">
                    <span>{{__('site.Хабарландыру')}}</span>
                </a>
                <a href="/Popular" class="my_materials @if($url=='Popular') active @endif">
                    <img alt="zhan" class="img-svg" src="{{asset('images/zhan-2.svg')}}">
                    <span>{{__('site.Танымал')}}</span>
                </a>
                <a  @auth href="{{ route('news.saves') }}" @endauth @guest onclick="openLogin('Saves')" @endguest class="my_ls my_materials @if($url=='Saves') active @endif">
                    <img alt="zhan" class="img-svg" src="{{asset('images/zhan-3.svg')}}">
                    <span>{{__('site.Сақталғандар')}}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="cst_pd">
        <div class="cst_container ns_list" id="results"></div>
        <div class="cst_container ns_list">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div style="display:flex;" class="m_block" id="ajax-loading">
                <div style="margin: 0 auto;" class="spinner-border" role="status">
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var site_url = "{{ url($url) }}";
        var page = 1;

        load_more(page);

        $(window).scroll(function() {

            if ($(window).scrollTop() + $(window).height() >= $(document).height()-100) {
                page++;
                load_more(page);
            }
        });

        function load_more(page) {
            $.ajax({
                    url: site_url + '?page=' + page,
                    type: "get",
                    datatype: "html",
                    beforeSend: function() {
                        $('#ajax-loading').show();
                    }
                })
                .done(function(data) {
                    if (data.length == 0) {
                        $('#ajax-loading').html("Жаңалықтар тізімі бітті");
                        return;
                    }
                    $('#ajax-loading').hide();
                    $("#results").append(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
        }


    });
$(document).on('click touchstart', '#ajax-form .btn.ns_savebut', function() {
            let data = $(this).closest('#ajax-form');
            let btn = data.find('.btn.ns_savebut');
            $.ajax({
                url: '/news/save',
                type: "GET", //метод отправки
                dataType: "html", //формат данных
                data: data.serialize(), // Сеарилизуем объект
                success: function(response) { //Данные отправлены успешно
                    btn.hasClass('active') ?
                        btn.removeClass('active') : btn.addClass('active');

                },
                error: function(response) { // Данные не отправлены
                    console.log('fail');
                }
            });
        });
</script>
@endsection
