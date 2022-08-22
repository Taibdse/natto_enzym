@extends('admin.layout') @section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('assets') }}/admin/assets/vendors/custom/menu/style.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/admin/assets/vendors/custom/menu/jquery-ui.css"> @endsection @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ $item->id ? trans('admin.common.edit') : trans('admin.common.add') }} @lang('admin/system/menu.menu')
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
                    @lang('admin/system/menu.menu')
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
        <div class="col-md-4">
            <div class="kt-portlets">
                <div class="kt-portlet__bodys">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne1">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                                    <i class="flaticon2-layers-1"></i> @lang('admin/system/menu.news_cate')
                                </div>
                            </div>
                            <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="add-l">
                                        <div class="row-base">
                                            <select class="select-custom" name="news_category" id="news_category">
                                                <option value="">@lang('admin.common.select_menu')</option>
                                                @foreach($menuData['category'] as $category)
                                                    <option value="{{ $category->id }}" data-link="{{ $category->link }}" data-title="{{ $category->title }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-success btn-add-select-item"><i class="la la-plus"></i> @lang('admin.common.add')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOne2">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2">
                                    <i class="flaticon2-layers-1"></i> @lang('admin/system/menu.news')
                                </div>
                            </div>
                            <div id="collapseOne2" class="collapse" aria-labelledby="headingOne2" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="add-l">
                                        <div class="row-base">
                                            <select class="select-custom" name="news" id="news">
                                                <option value="">@lang('admin.common.select_menu')</option>
                                                @foreach($menuData['news'] as $category)
                                                    <option value="{{ $category->id }}" data-link="{{ $category->link }}" data-title="{{ $category->title }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-success btn-add-select-item"><i class="la la-plus"></i> @lang('admin.common.add')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOne3">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseOne3">
                                    <i class="flaticon2-layers-1"></i> @lang('admin/system/menu.pages')
                                </div>
                            </div>
                            <div id="collapseOne3" class="collapse" aria-labelledby="headingOne3" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="add-l">
                                        <div class="row-base">
                                            <select class="select-custom" name="pages" id="pages">
                                                <option value="">@lang('admin.common.select_menu')</option>
                                                @foreach($menuData['pages'] as $category)
                                                    <option value="{{ $category->id }}" data-link="{{ $category->link }}" data-title="{{ $category->title }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-success btn-add-select-item"><i class="la la-plus"></i> @lang('admin.common.add')</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-layers-1"></i> @lang('admin/system/menu.custom_link')
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne4" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="add-l">
                                        <!-- <form action=""> -->
                                        <div class="form-group mb-3">
                                            <label for="">@lang('admin/system/menu.custom_name'): </label>
                                            <input type="text" name="" id="name-li" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">@lang('admin/system/menu.custom_url'): </label>
                                            <input type="text" name="" id="link-li" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success btn-add-item"><i class="la la-plus"></i> @lang('admin.common.add_to_menu')</button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <!--begin::Form-->
                {!! Form::open( ['url' => ($item->id ? route($route).'/'.$item->id : route($route)), 'method' => ($item->id ? 'PATCH' : 'POST'), 'class' => 'kt-form kt-form--label-right formData', 'name'=>'formData', 'files'=>true] ) !!}
                <input type="hidden" name="_action" value="save" />
                <textarea class="d-none" type="hidden" name="tree"></textarea>

                <div class="kt-portlet__body">
                    {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/menu.nemu_name'), 'title', $item->id ? $item->title : '', true) !!}
                    <div class="form-group row">
                        <div class="col-3 text-right">
                            @lang('admin/system/menu.submenu'):
                        </div>
                        <div class="col-9">
                            <!-- menu -->
                            <div class="menu-box">
                                <ul class="menu-list sortable">
                                    @if($item->id && $item->items)
                                        @foreach($item->items as $menu) <!-- item -->
                                            <li id="item_{{ $menu->id }}">
                                                @include('admin.cms.menu.form_menu_item')

                                                @if($menu->items)
                                                    <ul>
                                                    @foreach($menu->items as $menu) <!-- item -->
                                                        <li id="item_{{ $menu->id }}">
                                                            @include('admin.cms.menu.form_menu_item')

                                                            @if($menu->items)
                                                                <ul>
                                                                @foreach($menu->items as $menu) <!-- item -->
                                                                    <li id="item_{{ $menu->id }}">
                                                                        @include('admin.cms.menu.form_menu_item')
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- /.menu -->
                        </div>
                    </div>
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
        </div>
    </div>
</div>

@endsection @section('pageJs')

<script src="{{ url('assets') }}/admin/assets/vendors/custom/menu/jquery-ui.min.js"></script>
<script src="{{ url('assets') }}/admin/assets/vendors/custom/menu/jquery.mjs.nestedSortable.js"></script>
{{--<script src="{{ url('assets') }}/admin/assets/vendors/custom/menu/select2.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>--}}
<script src="{{ url('assets') }}/admin/assets/vendors/custom/menu/setting.js"></script>

<!-- end:: Content -->
@endsection