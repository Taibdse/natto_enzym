@extends('natto.layouts.default')
@section('header')
    <title>{{ config('system.general_title') }}</title>
    <meta name="description" content="{{ config('system.general_description') }}">
    <meta property="og:type" content="article"/>
    <meta property="og:site_name" content="{{ config('app.name') }}"/>
    <meta property="og:url" content="{{ Request::url()  }}"/>
    <meta property="og:image" content="{{ url(config('system.general_share') ?? '') }}"/>
    <meta property="og:title" content="{{ config('system.general_title') }}"/>
    <meta property="og:description" content="{{ config('system.general_description') }}"/>
    <link type="text/css" href="{{ url('assets/lib/selectric/selectric.css') }}?{{ config('system.version') }}"
          rel="stylesheet">
@stop

@section('content')
    <div class="video-audio-container">
        <div class="container">
            @if ($videos && count($videos))
            <div class="video-container">
                <div class="section-title">
                    <h2>Video</h2>
                </div>
                <div class="video-list js-show-video">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-video">
                        <div class="swiper-wrapper">
                            @foreach ($videos as $video)
                                <div class="swiper-slide">
                                    <div class="video-item" video-src="{{url($video->media_link ?? '')}}">
                                        <a href="#popup-video" rel="modal:open">
                                            <div class="video-thumb">
                                                <img src="{{url($video->image ?? '')}}" alt="{{ $video->title }}"
                                                     class="img-fluid">
                                                <div class="play-video-icon">
                                                    <img src="{{url('assets/natto/images/video/play-icon.png')}}" alt="{{ $video->title }}"
                                                         class="img-fluid">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="video-desc">
                                            <p>{{ $video->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next swiper-video-next"></div>
                    <div class="swiper-button-prev swiper-video-prev"></div>
{{--                    <div class="row row-page-1">--}}
{{--                        @foreach ($videos as $video)--}}
{{--                        <div class="col-md-6 col-lg-4">--}}
{{--                            <div class="video-item" video-src="{{url($video->media_link ?? '')}}">--}}
{{--                                <a href="#popup-video" rel="modal:open">--}}
{{--                                    <div class="video-thumb">--}}
{{--                                        <img src="{{url($video->image ?? '')}}" alt="{{ $video->title }}"--}}
{{--                                             class="img-fluid">--}}
{{--                                        <div class="play-video-icon">--}}
{{--                                            <img src="{{url('assets/natto/images/video/play-icon.png')}}" alt="{{ $video->title }}"--}}
{{--                                                 class="img-fluid">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <div class="video-desc">--}}
{{--                                    <p>{{ $video->title }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                </div>
                <div id="popup-video" class="modal popup-video">
                    <div class="video-box">
                        {{--<div class="overlay-video"></div>--}}
                        {{--<div class="control-video"></div>--}}
                        {{--<div class="sound">--}}
                        {{--</div>--}}
                        <video id="videopopup" playsinline autoplay width="100%" preload="auto" controls>
                            <source src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                @if ($videos->currentPage() < $videos->lastPage())
                <div class="see-more flase-btn">
                    <a href="javascript:void(0)" class="js-viewmore js-viewmore-video" data-type="video">
                        <img src="{{url('assets/natto/images/default/see-more-icon.png')}}" alt="xem thêm" class="img-fluid">
                        Xem thêm Video
                    </a>
                </div>
                @endif
            </div>
            @endif

            @if ($audios && count($audios))
            <div class="audio-container">
                <div class="section-title">
                    <h2>Audio</h2>
                </div>
                <div class="audio-list">
                    <div class="js-show-audio">
                        <div class="swiper-container swiper-audio">
                            <div class="swiper-wrapper">
                                @foreach ($audios as $audio)
                                    <div class="swiper-slide">
                                        <div class="audio-item" audio-src="{{url($audio->media_link ?? '')}}">
                                            <div class="audio-thumb">
                                                <div class="play-video-icon">
                                                </div>
                                                <svg id="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 50 38.05">
                                                    <title>Audio Wave</title>
                                                    <path id="Line_1" data-name="Line 1"
                                                          d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z"/>
                                                    <path id="Line_2" data-name="Line 2"
                                                          d="M6.91,9L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z"/>
                                                    <path id="Line_3" data-name="Line 3"
                                                          d="M12.91,0L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z"/>
                                                    <path id="Line_4" data-name="Line 4"
                                                          d="M18.91,10l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z"/>
                                                    <path id="Line_5" data-name="Line 5"
                                                          d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z"/>
                                                    <path id="Line_6" data-name="Line 6"
                                                          d="M30.91,10l-0.12,0A1,1,0,0,0,30,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H30.91Z"/>
                                                    <path id="Line_7" data-name="Line 7"
                                                          d="M36.91,0L36.78,0A1,1,0,0,0,36,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H36.91Z"/>
                                                    <path id="Line_8" data-name="Line 8"
                                                          d="M42.91,9L42.78,9A1,1,0,0,0,42,10V28a1,1,0,1,0,2,0s0,0,0,0V10a1,1,0,0,0-1-1H42.91Z"/>
                                                    <path id="Line_9" data-name="Line 9"
                                                          d="M48.91,15l-0.12,0A1,1,0,0,0,48,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H48.91Z"/>
                                                </svg>
                                                <svg id="wave1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 50 38.05">
                                                    <title>Audio Wave</title>
                                                    <path id="Line_1" data-name="Line 1"
                                                          d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z"/>
                                                    <path id="Line_2" data-name="Line 2"
                                                          d="M6.91,9L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z"/>
                                                    <path id="Line_3" data-name="Line 3"
                                                          d="M12.91,0L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z"/>
                                                    <path id="Line_4" data-name="Line 4"
                                                          d="M18.91,10l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z"/>
                                                    <path id="Line_5" data-name="Line 5"
                                                          d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z"/>
                                                    <path id="Line_6" data-name="Line 6"
                                                          d="M30.91,10l-0.12,0A1,1,0,0,0,30,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H30.91Z"/>
                                                    <path id="Line_7" data-name="Line 7"
                                                          d="M36.91,0L36.78,0A1,1,0,0,0,36,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H36.91Z"/>
                                                    <path id="Line_8" data-name="Line 8"
                                                          d="M42.91,9L42.78,9A1,1,0,0,0,42,10V28a1,1,0,1,0,2,0s0,0,0,0V10a1,1,0,0,0-1-1H42.91Z"/>
                                                    <path id="Line_9" data-name="Line 9"
                                                          d="M48.91,15l-0.12,0A1,1,0,0,0,48,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H48.91Z"/>
                                                </svg>
                                                <svg id="wave2" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 50 38.05">
                                                    <title>Audio Wave</title>
                                                    <path id="Line_1" data-name="Line 1"
                                                          d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z"/>
                                                    <path id="Line_2" data-name="Line 2"
                                                          d="M6.91,9L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z"/>
                                                    <path id="Line_3" data-name="Line 3"
                                                          d="M12.91,0L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z"/>
                                                    <path id="Line_4" data-name="Line 4"
                                                          d="M18.91,10l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z"/>
                                                    <path id="Line_5" data-name="Line 5"
                                                          d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z"/>
                                                    <path id="Line_6" data-name="Line 6"
                                                          d="M30.91,10l-0.12,0A1,1,0,0,0,30,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H30.91Z"/>
                                                    <path id="Line_7" data-name="Line 7"
                                                          d="M36.91,0L36.78,0A1,1,0,0,0,36,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H36.91Z"/>
                                                    <path id="Line_8" data-name="Line 8"
                                                          d="M42.91,9L42.78,9A1,1,0,0,0,42,10V28a1,1,0,1,0,2,0s0,0,0,0V10a1,1,0,0,0-1-1H42.91Z"/>
                                                    <path id="Line_9" data-name="Line 9"
                                                          d="M48.91,15l-0.12,0A1,1,0,0,0,48,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H48.91Z"/>
                                                </svg>
                                            </div>
                                            <div class="audio-desc">
                                                <p>{{ $audio->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-audio-next"></div>
                        <div class="swiper-button-prev swiper-audio-prev"></div>
{{--                        <div class="row row-page-1">--}}
{{--                            @foreach ($audios as $audio)--}}
{{--                                <div class="col-md-6 col-lg-4">--}}
{{--                                    <div class="audio-item" audio-src="{{url($audio->media_link ?? '')}}">--}}
{{--                                        <div class="audio-thumb">--}}
{{--                                            <div class="play-video-icon">--}}
{{--                                            </div>--}}
{{--                                            <svg id="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                 viewBox="0 0 50 38.05">--}}
{{--                                                <title>Audio Wave</title>--}}
{{--                                                <path id="Line_1" data-name="Line 1"--}}
{{--                                                      d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z"/>--}}
{{--                                                <path id="Line_2" data-name="Line 2"--}}
{{--                                                      d="M6.91,9L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z"/>--}}
{{--                                                <path id="Line_3" data-name="Line 3"--}}
{{--                                                      d="M12.91,0L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z"/>--}}
{{--                                                <path id="Line_4" data-name="Line 4"--}}
{{--                                                      d="M18.91,10l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z"/>--}}
{{--                                                <path id="Line_5" data-name="Line 5"--}}
{{--                                                      d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z"/>--}}
{{--                                                <path id="Line_6" data-name="Line 6"--}}
{{--                                                      d="M30.91,10l-0.12,0A1,1,0,0,0,30,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H30.91Z"/>--}}
{{--                                                <path id="Line_7" data-name="Line 7"--}}
{{--                                                      d="M36.91,0L36.78,0A1,1,0,0,0,36,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H36.91Z"/>--}}
{{--                                                <path id="Line_8" data-name="Line 8"--}}
{{--                                                      d="M42.91,9L42.78,9A1,1,0,0,0,42,10V28a1,1,0,1,0,2,0s0,0,0,0V10a1,1,0,0,0-1-1H42.91Z"/>--}}
{{--                                                <path id="Line_9" data-name="Line 9"--}}
{{--                                                      d="M48.91,15l-0.12,0A1,1,0,0,0,48,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H48.91Z"/>--}}
{{--                                            </svg>--}}
{{--                                            <svg id="wave1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                 viewBox="0 0 50 38.05">--}}
{{--                                                <title>Audio Wave</title>--}}
{{--                                                <path id="Line_1" data-name="Line 1"--}}
{{--                                                      d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z"/>--}}
{{--                                                <path id="Line_2" data-name="Line 2"--}}
{{--                                                      d="M6.91,9L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z"/>--}}
{{--                                                <path id="Line_3" data-name="Line 3"--}}
{{--                                                      d="M12.91,0L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z"/>--}}
{{--                                                <path id="Line_4" data-name="Line 4"--}}
{{--                                                      d="M18.91,10l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z"/>--}}
{{--                                                <path id="Line_5" data-name="Line 5"--}}
{{--                                                      d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z"/>--}}
{{--                                                <path id="Line_6" data-name="Line 6"--}}
{{--                                                      d="M30.91,10l-0.12,0A1,1,0,0,0,30,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H30.91Z"/>--}}
{{--                                                <path id="Line_7" data-name="Line 7"--}}
{{--                                                      d="M36.91,0L36.78,0A1,1,0,0,0,36,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H36.91Z"/>--}}
{{--                                                <path id="Line_8" data-name="Line 8"--}}
{{--                                                      d="M42.91,9L42.78,9A1,1,0,0,0,42,10V28a1,1,0,1,0,2,0s0,0,0,0V10a1,1,0,0,0-1-1H42.91Z"/>--}}
{{--                                                <path id="Line_9" data-name="Line 9"--}}
{{--                                                      d="M48.91,15l-0.12,0A1,1,0,0,0,48,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H48.91Z"/>--}}
{{--                                            </svg>--}}
{{--                                            <svg id="wave2" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                 viewBox="0 0 50 38.05">--}}
{{--                                                <title>Audio Wave</title>--}}
{{--                                                <path id="Line_1" data-name="Line 1"--}}
{{--                                                      d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z"/>--}}
{{--                                                <path id="Line_2" data-name="Line 2"--}}
{{--                                                      d="M6.91,9L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z"/>--}}
{{--                                                <path id="Line_3" data-name="Line 3"--}}
{{--                                                      d="M12.91,0L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z"/>--}}
{{--                                                <path id="Line_4" data-name="Line 4"--}}
{{--                                                      d="M18.91,10l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z"/>--}}
{{--                                                <path id="Line_5" data-name="Line 5"--}}
{{--                                                      d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z"/>--}}
{{--                                                <path id="Line_6" data-name="Line 6"--}}
{{--                                                      d="M30.91,10l-0.12,0A1,1,0,0,0,30,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H30.91Z"/>--}}
{{--                                                <path id="Line_7" data-name="Line 7"--}}
{{--                                                      d="M36.91,0L36.78,0A1,1,0,0,0,36,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H36.91Z"/>--}}
{{--                                                <path id="Line_8" data-name="Line 8"--}}
{{--                                                      d="M42.91,9L42.78,9A1,1,0,0,0,42,10V28a1,1,0,1,0,2,0s0,0,0,0V10a1,1,0,0,0-1-1H42.91Z"/>--}}
{{--                                                <path id="Line_9" data-name="Line 9"--}}
{{--                                                      d="M48.91,15l-0.12,0A1,1,0,0,0,48,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H48.91Z"/>--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                        <div class="audio-desc">--}}
{{--                                            <p>{{ $audio->title }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                    </div>

                    <audio controls id="audio-place" class="d-none">
                        <source src="" type="audio/mp3">
                        Your browser does not support the audio tag.
                    </audio>
                </div>
                @if ($audios->currentPage() < $audios->lastPage())
                <div class="see-more flase-btn">
                    <a href="javascript:void(0)" class="js-viewmore js-viewmore-audio" data-type="audio">
                        <img src="{{url('assets/natto/images/default/see-more-icon.png')}}" alt="xem thêm" class="img-fluid">
                        Xem thêm Audio
                    </a>
                </div>
                @endif
            </div>
            @endif

        </div>
    </div>
@stop

@section('footer')
    <script src="{{ url('assets/natto/js/video.js?'.config('system.version')) }}"></script>
@stop
