@if ($videos && count($videos))
<div class="row row-page-{{ $videos->currentPage() }}">
    @foreach ($videos as $video)
        <div class="col-md-6 col-lg-4">
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
@endif
