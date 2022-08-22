@extends('admin.layout')

@section('header')

@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ $item->id ? 'Sửa' : 'Thêm mới' }} Chuyên mục
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
                    @lang('admin/cms/category.category')
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
                        {!! \App\Helpers\AdminHelper::getSelectInput(trans('admin/cms/category.form_category_category'), 'parent_id', $item->id ? $item->parent_id : '', false, $selectCategory) !!}

                        {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/cms/contest.category.form_title'), 'title', $item->id ? $item->title : '', true) !!}
                        {!! \App\Helpers\AdminHelper::getCropImageInput('Icon', 'icon', $item->id ? $item->icon : '', false, '', '60,60') !!}
                        {!! \App\Helpers\AdminHelper::getCropImageInput('Image', 'image', $item->id ? $item->image : '', false, '', '600,600') !!}

                        {!! \App\Helpers\AdminHelper::getTextareaInput(trans('admin/cms/contest.category.form_introtext'), 'introtext', $item->id ? $item->introtext : '', false) !!}
                        {!! \App\Helpers\AdminHelper::getEditorInput('Fulltext', 'fulltext', $item->id ? $item->fulltext : '', false) !!}

                        @include('admin.cms.seo.form')
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

    @include('admin.cms.seo.form_library')
@endsection