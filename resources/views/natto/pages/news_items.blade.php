@if ($news && count($news))
    <div class="row row-page-{{ $news->currentPage() }}">
        @foreach($news as $item)
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="news-item">
                    <a href="{{ $item->link }}">
                        <div class="thumb">
                            <img src="{{url($item->image ?? '')}}" alt="{{ $item->title }}" class="img-fluid">
                        </div>
                        <h5>{{ $item->title }}</h5>
                        <p>{{ $item->introtext }}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
