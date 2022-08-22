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
    <link type="text/css" href="{{ url('assets/lib/selectric/selectric.css') }}?{{ config('system.version') }}" rel="stylesheet">
@stop

@section('content')
    <div class="news-details-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="news-content-box" itemscope itemtype="http://schema.org/Article">
                        <h1 itemprop="name">{{ $news->title }}</h1>
                        <div class="like-share">
                        </div>
                        {!! $news->fulltext !!}
                    </div>
                </div>
                <div class="col-lg-4"  style="height: 100%; top: 0px;" id="sidebar">
                    @if ($related && count($related))
                        <div class="news-related">
                            <h2>Tin tức liên quan</h2>
                            <hr>
                            @foreach ($related as $relateItem)
                            <div class="news-related-li" itemscope itemtype="http://schema.org/Article">
                                <a href="{{ $relateItem->link }}">
                                    <div class="row m-0">
                                        <div class="col-4 p-0">
                                            <div class="thumb">
                                                <img src="{{url($relateItem->image ?? '')}}" alt="{{ $relateItem->title }}" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-8 p-0">
                                            <div class="news-related-title">
                                                <h3 itemprop="name">{{ $relateItem->title }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="news-related-banner show-popup-store">
                        <a href="#popupproduct">
                            <img src="{{url('assets/natto/images/news/banner-news-3.jpg')}}" alt="nattoenzym" class="img-fluid">
                        </a>
                    </div>
                    <div class="news-related-banner">
                        <a href="https://tuoitre.vn/chu-dong-phong-ngua-dot-quy-e817.htm" target="_blank">
                            <img src="{{url('assets/natto/images/default/banner-adx.jpg')}}" alt="nattoenzym" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bot-scroll"></div>
@stop

@section('footer')
    <script src="{{ url('assets/natto/js/news.js?'.config('system.version')) }}"></script>
@stop
