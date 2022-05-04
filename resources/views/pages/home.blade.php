@extends('pages.layouts.main')
@section('title', 'Eduline.kz')
@section('content')
    <section class="welcome">
        <div class="container">
            {{__('site.Продукты')}}
        </div>
    </section>
    <style>
    .menuactive1 {
        background: #3E6CED!important;
        color: #fff!important;
    }
    .menuactive1 .img-svg path, .img-svg polygon {
        stroke: #fff;
    }
    .content {
        margin: 0 auto;
    }
</style>
@endsection