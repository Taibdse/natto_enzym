@extends('admin.layout')

@section('header')

@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ $item->id ? trans('admin.common.edit') : trans('admin.common.add') }} @lang('admin/cms/staff.staff')
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
                    @lang('admin/cms/staff.staff')
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
                        {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/cms/contact.form_name'), 'name', $item->id ? $item->name : '', true) !!}
                        {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/cms/contact.form_phone'), 'mobile', $item->id ? $item->mobile : '', true) !!}
                        {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/cms/contact.form_email'), 'email', $item->id ? $item->email : '', true) !!}
                        {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/cms/staff.position'), 'position', $item->id ? $item->position : '', true) !!}
                        {!! \App\Helpers\AdminHelper::getTextInput('Experence', 'experence', $item->id ? $item->experence : '', false) !!}
                        {!! \App\Helpers\AdminHelper::getCropImageInput('Avatar', 'avatar', $item->avatar ?? '', false, '', '500,500') !!}
                        {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/cms/contact.form_address'), 'address', $item->id ? $item->address : '', false) !!}
                        {!! \App\Helpers\AdminHelper::getTextareaInput(trans('admin/cms/staff.description'), 'description', $item->id ? $item->description : '', false) !!}

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
