@extends('layouts.main')
@section('title', $material->title.' | Eduline.kz')
@section('meta')
<meta name="description" content="{{$material->description}}">
<meta name="keywords" content="eduline, ұстаздар, мұғалімдер, аттестация, материалдар, білім беру, мектеп">
<link rel="canonical" href="https://eduline.kz/news/{{$material->slug($material->title)}}-{{$material->id}}.html">
@endsection
@section('content')
<style>
    .menuactive1 {
        background: #3E6CED !important;
        color: #fff !important;
    }

    .menuactive1 .img-svg path,
    .img-svg polygon {
        stroke: #fff;
    }

    body {
        background: #FFFFFF;
    }

</style>
<div class="m_href mp_href ns_href">
    <div class="cst_pd mp_thref">
        <a href="/" class="btn mp_back">
            <img alt="arrow_right" src="{{asset('images/arrow-right.png')}}"><span>@lang('site.Артқа қайту')</span>
        </a>
        <div class="mp_blockhref"><span><a href="/">@lang('site.Жаңалықтар')</a> /</span> {{$material->title}}</div>
    </div>
</div>
<section class="new">
    @section('app')
    <div class="m_block cm_main">
        <div class="cst_pd">
            <form class="cm_form ns_block comment_btn">
                @csrf
                <div class="img" style="background-image: url( @auth /storage/images/avatars/{{Auth::user()->avatar}} @else /images/avatar_default.png @endauth )" alt=""></div>
                <input type="text" class="form-control cm_input" name="text" placeholder="@lang('site.Өз пікіріңізді жазыңыз')..." autocomplete="off">
                <input type="hidden" name="id_news" value="{{$material->id}}">
                <button type="button" class="btn-primary btn cm_btn">
                    @lang('site.Жіберу') <img src="{{asset('images/news/send.svg')}}" alt="">
                </button>
            </form>
        </div>
    </div>
    @endsection
    <div class="m_block cm_main dmob">
        <div class="cst_pd">
            <form class="cm_form ns_block comment_btn">
                @csrf
                <div class="img" style="background-image: url( @auth /storage/images/avatars/{{Auth::user()->avatar}} @else /images/avatar_default.png @endauth )" alt=""></div>
                <input type="text" class="form-control cm_input" name="text" placeholder="@lang('site.Өз пікіріңізді жазыңыз')..." autocomplete="off">
                <input type="hidden" name="id_news" value="{{$material->id}}">
                <button type="button" class="btn-primary btn cm_btn">
                    @lang('site.Жіберу') <img src="{{asset('images/news/send.svg')}}" alt="">
                </button>
            </form>
        </div>
    </div>
    <div class="cst_pd">
        <div class="ns_block">
            <img class="ns_img" src="{{asset('storage/images/news')}}/{{$material->image}}">
            <div class="ns_pre">
                <div class="ns_cat">{{$material->newsType->name}}</div>
                <div class="ns_time">{{$date}}</div>
            </div>
            <div class="mp_head">{{$material->title}}</div>
            <div class="mp_info">
                <?php echo $material->description?>
            </div>
            <div class="ns_likes">
                <div class="ns_view">
                    <div class="ns_views"></div>{{$material->view}}
                </div>
                <form method="get" id="ajax-formbut" action="">
                    @csrf
                    <input type="hidden" name="id_news" value="{{$material->id}}">
                    <button type="button" class="btn ns_savebut @if($material->thisUserSaved) active @endif"></button>
                </form>
            </div>
            <div class="ns_com_head">@lang('site.Пікірлер') (<span class="cvalue">{{$comments}}</span>)</div>




            <div id="results"></div>
            <div class="cst_container ns_list">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div style="display:flex;" class="" id="ajax-loading">
                    <div style="margin: 0 auto;" class="spinner-border" role="status">
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var site_url = "/news/id=" + {{$material -> id}} + "/comments";
        var page = 1;
        let end = 0;
        let timer = 1;
        load_more(page);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()-50 && timer && !end) {
                timer=0;
                page++;
                load_more(page);
            }else if (end == 1) {
                $('#ajax-loading').show();
                end = 2;
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
                        $('#ajax-loading').html("");
                        end = 1;
                        return;
                    }
                    timer=1;
                    $('#ajax-loading').hide();
                    $("#results").append(data);
                    $('.cm_qsts').click(function() {

                        e = $(this).closest('.cm_block').find('.cm_form.a');
                        if (!e.is(':visible')) {
                            $('.cm_form.a').hide();
                            $('.cm_qsts').removeClass('active');
                            $(this).closest('.cm_block').find('.cm_qsts').addClass('active');
                            e.show();
                        }
                    });
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
        }
    });
    $(document).on('click', '.cm_anothers', function() {
        e = $(this).closest('.cm_block').find('#answer_list');
        if (e.is(':visible')) {
            $(this).removeClass('active');
            e.hide();
            return;
        }
        $(this).addClass('active');
        e.show();
    });

    $(document).on('click', '#ajax_form .cm_btn', function() {
        @guest
        openLogin();
        @else
        e = $(this).closest('.cm_block');
        let data = e.find('#ajax_form');
        $.ajax({
            url: '/news/comments/answer',
            type: "GET",
            dataType: "html",
            data: data.serialize(),
            success: function(response) {
                console.log('done');
                data.after('<div class="cm_block mini"><div class="cm_avatar" style="background-image: url(/storage/images/avatars/{{Auth::user()->avatar}})"></div><div class="cm_content"><div class="cm_head">@guest @else {{Auth::user()->full_name}}@endguest</div><div class="cm_body">' + e.find('.cm_input')[0].value + '</div></div></div>');
                e.find('.cm_input')[0].value = '';
            },
            error: function(response) {
                console.log('fail');
            }
        });
        @endguest
    });

    $(document).on('click', '.comment_btn .cm_btn', function(e) {
        e.preventDefault();
        sendComment($(this).closest('.comment_btn'));
    });
    $(document).on('submit','.comment_btn', function(e) {
        e.preventDefault();
        sendComment($(this));
    });

    function sendComment(data){
        @guest
        openLogin();
        @else
        console.log(data);
        $.ajax({
            url: '/news/comments/store',
            type: "GET",
            dataType: "html",
            data: data.serialize(),
            success: function(response) {
                response = JSON.parse(response);
                $('#results').prepend('<div class="cm_block"><div class="cm_avatar" style="background-image: url(@auth{{asset(Auth::user()->avatar)}}@endauth)"></div><div class="cm_content"><div class="cm_head">@guest @else {{Auth::user()->full_name}}@endguest</div><div class="cm_body">' + data.find('.cm_input')[0].value + '</div><div class="cm_footer"><button type="button" class="btn cm_likes"><div class="cm_like"></div><span id="like_count">0</span></button><button class="btn cm_qsts"><div class="cm_qst"></div>@lang('site.Жауап жазу')</button></div><form action="" id="ajax_form" method="post" class="cm_form a" style="display:none"><input type="text" class="form-control cm_input" name="text" placeholder="@lang('site.Өз пікіріңізді жазыңыз')..." autocomplete="off"><input type="hidden" name="comment_id" class="comment_id" value="'+response.id_comment+'"><button type="button" class="btn-primary btn cm_btn">@lang('site.Жіберу ') <img src="{{asset("images/news/send.svg")}}" alt=""></button></form></div>');
                $('.cvalue').text({{$comments+1}});
                data.find('.cm_input')[0].value = '';
                $('.cm_qsts').click(function() {
                    e = $(this).closest('.cm_block').find('.cm_form.a');
                    if (!e.is(':visible')) {
                        $('.cm_form.a').hide();
                        $('.cm_qsts').removeClass('active');
                        $(this).closest('.cm_block').find('.cm_qsts').addClass('active');
                        e.show();
                    }
                });
            },
            error: function(response) {
                console.log('fail');
            }
        });
        @endguest
    };

    $(document).on('click', '.btn.cm_likes', function() {
        let data = $(this).closest('.cm_block').find('#ajax_form');
        let like = $(this).closest('.cm_block').find('.btn.cm_likes');
        let count = $(this).find('#like_count')[0];
        $.ajax({
            url: '/news/comments/likes',
            type: "GET",
            dataType: "html",
            data: data.serialize(),
            success: function(response) {
                console.log('done');
            },
            error: function(response) {
                console.log('fail');
            }
        }).done(function(data) {
            var s = count.innerText;
            var x = +s;
            if (like.hasClass('active')) {
                like.removeClass('active');
                count.innerText = --x;
            } else {
                like.addClass('active');
                count.innerText = ++x;
            }

        });
    });
    $('.ns_savebut').on('click', function() {
        @guest
        openLogin();
        @else
        let data = $('#ajax-formbut');
        let btn = $('.ns_savebut');
        $.ajax({
            url: '/news/save',
            type: "GET", //метод отправки
            dataType: "html", //формат данных
            data: data.serialize(), // Сеарилизуем объект
            success: function(response) { //Данные отправлены успешно
                btn.hasClass('active') ?
                    btn.removeClass('active') : btn.addClass('active');
                console.log('done');

            },
            error: function(response) { // Данные не отправлены
                console.log('fail');
            }
        });
        @endguest
    });

</script>
@endsection
