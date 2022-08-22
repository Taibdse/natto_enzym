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
    <div class="news-container">
        <div class="container">
            <div class="section-title">
                <h1>Tin tức mới nhất</h1>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="news-list">
                        @if ($itemFeature)
                        <div class="news-lastest" itemscope itemtype="http://schema.org/Article">
                            <a href="{{ $itemFeature->link }}">
                                <div class="thumb">
                                    <img src="{{url($itemFeature->image ?? '')}}" alt="{{ $itemFeature->title }}" class="img-fluid">
                                </div>
                                <div class="news-overlay"></div>
                                <div class="news-title">
                                    <h2 itemprop="name">{{ $itemFeature->title }}</h2>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if ($items && count($items))
                        <div class="news-list-li js-show-data">
                            <div class="row row-page-1">
                                @foreach ($items as $item)
                                <div class="col-sm-6 col-md-4 mb-4">
                                    <div class="news-item" itemscope itemtype="http://schema.org/Article">
                                        <a href="{{ $item->link }}">
                                            <div class="thumb">
                                                <img src="{{url($item->image ?? '')}}" alt="{{ $item->title }}" class="img-fluid">
                                            </div>
                                            <h3 itemprop="name">{{ $item->title }}</h3>
                                            <p itemprop="description">{{ $item->introtext }}</p>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @if ($items->currentPage() < $items->lastPage())
                    <div class="see-more flase-btn">
                        <a href="javascript:void(0)" class="js-btn-more" data-link="{{ $category->link }}">
                            <img src="{{url('assets/natto/images/default/see-more-icon.png')}}" alt="" class="img-fluid"> Xem thêm
                        </a>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4" style="height: 100%; top: 0px;" id="sidebar">
                    <div class="banner-right">
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
