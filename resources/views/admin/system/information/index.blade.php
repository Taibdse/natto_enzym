@extends('admin.layout')

@section('header')

@endsection

@section('content')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    @lang('admin/system/information.information')
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
                        @lang('admin/system/information.information')
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
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1" role="tab">
                                <i class="flaticon2-shelter"></i>
                                @lang('admin/system/information.required_info')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.system.information.logs') }}" target="_blank">
                                <i class="la la-list"></i>
                                @lang('admin/system/information.logs') <i class="la la-external-link"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form action="" method="">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="kt-widget4">
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    PHP >= 7.2.0
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            @php
                                                                $currVersion = phpversion();
                                                            @endphp
                                                            @if(version_compare($currVersion, '7.2.0'))
                                                                <a href="{{ route('admin.system.information.php') }}" target="_blank" class="btn btn-sm btn-label-danger btn-bold">
                                                                    Current: {{ phpversion() }}<br/>
                                                                    Details <i class="la la-external-link"></i>
                                                                </a>
                                                            @else
                                                                <a href="#" class="btn btn-sm btn-label-brand btn-bold">
                                                                    Current: {{ phpversion() }}
                                                                    <br/>
                                                                    Details <i class="la la-external-link"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    BCMath PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('bcadd') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('bcadd') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Ctype PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('ctype_alnum') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('ctype_alnum') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    JSON PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('json_encode') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('json_encode') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Mbstring PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('mb_check_encoding') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('mb_check_encoding') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    OpenSSL PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('openssl_encrypt') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('openssl_encrypt') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    PDO PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ class_exists('PDO') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ class_exists('PDO') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Tokenizer PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('token_get_all') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('token_get_all') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    XML PHP Extension
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ function_exists('xml_parse') ? 'success' : 'danger' }} btn-bold">
                                                                <i class="la {{ function_exists('xml_parse') ? 'la-check-circle' : 'la-times-circle' }}"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="kt-widget4">
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Framework Version: {{ $laravelVersion }}
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Timezone: {{ config('app.timezone') }}
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Debug Mode: <label class="kt-badge kt-badge--inline kt-badge--{{ config('app.debug') ? 'danger' : 'success' }}">{{ config('app.debug') ? 'yes' : 'no' }}</label>
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Cache Dir Writable: <label class="kt-badge kt-badge--inline kt-badge--{{ is_writable(storage_path('/')) ? 'success' : 'danger' }}">{{ is_writable(storage_path('/')) ? 'yes' : 'no' }}</label>
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    App Size: 353,48 MB
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Server Info:<br/>
                                                                    Name: {{ $_SERVER['SERVER_NAME'] }}<br/>
                                                                    IP: {{ $_SERVER['SERVER_ADDR'] }}<br/>
                                                                    Software: {{ $_SERVER['SERVER_SOFTWARE'] }}<br/>
                                                                    Protocol: {{ $_SERVER['SERVER_PROTOCOL'] }}<br/>
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Database: {{ config('database.default') }}
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    SSL Installed:
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Cache Driver: {{ config('filesystems.default') }}
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget4__item">
                                                            <div class="kt-widget4__info">
                                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                                    Session Driver: {{ config('session.driver') }}
                                                                </a>
                                                                <p class="kt-widget4__text">
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="kt_user_edit_tab_2" role="tabpanel">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="row">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end:: Content -->
@endsection

@section('pageJs')
@endsection
