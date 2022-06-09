@extends('layouts.main')
@section('title', $pageName)
@section('content')
@section('meta')
<meta name="description" content="Ұстаздар мен тәрбиешілерге арналған материалдар, файлдар. Eduline.kz">
<meta name="keywords" content="eduline, ұстаздар, мұғалімдер, аттестация, материалдар, білім беру, мектеп">
<link rel="canonical" href="https://eduline.kz/materials">
@endsection
@component('components.NavBar')
@slot('materials') @endslot
@endcomponent


<section class="materials">
    <div class="cst_pd" id="app">
        <div class="m_head">
            @lang('site.Оқу-әдістемелік материалдар жинағы')
        </div>
        <div class="m_info">
            @lang('site.Сіз үшін 250 000 ұстаздардың еңбегі мен тәжірибесін біріктіріп, ең үлкен материалдар базасын жасадық. Барлық материалдарды сайт қолданушылары тегін жүктеп алып сабағына қолдана алады')
        </div>
        <form class="m_form" action="{{route('materials.search')}}" method="get">
            <div class="m_control">
                <input type="text" class="form-control m_box m_input" name="s" placeholder="@lang('site.Тақырып бойынша іздеу')" value="">
                <button class="btn btn-primary m_btn">@lang('site.Іздеу')</button>
                <select class="form-select m_box m_cbox g1" name="pan">
                    @foreach($materialSubject as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
                <select class="form-select m_box m_cbox g2" name="bagyt">
                    @foreach($materialDirection as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
                <select class="form-select m_box m_cbox g3" name="synyp">
                    @foreach($materialClass as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="m_val">
            @lang('site.Барлығы'): <span id="value">{{$materialCount}}</span> @lang('site.материал')
        </div>
                <div style="display:flex;" class="" id="ajax-loading">
                    <div style="margin: 0 auto;" class="spinner-border" role="status"></div>
                </div>
                <div class="m_content">

                </div>
        </div>
</section>

<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var site_url = "/materials?page=1";

        load_page(site_url);



        $('.g1').on('change', function(){
//            console.log(this.value);
            search();
        })
        $('.g2').on('change', function(){
//            console.log(this.value);
            search();
        })
        $('.g3').on('change', function(){
//            console.log(this.value);
            search();
        })
        $('.g3').on('change', function(){
//            console.log(this.value);
            search();
        })
        $('.m_btn').on('click', function(e){
            e.preventDefault();
            let form = $(this).closest('.m_form').find('.m_input');
            search();
        })


        function load_page(site_url) {
            $.ajax({
                    url: site_url,
                    type: "get",
                    datatype: "html",
                    beforeSend: function() {
                        $(".m_content").html('');
                        $('#ajax-loading').show();
                    }
                })
                .done(function(data) {
                    $('#ajax-loading').hide();
                    $(".m_content").html(data);
                    $('.pagination li a').on('click', function(e){
                        e.preventDefault();
                        load_page($(this).attr('href'));
                    })
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
        }

        function search() {
            $.ajax({
                    url: '/materials?page=1',
                    type: "get",
                    datatype: "html",
                    data: $('.m_form').serialize(),
                    beforeSend: function() {
                        $(".m_content").html('');
                        $('#ajax-loading').show();
                    }
                })
                .done(function(data) {
                    $('#ajax-loading').hide();
                    $(".m_content").html(data);
                    $('.pagination li a').on('click', function(e){
                        e.preventDefault();
                        load_page($(this).attr('href'));
                    })
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
        }
</script>
@endsection
