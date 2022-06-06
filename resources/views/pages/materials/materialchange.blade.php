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
<div id="popup2" class="my_popup">
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
<div class="m_href mp_href">
    <div class="cst_pd mp_thref">
        <a href="/materials/my-materials" class="btn mp_back">
            <img src="{{asset('images/arrow-right.png')}}"><span>@lang('site.Артқа қайту')</span>
        </a>
        <div class="mp_blockhref"> @lang('site.Материал ақпаратын өзгерту')</div>
    </div>
</div>
<section class="materials mc">
    <div class="cst_pd">
        <div class="mp_head mc_head">
            @lang('site.Материал ақпаратын өзгерту')
        </div>
        <div class="m_block mp_block mc_block">
            <form method="post" class="m_form" action="">
                @csrf
                <input type="hidden" name="material_id" value="{{$material->id}}">
                <div class="mb-4 w-100">
                    <label for="exampleFormControlInput1" class="form-label">@lang('site.Материал тақырыбы')</label>
                    <input name="name" class="form-control" id="exampleFormControlInput1" placeholder="Ашық сабақ Ыбырай Алтынсарин 5 сынып" value="{{$material->title}}">
                </div>
                <div class="mb-3 w-100">
                    <label for="exampleFormControlTextarea1" class="form-label">@lang('site.Материалдың қысқаша түсінігі')</label>
                    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" placeholder="Қысқаша түсінік ретінде материалдың басқаларға пайдасы, негізгі ойы, форматы туралы ақпарат жазуға болады.">{{$material->description}}</textarea>
                </div>
                <div class="m_control mc_control">
                    <select class="form-select m_box m_cbox g1" name="subject" required>
                        @foreach($sub as $subject)
                        <option @if($subject->id==$material->subject_id) selected @endif value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-select m_box m_cbox g2" name="direction" required>
                        @foreach($dir as $subject)
                        <option @if($subject->id==$material->direction_id) selected @endif value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-select m_box m_cbox g3" name="class" required>
                        @foreach($class as $subject)
                        <option @if($subject->id==$material->class_id) selected @endif value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-primary m_btn">@lang('site.Өзгерту')</button>
                <div class="mc_warning">
                    @lang('site.Ескерту: сізге ақпаратты өзгерту үшін 1 ғана мүмкіндік беріледі, сол себепті мұқият жазуыңызды сұраймыз')!
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $('.m_btn').on('click', function() {
        let data = $(this).closest('.m_form');
        $.ajax({
            url: '/materials/my-materials/changed',
            type: "get",
            datatype: "html",
            data: data.serialize(),
            beforeSend: function() {
                $('.my_send_block').show();
                $('.my_popup').show();

            },
            success: function(response) {
                $('.success_message').html(response);
                console.log('done');
            },
            error: function(response) {
                $('.success_message').html("Error 404");
                console.log('fail');
            }
        });
    });

</script>
@endsection
