<div class="home-news-cnt">
    <div class="container">
        <div class="section-title">
            <h2>THÔNG TIN HỮU ÍCH VỀ SỨC KHỎE</h2>
        </div>
        <div class="news-slider">
            <div class="swiper-container home-news">
                <div class="swiper-wrapper">
                    @if ($news && count($news))
                        @foreach ($news as $item)
                        <div class="swiper-slide">
                            <div class="news-item">
                                <a href="{{ $item->link }}">
                                    <div class="thumb">
                                        <img src="{{url($item->image)}}" alt="{{ $item->title }}" class="img-fluid">
                                    </div>
                                    <h5>{{ $item->title }}</h5>
                                    <p>{{ $item->introtext }}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-news-prev"></div>
            <div class="swiper-button-next swiper-news-prev"></div>
        </div>
        @if ($homeCategory)
        <div class="see-more flase-btn">
            <a href="{{ $homeCategory->link }}">
                <img src="{{url('assets/natto/images/default/see-more-icon.png')}}" alt="{{ $homeCategory->title }}" class="img-fluid"> Xem thêm
            </a>
        </div>
        @endif

    </div>
</div>
