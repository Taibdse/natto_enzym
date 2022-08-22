@extends('admin.layout')

@section('header')

@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ $item->id ? trans('admin.common.edit') : trans('admin.common.add') }} @lang('admin/cms/page.pages')
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
                    @lang('admin/cms/page.pages')
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
                            <label for="example-text-input" class="col-2 col-form-label">@lang('admin/cms/page.form_title')</label>
                            <div class="col-10">
                                {!! Form::text('title', $item->id ? $item->title : '', ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">@lang('admin/cms/page.form_image')</label>
                            <div class="col-10">
                                <div class="input-group">
                                    {!! Form::text('image', $item->id ? $item->image : '', ['class'=>'form-control image_value', 'required']) !!}
                                    <div class="input-group-append">
                                        <button data-size="800,600" data-preview=".image_preview" data-value=".image_value" class="btn-crop-image btn btn-primary" type="button">Browse...</button>
                                    </div>
                                </div>
                                <img class="image_preview" src="{{ url($item->image ?? 'assets/lib/images/no-image.jpg') }}" style="width: 100px;">
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Chọn file</label>
                            <div class="col-10">
                                <div class="input-group">
                                    {!! Form::text('file', $item->id ? $item->file : '', ['class'=>'form-control file_value', 'required']) !!}
                                    <div class="input-group-append">
                                        <button data-type="text" data-value=".file_value" data-preview=".file_preview" class="btn-media btn btn-primary" type="button">Browse...</button>
                                    </div>
                                </div>
                                <div class="file_preview">
                                </div>
                            </div>
                        </div>--}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">@lang('admin/cms/page.form_introtext')</label>
                            <div class="col-10">
                                {!! Form::textarea('introtext', $item->id ? $item->introtext : '', ['class'=>'form-control', 'required', 'rows'=>'3']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">@lang('admin/cms/page.form_introfull')</label>
                            <div class="col-10">
                                {!! Form::textarea('fulltext', $item->id ? $item->fulltext : '', ['class'=>'form-control editor1', 'required', 'id'=>'editor1']) !!}
                                <a data-type="editor" data-value="editor1" data-preview="" class="btn btn-outline-primary btn-media btn-sm" href="javascript:void(0);"><i class="la la-picture-o"></i> @lang('common.insert_image')</a>
                                <a data-insert="editor1" class="btn btn-outline-primary btn-embeded btn-sm" href="javascript:void(0);"><i class="la la-code"></i> @lang('common.insert_script')</a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-2">
                                </div>
                                <div class="col-10">
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
@endsection
