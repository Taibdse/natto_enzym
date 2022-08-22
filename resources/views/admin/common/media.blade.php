<div class="modal fade" id="mediaModal" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('admin/media.media')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-9">
                            <div class="upload_file_progress"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="btn-group btn-group-sm btn-group-order" role="group">
                                        <button type="button" data-type="newest" class="btn btn-primary">@lang('admin/media.newest')</button>
                                        <button type="button" data-type="oldest" class="btn btn-outline-info">@lang('admin/media.oldest')</button>
                                    </div>
                                </div>
                                <div class="col-8 text-right">
                                    <div class="btn-group btn-group-sm btn-group-type" role="group">
                                        <button type="button" data-type="all" class="btn btn-primary">@lang('admin/media.all')</button>
                                        <button type="button" data-type="image" class="btn btn-outline-info">@lang('admin/media.image')</button>
                                        <button type="button" data-type="video" class="btn btn-outline-info">@lang('admin/media.video')</button>
                                        <button type="button" data-type="pdf" class="btn btn-outline-info">PDF</button>
                                        <button type="button" data-type="document" class="btn btn-outline-info">@lang('admin/media.document')</button>
                                    </div>
                                </div>
                            </div><br/>

                            <div class="row images">

                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a onclick="return loadAdminMediaMore();" href="#" class="btn-load-more btn btn-sm btn-outline-primary">@lang('admin/media.more')...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            @lang('admin/media.url'):<br/>
                            <input type="hidden" name="id" value="0" class="form-control"/>
                            <input type="hidden" name="type" class="form-control"/>
                            <input type="hidden" name="url-full" class="form-control"/>
                            <input type="text" name="url" class="form-control"/>

                            @lang('admin/media.des'):<br/>
                            <textarea name="title" class="form-control"></textarea>

                            <br/>
                            <a onclick="return deleteMedia(this);" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash"></i> @lang('admin/media.delete')</a>
                            <a onclick="return useMedia(this);" href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-forward"></i> @lang('admin/media.use') </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Process media popup
    var mediaPage = 1;
    var mediaOrder = 'newest';
    var mediaType = 'all';
    var mediaModal = $('#mediaModal');
    var mediaInsertTo = '';
    var mediaInsertType = 'editor';
    var mediaPreviewTo = '';

    function _cbUpload(res){
        if (res.code) {
            $('.upload_file_progress').hide();

            mediaPage = 0;
            loadAdminMediaMore();
        }
    }

    function loadAdminMedia(){
        var _cb = function(res){
            if (res.code) {
                if (mediaPage === 1){
                    $('.images', mediaModal).html(res.data);
                } else {
                    $('.images', mediaModal).append(res.data);
                }
            }
        };

        $.app.ajax($('.btn-load-more', mediaModal).get()[0], '/media/admin/', {
            page: mediaPage,
            mediaOrder: mediaOrder,
            mediaType: mediaType,
        }, _cb, 'GET', '.none');
    }

    function loadAdminMediaMore(){
        mediaPage++;
        loadAdminMedia();
        return false;
    }

    function selectMediaItem(item){
        $('input[name=id]', mediaModal).val($(item).data('id'));
        $('input[name=url]', mediaModal).val($(item).data('url'));
        $('input[name=url-full]', mediaModal).val($(item).data('url-full'));
        $('input[name=type]', mediaModal).val($(item).data('type'));
        $('textarea[name=title]', mediaModal).val($(item).data('title'));

        $('.images .item', mediaModal).removeClass('active');
        $(item).addClass('active');
    }

    function useMedia(btn){
        var $id = $('input[name=id]', mediaModal).val();
        var $type = $('input[name=type]', mediaModal).val();
        var $url = $('input[name=url]', mediaModal).val();
        var $urlFull = $('input[name=url-full]', mediaModal).val();
        var $title = $('textarea[name=title]', mediaModal).val();

        if (!$id) {
            alert('You must choose item!');
            return false;
        }

        // Update to database
        var _cb = function(res){
            if (res.code) {

            }
        };
        $.app.ajax(btn, '/media/admin/update', {id: $id, title: $title}, _cb, 'POST', '.none');

        mediaModal.modal('hide');

        var previewHtml = '<a target="_blank" href="' + $urlFull + '">' + $urlFull + '</a>';

        if($type === 'image'){
            previewHtml = '<div>'
                + '<img class="img-fluid" src="'+ $urlFull +'" alt="'+$title+'"/>'
                + '<div>'+$title+'</div>'
                + '</div><p>...</p>';
        }

        if($type === 'video'){
            previewHtml = '<div>'
                + '<video width="100%" height="auto" controls>'
                + '<source src="'+ $urlFull +'" type="video/mp4">'
                + '</video>'
                + '<div>'+$title+'</div>'
                + '</div><p>...</p>';
        }

        if(mediaInsertType === 'editor'){
            CKEDITOR.instances[mediaInsertTo].insertHtml(previewHtml);
        }

        if(mediaInsertType === 'text'){
            $(mediaInsertTo).val($url).trigger('change');
            $(mediaPreviewTo).html(previewHtml);
        }

        if(mediaInsertType === 'gallery'){
            //$(mediaInsertTo).val($url);
            $(mediaPreviewTo).prepend('<div class="item" style="width: 150px; height: 150px; overflow: hidden; float: left; margin-right: 10px; position:relative;">' +
                '<img style="width: 100%; margin-bottom: 0px; height: 100px;" class="thumbnail" alt="' + $title + '" src="' + $urlFull + '" />' +
                '<textarea style="width: 100%;" rows="2" name="'+mediaInsertTo+'[' + $url + ']">'+ $title +'</textarea>' +
                '<a onclick="$(this).parent().prev(\'.item\').before($(this).parent()); return false;" class="btn btn-default btn-sm pull-left" href="#" style="position: absolute; top: 0; right: 60px;"><i class="la la-chevron-left"></i></a>' +
                '<a onclick="$(this).parent().next(\'.item\').after($(this).parent()); return false;" class="btn btn-default btn-sm pull-left" href="#" style="position: absolute; top: 0; right: 40px;"><i class="la la-chevron-right"></i></a>' +
                '<a onclick="if(!confirm(\'Bạn có chắc muốn xóa ảnh?\')) return false; $(this).parent().remove(); return false;" class="btn btn-danger btn-xs pull-left" href="#" style="position: absolute; top: 0; right: 0;">Xóa</a>' +
                '</div>');
            //$(mediaPreviewTo).html(previewHtml);
        }

        return false;
    }

    function deleteMedia(btn){
        if (!confirm('Are you sure?')){
            return false;
        }

        var $id = $('input[name=id]', mediaModal).val();
        if (!$id) {
            alert('You must choose item!');
            return false;
        }

        var _cb = function(res){
            if (res.code) {
                $('.item[data-id='+$id+']').parent().remove();
                $('input, textarea', mediaModal).val('');
            }
        };

        $.app.ajax(btn, '/media/admin/delete', {id: $id}, _cb, 'POST', '.none');
        return false;
    }

    $('.btn-group-order button', mediaModal).on('click', function () {
        $('.btn-group-order button', mediaModal).addClass('btn-outline-info').removeClass('btn-primary');
        $(this).removeClass('btn-outline-info').addClass('btn-primary');

        mediaOrder = $(this).data('type');
        mediaPage = 1;
        loadAdminMedia();
    });

    $('.btn-group-type button', mediaModal).on('click', function () {
        $('.btn-group-type button', mediaModal).addClass('btn-outline-info').removeClass('btn-primary');
        $(this).removeClass('btn-outline-info').addClass('btn-primary');

        mediaType = $(this).data('type');
        mediaPage = 1;
        loadAdminMedia();
    });
</script>


<div class="modal fade" id="cropModal" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="logo_value" value="" id="logo_value"/>
                            {!! Form::file('crop_image_input', ['id'=>'crop_image_input', 'style' => 'padding-left: 15px;padding-bottom: 15px;']) !!}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 crop_image_wrapper text-center" style="max-height: 364px;">
                            <img id="crop_image" src="{{ url('assets/lib/images/no-image.jpg') }}">
                        </div>

                        <div class="col-2 crop_image_preview_wrapper not-file">
                            <img src="{{ url('assets/lib/images/no-image.jpg') }}" id="crop_image_preview" class="thumbnail" style="width: 100%; margin: 0">

                            <br/><br/>
                            <button class="btn btn-primary d-none" name="save" id="btn-image-crop" style="width: 100%;"><i class="la la-crop"></i> Crop</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%;">Close</button>
                            <div class="col-11 text-center" style="max-height: 364px;">
                                <div class="alert alert-crop d-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var cropRatio = [800,600];
    var cropUpdateValueTo = '';
    var cropUpdatePreviewTo = '';
    var cropUpdateCallback = null;

    // Process crop image
    $(function () {
        var dataImageCrop = '';
        var fileNameCrop = '';

        $('#crop_image_input').on('change', function (e) {
            var file = this.files[0];
            var reader = new FileReader();
            reader.addEventListener("load", function () {
                $('.crop_image_wrapper, .crop_image_preview_wrapper, #btn-image-crop').removeClass('d-none');
                $('#crop_image').attr("src", reader.result);
                fileNameCrop = file.name;

                $('#crop_image').cropper('destroy');
                $('#crop_image').cropper({
                    dragMode: 'move',
                    viewMode: 1,
                    aspectRatio: cropRatio[0]/cropRatio[1],
                    autoCropArea: 1,
                    crop: function (e) {
                        var imageData = $('#crop_image').cropper('getCroppedCanvas',
                            {
                                width: cropRatio[0],
                                height: cropRatio[1],
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high'
                            }
                        ).toDataURL('image/jpeg', 100);
                        $('#crop_image_preview').attr('src', imageData);
                        dataImageCrop = imageData;
                    }
                });
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        $('.btn-crop-image').on('click', function () {

            setTimeout(function () {
                var img = document.querySelector('.image-cropper');
                if (img) {
                    var getDataUrl = function (img) {
                        var canvas = document.createElement('canvas');
                        canvas.width = img.width;
                        canvas.height = img.height;
                        var ctx = canvas.getContext('2d');
                        ctx.drawImage( img, 0, 0 );
                        return canvas.toDataURL( );
                    };

                    var dataUrl = getDataUrl(img);
                    $('#crop_image').attr("src", dataUrl);
                }

                $('.crop_image_wrapper, .crop_image_preview_wrapper, #btn-image-crop').removeClass('d-none');

                fileNameCrop = 'cropped.jpg';

                $('#crop_image').cropper('destroy');
                $('#crop_image').cropper({
                    dragMode: 'move',
                    viewMode: 1,
                    aspectRatio: cropRatio[0]/cropRatio[1],
                    autoCropArea: 1,
                    crop: function (e) {
                        var imageData = $('#crop_image').cropper('getCroppedCanvas',
                            {
                                width: cropRatio[0],
                                height: cropRatio[1],
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high'
                            }
                        ).toDataURL('image/jpeg', 100);
                        $('#crop_image_preview').attr('src', imageData);
                        dataImageCrop = imageData;
                    }
                });
            }, 2000);

        });

        $('#btn-image-crop').click(function () {
            if(dataImageCrop){
                var _cb = function(res){
                    if (res.code) {
                        $('#cropModal').modal('hide');

                        $(cropUpdateValueTo).val(res.data).trigger('change');
                        $(cropUpdatePreviewTo).attr('src', $.app.vars.url + res.data);

                        if (cropUpdateCallback) {
                            window[cropUpdateCallback](res.data);
                        }
                    }
                };
                $.app.ajax(this, '/media/admin/uploadBase64', {filename: fileNameCrop, filecontent: dataImageCrop}, _cb, 'POST', '.alert-crop');
            }
        });

    });
</script>


<div class="modal fade" id="embededModal" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('admin/media.embed')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group ">
                        <label>@lang('admin/media.insert_yt_video')</label>
                        <div class="input-group">
                            <input name="embeded_youtube" type="text" class="form-control" placeholder="@lang('admin/media.youtube_link')">
                            <div class="input-group-append">
                                <button onclick="insertYoutube();" class="btn btn-primary" type="button">@lang('admin/media.insert')</button>
                            </div>
                        </div><br/>
                        <small><i>@lang('admin/media.eg'): https://www.youtube.com/watch?v=uZVRjfweDOU</i></small>
                    </div>
                    <hr/>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function insertYoutube() {
        var $link = $('input[name=embeded_youtube]').val();
        if (!$link) return '';

        var $link = new URL($link);
        var $link = $link.searchParams.get("v");

        var $html = '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/'+$link+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><p>...</p>';

        CKEDITOR.instances[mediaInsertTo].insertHtml($html);
        $('#embededModal').modal('hide');
    }
</script>
