@if( app('request')->input('page') == 1 )
    <div class="col-md-3">
        <div class="item">
            <br/>
            <select name="resize" class="upload_resize">
                <option value="0">@lang('admin/media.no_resize')</option>
                <option selected value="1024">@lang('admin/media.resize'): 1024</option>
                <option value="800">@lang('admin/media.resize'): 800</option>
            </select>
            <a onclick="$.app.upload.uploadAdmin('.upload_file_progress', _cbUpload, $('.upload_resize').val()); return false;" class="btn btn-sm btn-success btn-upload" href="#"><i class="la la-upload"></i> @lang('admin/media.upload')...</a>
        </div>
    </div>
@endif

@foreach($items as $item)
    <div class="col-md-3">
        <div class="item" data-id="{{ $item->id }}"
             data-title="{{ $item->title }}"
             data-url="{{ $item->url }}"
             data-url-full="{{ url($item->url) }}"
             data-type="{{ $item->mine_type }}"
            onclick="selectMediaItem(this);">
            @if($item->mine_type == 'image')
                <img class="img-fluid" src="{{ url($item->url) }}"/>
            @elseif($item->mine_type == 'video')
                <img class="img-fluid" src="{{ url('assets/lib/images/video.jpg') }}"/>
            @elseif($item->mine_type == 'document')
                <img class="img-fluid" src="{{ url('assets/lib/images/document.png') }}"/>
            @elseif($item->mine_type == 'pdf')
                <img class="img-fluid" src="{{ url('assets/lib/images/pdf.png') }}"/>
            @elseif($item->mine_type == 'zip')
                <img class="img-fluid" src="{{ url('assets/lib/images/zip.png') }}"/>
            @else
                <img class="img-fluid" src="{{ url('assets/lib/images/files.png') }}"/>
            @endif

            <br/>
            {{ Str::limit($item->title, $limit = 10, $end = '...') }}
        </div>
    </div>
@endforeach