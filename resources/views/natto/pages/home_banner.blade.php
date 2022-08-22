<div class="banner-top">
    {{--{{url('/course/videos')}}--}}
    {{--<a href="{{ url('products') }}">--}}
        {{--<img src="{{url('assets/natto/images/default/banner-top2.jpg')}}" alt="tham gia khóa học online phòng ngừa đột quỵ" class="img-fluid">--}}
    {{--</a>--}}

    <!-- Swiper -->
    <div class="swiper-container swiper-banner-top">
        <div class="swiper-wrapper">
            @if ($banner && count($banner))
                @foreach ($banner as $item)
                    <div class="swiper-slide">
                        <a class="swiper-slide-link" href="{{ $item->link }}" target="_blank" style="display:block; width: 100%; text-align: center;">
                            <img src="{{url($item->image)}}" alt="{{ $item->title }}" class="img-fluid" style="width: 100%">
                        </a>
                    </div>
                @endforeach
            @endif
{{--            <div class="swiper-slide">--}}
{{--                <a href="{{ url('products') }}">--}}
{{--                    <img src="{{url('assets/natto/images/default/banner-top4.jpg')}}" alt="tham gia khóa học online phòng ngừa đột quỵ" class="img-fluid">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="swiper-slide">--}}
{{--                <a href="{{ url('products') }}">--}}
{{--                    <img src="{{url('assets/natto/images/default/banner-top1.jpg')}}" alt="tham gia khóa học online phòng ngừa đột quỵ" class="img-fluid">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="swiper-slide">--}}
{{--                <a href="{{ url('products') }}">--}}
{{--                    <img src="{{url('assets/natto/images/default/banner-top3.jpg')}}" alt="tham gia khóa học online phòng ngừa đột quỵ" class="img-fluid">--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
        <div class="swiper-pagination swiper-pagination-top"></div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev swiper-top-prev"></div>
        <div class="swiper-button-next swiper-top-next"></div>
    </div>
</div>
