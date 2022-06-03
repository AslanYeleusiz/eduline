@extends('layouts.main')
@section('title', $pageName)
@section('content')

<div id="popup1" class="my_popup">
    <div class="popup_body">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="popup_main">
            <h2>Материалды жоюға сенімдісіз бе?</h2>
            <p>Материалмен қоса, материал статисткасы жойылады және материал үшін берілген марапаттарды жүктеу
                мүмкіндігі де қол жетімсіз болады.</p>
            <span>Өтінішті қарау үшін, жою себебін толық жазыңыз</span>
            <form method="post" action="{{route('materials.myMaterials.delete')}}" class="needs-validation">
                @csrf
                <input type="hidden" name="material_id" class="delete" value="0">
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" placeholder="Материалды жоямын деп шешкен себебім..." required></textarea>
                <button type="submit" class="btn btn-primary m_btn my_m_btn">Материалды жою</button>
            </form>
        </div>
    </div>
</div>

<div id="popup2" class="my_popup">
    <div class="popup_body">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="popup_main">
            <h2>Журналға жариялауға өтініш жіберу</h2>
            <hr>


            <div class="takyryb">
                <img src="{{asset('images/myfolder.svg')}}" alt="">
                <div class="tak_name">Тақырыбы: <span id="journal_title">Ашық сабақ Ыбырай Алтынсарин 5 сынып</span></div>
            </div>
            <div class="takyryb">
                <img src="{{asset('images/myprofile.svg')}}" alt="">
                <div class="tak_name">Автор: <span id="journal_author">{{Auth::user()->full_name}}</span><br><span class="mekeni">{{Auth::user()->place_work}}</span>
                </div>
            </div>
            <form action="" method="get" id="ajax-form">
                @csrf
                <input type="hidden" name="material_id" id="material_id" value="">
                <button type="button" id="journal_button" class="btn btn-primary m_btn my_m_btn popup_m_btn">Журналға жіберу</button>
            </form>

        </div>
    </div>
    <div class="send_block my_send_block">
        <div class="esc_btn"><img class="my_esc_icon" src="{{asset('images/escape.png')}}"></div>
        <div class="success_message">
            <div style="display:flex;" id="ajax-loading">
                <div style="margin: 0 auto;" class="spinner-border" role="status">
                </div>
            </div>
        </div>
    </div>
</div>

@component('components.NavBar')
@slot('materials') @endslot
@endcomponent

<section class="materials">
    <div class="cst_pd">
        <div class="m_head">
            Менің материалдарым
        </div>
        <div class="m_info">
            Бұл бетте сіз жариялаған барлық материалдар сайттан өшпей сақталып қалады. Өзіңіздің барлық
            материалдарыңызды осында тегін жариялап архив ретінде сақтауға болады
        </div>
        <a href="{{ route('materials.publication') }}">
            <button class="btn btn-primary m_btn my_m_btn">Материал жариялау</button>
        </a>
        <div class="m_val">
            Барлығы: <span id="value">{{$material->count()}}</span> материал
        </div>
        <div class="m_content">
            @foreach($material as $mt)
            <div class="m_block my_m_block">
                <input type="hidden" class="material_id" value="{{$mt->id}}">
                <div class="my_m_block_h">
                    <div class="my_m_info">
                        <div class="m_item">
                            <img src="{{asset('images/calendar.png')}}">
                            <span id="date">{{$mt->createdAt($mt->created_at)}}</span>
                        </div>
                        <div class="m_item">
                            <img src="{{asset('images/eye.png')}}">
                            <span id="views">{{$mt->view}}</span>
                        </div>
                        <div class="m_item">
                            <img src="{{asset('images/re-square.png')}}">
                            <span id="downloads">{{$mt->download}}</span>
                        </div>
                    </div>
                    <div class="my_edit">
                        <a href="/materials/my-materials/change/id-{{$mt->id}}" class="editBtn"><img src="{{asset('images/edit-2.png')}}"><span>Өзгерту</span></a>
                        <button class="btn deleteBtn pupup1"><img src="{{asset('images/trash.png')}}"><span>Жою</span></button>
                    </div>
                </div>
                <div class="my_m_block_b">
                    <a href="/materials/item-{{$mt->id}}" id="m_head" class="m_block_head">
                        {{$mt->title}}
                    </a>
                    <div class="m_item my_item">
                        <img src="{{asset('images/profile-c.png')}}">
                        <span id="name">{{$mt->user->full_name}}</span>
                    </div>
                    <div id="m_body" class="m_body">
                        {{$mt->description}}
                    </div>
                    <div class="my_admin_btns">
                        <a href="#">
                            <button class="btn my_btn c1">
                                Сертификатты жүктеу
                            </button>
                        </a>
                        <a href="#">
                            <button class="btn my_btn c2">
                                Алғыс хатты жүктеу
                            </button>
                        </a>
                        <a href="#">
                            <button class="btn my_btn c3">
                                Құрмет грамотасын жүктеу
                            </button>
                        </a>
                        <button class="btn my_btn c4 popup2">
                            Жинаққа жіберу
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
            {{$material->links('vendor.pagination.default')}}
        </div>
    </div>
</section>
<script>
    $(document).on('click touchstart', '.my_edit .btn.deleteBtn', function() {
        $('.delete')[0].value = $(this).closest('.m_block.my_m_block').find('.material_id')[0].value;
    });
    $(document).on('click touchstart', '.my_admin_btns .btn.my_btn.c4.popup2', function() {
        let data_id = $(this).closest('.m_block.my_m_block').find('.material_id')[0].value;
        $('#journal_title')[0].innerText = $('#m_head')[0].innerText;
        $('#material_id')[0].value = data_id;
    });
    $(document).on('click touchstart', '#ajax-form #journal_button', function() {
        let data = $(this).closest('#ajax-form');

        $.ajax({
            url: '/materials/my-materials/send/journal',
            type: "get",
            datatype: "html",
            data: data.serialize(),
            beforeSend: function() {
                $('.my_send_block').show();
            },
            success: function(response) {
                $('.success_message').html(response);
            },
            error: function(response) {
                $('.success_message').html("Error 404");
            },
        })
    });

</script>
@endsection
