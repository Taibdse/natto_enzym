@extends('natto.layouts.default')
@section('header')
    <title>{{ config('system.general_title') }}</title>
    <meta name="description" content="{{ config('system.general_description') }}">
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ Request::url()  }}" />
    <meta property="og:image" content="{{ url(config('system.general_share') ?? '') }}" />
    <meta property="og:title" content="{{ config('system.general_title') }}" />
    <meta property="og:description" content="{{ config('system.general_description') }}" />
@stop

@section('content')
    @include('natto.pages.product_product')
    {{--@include('natto.pages.product_congdung')--}}
    {{--@include('natto.pages.product_news')--}}
@stop

@section('footer')
    <script src="{{ url('assets/natto/js/product.js?'.config('system.version')) }}"></script>
    <script>
        $(document).ready(function () {
            $.ui.video.init();
        });
    </script>
@stop
