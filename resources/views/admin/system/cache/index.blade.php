@extends('admin.layout')

@section('header')

@endsection

@section('content')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    @lang('admin/system/cache.cache')
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:void(0)" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('admin.dashboard') }}" class="kt-subheader__breadcrumbs-link">
                        @lang('admin/dashboard.dashboard')
                    </a>

                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route($route) }}" class="kt-subheader__breadcrumbs-link">
                        @lang('admin/system/cache.cache')
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
            <div class="col-lg-4">
                <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-fast">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <polygon style="fill:#EFEBDE;" points="46.5,14 32.5,0 1.5,0 1.5,58 46.5,58 		"/>
                                                <g>
                                                    <path style="fill:#D5D0BB;" d="M11.5,23h25c0.552,0,1-0.447,1-1s-0.448-1-1-1h-25c-0.552,0-1,0.447-1,1S10.948,23,11.5,23z"/>
                                                    <path style="fill:#D5D0BB;" d="M11.5,15h10c0.552,0,1-0.447,1-1s-0.448-1-1-1h-10c-0.552,0-1,0.447-1,1S10.948,15,11.5,15z"/>
                                                    <path style="fill:#D5D0BB;" d="M36.5,29h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S37.052,29,36.5,29z"/>
                                                    <path style="fill:#D5D0BB;" d="M36.5,37h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S37.052,37,36.5,37z"/>
                                                    <path style="fill:#D5D0BB;" d="M36.5,45h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S37.052,45,36.5,45z"/>
                                                </g>
                                                <polygon style="fill:#D5D0BB;" points="32.5,0 32.5,14 46.5,14 		"/>
                                            </g>
                                            <g>
                                                <circle style="fill:#ED7161;" cx="44.5" cy="46" r="12"/>
                                                <path style="fill:#FFFFFF;" d="M45.914,46l3.536-3.536c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L44.5,44.586
                                                    l-3.536-3.536c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L43.086,46l-3.536,3.536c-0.391,0.391-0.391,1.023,0,1.414
                                                    c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293l3.536-3.536l3.536,3.536c0.195,0.195,0.451,0.293,0.707,0.293
                                                    s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L45.914,46z"/>
                                            </g>
                                        </g>
                                </svg>
                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link"href="javascript:void(0)">@lang('admin/system/cache.clear_cache'):</a>
                                </h3>
                                <div class="kt-iconbox__content">
                                    @lang('admin/system/cache.database_caching')...
                                </div>
                            </div>
                        </div>
                        <a href="{{ route($route) }}?clear=cache" class="btn btn-success text-white" style="margin-top: 25px;">
                            <i class="la la-check-circle"></i>
                            @lang('admin/system/cache.clear')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-fast">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <polygon style="fill:#EFEBDE;" points="46.5,14 32.5,0 1.5,0 1.5,58 46.5,58 		"/>
                                                <g>
                                                    <path style="fill:#D5D0BB;" d="M11.5,23h25c0.552,0,1-0.447,1-1s-0.448-1-1-1h-25c-0.552,0-1,0.447-1,1S10.948,23,11.5,23z"/>
                                                    <path style="fill:#D5D0BB;" d="M11.5,15h10c0.552,0,1-0.447,1-1s-0.448-1-1-1h-10c-0.552,0-1,0.447-1,1S10.948,15,11.5,15z"/>
                                                    <path style="fill:#D5D0BB;" d="M36.5,29h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S37.052,29,36.5,29z"/>
                                                    <path style="fill:#D5D0BB;" d="M36.5,37h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S37.052,37,36.5,37z"/>
                                                    <path style="fill:#D5D0BB;" d="M36.5,45h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S37.052,45,36.5,45z"/>
                                                </g>
                                                <polygon style="fill:#D5D0BB;" points="32.5,0 32.5,14 46.5,14 		"/>
                                            </g>
                                            <g>
                                                <circle style="fill:#ED7161;" cx="44.5" cy="46" r="12"/>
                                                <path style="fill:#FFFFFF;" d="M45.914,46l3.536-3.536c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L44.5,44.586
                                                    l-3.536-3.536c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L43.086,46l-3.536,3.536c-0.391,0.391-0.391,1.023,0,1.414
                                                    c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293l3.536-3.536l3.536,3.536c0.195,0.195,0.451,0.293,0.707,0.293
                                                    s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L45.914,46z"/>
                                            </g>
                                        </g>
                                </svg>
                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link"href="javascript:void(0)">@lang('admin/system/cache.clear_compiled_view') </a>
                                </h3>
                                <div class="kt-iconbox__content">
                                    @lang('admin/system/cache.make_view_update')...
                                </div>
                            </div>
                        </div>
                        <a href="{{ route($route) }}?clear=views" class="btn btn-success text-white" style="margin-top: 25px;">
                            <i class="la la-check-circle"></i>
                            @lang('admin/system/cache.clear')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 59 59" style="enable-background:new 0 0 59 59;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <polygon style="fill:#EFEBDE;" points="45,14 31,0 0,0 0,58 45,58 		"/>
                                                <g>
                                                    <path style="fill:#D5D0BB;" d="M10,23h25c0.552,0,1-0.447,1-1s-0.448-1-1-1H10c-0.552,0-1,0.447-1,1S9.448,23,10,23z"/>
                                                    <path style="fill:#D5D0BB;" d="M10,15h10c0.552,0,1-0.447,1-1s-0.448-1-1-1H10c-0.552,0-1,0.447-1,1S9.448,15,10,15z"/>
                                                    <path style="fill:#D5D0BB;" d="M35,29H10c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S35.552,29,35,29z"/>
                                                    <path style="fill:#D5D0BB;" d="M35,37H10c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S35.552,37,35,37z"/>
                                                    <path style="fill:#D5D0BB;" d="M35,45H10c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S35.552,45,35,45z"/>
                                                </g>
                                                <polygon style="fill:#D5D0BB;" points="31,0 31,14 45,14 		"/>
                                            </g>
                                            <g>
                                                <circle style="fill:#8697CB;" cx="46.5" cy="46.5" r="12.5"/>
                                                <g>
                                                    <path style="fill:#C1BDDE;" d="M56.193,47.019c-0.55-0.113-1.068,0.246-1.175,0.788C54.198,51.975,50.616,55,46.5,55
                                                        c-3.351,0-6.347-2.006-7.789-5H44v-2h-6h-1h-1v8h2v-3.341C39.976,55.315,43.085,57,46.5,57c5.068,0,9.477-3.704,10.481-8.807
                                                        C57.087,47.651,56.735,47.125,56.193,47.019z"/>
                                                    <path style="fill:#C1BDDE;" d="M55,36.998v3.341c-1.976-2.657-5.086-4.341-8.5-4.341c-5.068,0-9.477,3.704-10.481,8.807
                                                        c-0.106,0.542,0.246,1.068,0.788,1.174c0.55,0.113,1.068-0.246,1.175-0.788c0.82-4.168,4.402-7.193,8.519-7.193
                                                        c3.351,0,6.347,2.006,7.789,5H49v2h6h1h1v-8H55z"/>
                                                </g>
                                            </g>
                                        </g>
                                        </svg>

                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link"href="javascript:void(0)">@lang('admin/system/cache.clear_route_config')</a>
                                </h3>
                                <div class="kt-iconbox__content">
                                    @lang('admin/system/cache.clear_routing_in_system')...
                                </div>
                            </div>

                        </div>
                        <a href="{{ route($route) }}?clear=route" class="btn btn-success text-white" style="margin-top: 25px;">
                            <i class="la la-check-circle"></i>
                            @lang('admin/system/cache.clear')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->
@endsection

@section('pageJs')
@endsection
