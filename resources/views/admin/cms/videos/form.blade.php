@extends('admin.layout')

@section('header')

@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ $item->id ? trans('admin.common.edit')  : trans('admin.common.add') }} @lang('admin/cms/news.news')
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('admin.dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    @lang('admin/dashboard.dashboard')
                </a>

                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route($route) }}" class="kt-subheader__breadcrumbs-link">
                    @lang('admin/cms/news.news')
                </a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <!--begin::Form-->
                {!! Form::open( ['url' => ($item->id ? route($route).'/'.$item->id : route($route)), 'method' => ($item->id ? 'PATCH' : 'POST'), 'class' => 'kt-form kt-form--label-right formData', 'name'=>'formData', 'files'=>true] ) !!}
                    <input type="hidden" name="_action" value="save"/>

                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">@lang('admin/cms/news.form_category')</label>
                            <div class="col-9">
                                {!! Form::select('category_id', $selectCategory, $item->id ? $item->category_id : '', ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">@lang('admin/cms/news.form_title')</label>
                            <div class="col-9">
                                {!! Form::text('title', $item->id ? $item->title : '', ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label for="example-text-input" class="col-3 col-form-label">Youtube Video ID</label>--}}
{{--                            <div class="col-9">--}}
{{--                                {!! Form::text('youtube_id', $item->id ? $item->youtube_id : '', ['class'=>'form-control', 'required']) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        {!! \App\Helpers\AdminHelper::getCropImageInput('Image', 'image', $item->image ?? '', false, '', '630,400') !!}
                        {!! \App\Helpers\AdminHelper::getSelectMediaInput('Media', 'media_link', $item->media_link ?? '', false) !!}

{{--                        {!! \App\Helpers\AdminHelper::getTextareaInput( trans('admin/cms/news.form_introtext'), 'introtext', $item->introtext ?? '', false, '') !!}--}}
{{--                        {!! \App\Helpers\AdminHelper::getEditorInput(trans('admin/cms/news.form_fulltext'), 'fulltext', $item->fulltext ?? '', false, '', ['insert_image' => __('common.insert_image'), 'insert_script' => __('common.insert_script')]) !!}--}}

{{--                        <div class="row form-group">--}}
{{--                            <label class="col-3">--}}
{{--                                Related Products--}}
{{--                            </label>--}}
{{--                            <div class="col-9">--}}
{{--                                <select name="related_products[]" id="related_products_select2" multiple="multiple" style="width: 100%"></select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-3">
                                </div>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-primary btn-submit" data-action="save"><i class="la la-save"></i>@lang('admin.common.save')</button>
                                    <button type="submit" class="btn btn-success btn-submit" data-action="apply"><i class="la la-check"></i>@lang('admin.common.apply')</button>
                                    <a href="{{ route($route) }}" class="btn btn-secondary">@lang('admin.common.back')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection

@section('pageJs')
    <script type="text/javascript">

        $("#related_products_select2").select2({
            placeholder:"Search product...",
            ajax: {
                url: $.app.vars.adminUrl + 'shop/product',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        keyword: params.term,
                        type: 'select2',
                    };

                    return query;
                },
                processResults: function (res) {
                    $.each(res.data, function (idx, item) {
                        item.text = item.sku + ' - ' + item.title;
                    });

                    return {
                        results: res.data
                    };
                }
            }
        });

        @if($item->id && $item->related_products)
            @foreach($item->related_products_info as $p)
                var option = new Option('{{ $p->sku }}' + ' - ' + '{{ $p->title }}', '{{ $p->id }}', true, true);
                $("#related_products_select2").append(option).trigger('change');
            @endforeach
        @endif

    </script>
@endsection
