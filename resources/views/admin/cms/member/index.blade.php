@extends('admin.layout')

@section('header')

@endsection

@section('pageCss')
@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Thành viên
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('admin.dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    Dashboard
                </a>

                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route($route) }}" class="kt-subheader__breadcrumbs-link">
                    Thành viên
                </a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            @can('permission', $route.'.create')
                <a href="{{ route($route.'.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-plus"></i>
                    @lang('admin.common.add')
                </a>
            @endcan
        </div>
        <div class="kt-subheader__toolbar">
            <div id="btn-status-list" class="btn-group btn-status-list">
                <button type="button" class="btn btn-sm btn-success">Enable</button>
                <button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a data-action="update_status_list" data-id="" data-value="1" data-field="status" class="dropdown-item option" href="javascript:void(0)">Draft</a>
                    <a data-action="update_status_list" data-id="" data-value="2" data-field="status" class="dropdown-item option" href="javascript:void(0)">Pending</a>
                    <a data-action="update_status_list" data-id="" data-value="3" data-field="status" class="dropdown-item option" href="javascript:void(0)">Disable</a>
                    <a data-action="update_status_list" data-id="" data-value="4" data-field="status" class="dropdown-item option" href="javascript:void(0)">Enable</a>
                </div>
            </div>
            @can('permission', $route.'.delete')
                <a id="btn-remove-list" href="javascript:;" type="button" class="btn btn-brand btn-danger"><i class="la la-trash"></i> Remove</a>
            @endcan
            @can('permission', $route.'.create')
                <a href="{{ route($route.'.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-plus"></i>
                    @lang('admin.common.add')
                </a>
            @endcan
        </div>

    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="row">
        <div class="col-xl-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <form class="kt-form kt-form--fit filterForm" name="filterForm" method="get">
                        <input type="hidden" name="page" value="{{ app('request')->input('page', '1') }}"/>
                        <input type="hidden" name="_limit" value="{{ $limit }}"/>
                        <input type="hidden" name="_order_by" value="{{ $orderBy }}"/>
                        <input type="hidden" name="_order_type" value="{{ $orderType }}"/>

                        <div class="row kt-margin-b-20">
                            <div class="col-md-4 kt-margin-b-10-tablet-and-mobile">
                                <label>Type:</label>
                                {{ Form::select('role_id', $roles, app('request')->input('role_id', ''), ['class'=>'form-control']) }}
                            </div>
                            <div class="col-md-4 kt-margin-b-10-tablet-and-mobile">
                                <label>@lang('admin.common.keyword'):</label>
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input value="{{ app('request')->input('keyword', '') }}" name="keyword" type="text" class="form-control" placeholder="@lang('admin.common.search')..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-10-tablet-and-mobile">
                                <label>&nbsp;&nbsp;</label>
                                <button onclick="document.filterForm.submit();" type="submit" class="btn btn-default form-control btn-search" style="width: auto; display: block"><i class="la la-search"></i> @lang('admin.common.go')</button>
                            </div>
                        </div>
                    </form>

                    <!--begin::Section-->
                    <div class="kt-section dataTables_wrapper">
                        <span class="kt-section__info">
                            {{--Using the most basic table markup, here’s how tables look in Metronic:--}}
                        </span>
                        <div class="kt-section__content table-content">
                            @include($route.'.index_table')
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection

@section('pageJs')

@endsection
