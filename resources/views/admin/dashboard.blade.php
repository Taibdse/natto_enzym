@extends('admin.layout')

@section('header')
    <title>{{ config('app.name', 'Laravel') }} | @lang('admin/dashboard.dashboard')</title>
@endsection

@section('pageCss')

@endsection

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">@lang('admin/dashboard.dashboard')</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                    <span class="kt-subheader__desc">{{ config('app.timezone') }}: {{ date('Y-m-d H:i:s') }}</span>
                    {{--<a href="#" class="d-none btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">
                        Add New
                    </a>--}}

                    <div class="d-none kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                        <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                            <span><i class="flaticon2-search-1"></i></span>
                        </span>
                    </div>
                </div>
                <div class="kt-subheader__toolbar d-none">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn kt-subheader__btn-secondary">Today</a>
                        <a href="#" class="btn kt-subheader__btn-secondary">Month</a>
                        <a href="#" class="btn kt-subheader__btn-secondary">Year</a>
                        <a href="#" class="btn kt-subheader__btn-primary">
                            Actions &nbsp;

                            <!--<i class="flaticon2-calendar-1"></i>-->
                        </a>
                        <div class="dropdown dropdown-inline" data-toggle-="kt-tooltip" title="Quick actions" data-placement="left">
                            <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" id="Combined-Shape" fill="#000000" />
                                    </g>
                                </svg>

                                <!--<i class="flaticon2-plus"></i>-->
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                                <!--begin::Nav-->
                                <ul class="kt-nav">
                                    <li class="kt-nav__head">
                                        Add anything or jump to:
                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                            <span class="kt-nav__link-text">Order</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                            <span class="kt-nav__link-text">Ticket</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-link"></i>
                                            <span class="kt-nav__link-text">Goal</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                            <span class="kt-nav__link-text">Support Case</span>
                                            <span class="kt-nav__link-badge">
																<span class="kt-badge kt-badge--brand kt-badge--rounded">5</span>
															</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__foot">
                                        <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                        <a class="btn btn-clean btn-bold btn-sm kt-hidden" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                    </li>
                                </ul>

                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <!--Begin::Dashboard 1-->

            <!--Begin::Row-->
            <div class="row">
                <div class="col-lg-12 col-xl-12 order-lg-12 order-xl-12">

                    <!--begin:: Widgets/Activity-->
                    <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                        <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    @lang('admin/dashboard.activity')
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-widget17">
                                <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                                    <div class="kt-widget17__chart" style="height:120px;">
                                        <canvas id="kt_chart_activities"></canvas>
                                    </div>
                                </div>
                                <div class="kt-widget17__stats">
                                    <div class="kt-widget17__items">
                                        <div class="kt-widget17__item">
                                            <span class="kt-widget17__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" id="Combined-Shape" fill="#000000" />
                                                        <rect id="Rectangle-Copy-2" fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <span class="kt-widget17__subtitle">
                                                @lang('admin/dashboard.users')
                                            </span>
                                            <span class="kt-widget17__desc">
                                                {{ $totalUser }} @lang('admin/dashboard.new_users')
                                            </span>
                                        </div>
                                        <div class="kt-widget17__item">
                                            <span class="kt-widget17__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon id="Bound" points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <span class="kt-widget17__subtitle">
                                                @lang('admin/dashboard.news')
                                            </span>
                                            <span class="kt-widget17__desc">
                                                {{ $totalNews }} @lang('admin/dashboard.new_items')
                                            </span>
                                        </div>
                                        <div class="kt-widget17__item">
                                            <span class="kt-widget17__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                                        <path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                        <path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z" id="Combined-Shape" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <span class="kt-widget17__subtitle">
                                                @lang('admin/dashboard.contacts')
                                            </span>
                                            <span class="kt-widget17__desc">
                                                {{ $totalContact }} @lang('admin/dashboard.new_contacts')
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Activity-->
                </div>

            </div>

            <!--End::Row-->

            <!--Begin::Row-->
            <div class="row">

                <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">

                    <!--begin:: Widgets/New Users-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    @lang('admin/dashboard.new_users')
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">
                                            @lang('admin/dashboard.total')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_widget4_tab1_content">
                                    <div class="kt-widget4">
                                        @foreach($newUsers as $user)
                                        <div class="kt-widget4__item">
                                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                <img src="{{ url($user->avatar ?? '/assets/admin/assets/media/users/100_4.jpg') }}" alt="">
                                            </div>
                                            <div class="kt-widget4__info">
                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                    {{ $user->name }}
                                                </a>
                                                <p class="kt-widget4__text">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                            <a href="#" class="d-none btn btn-sm btn-label-brand btn-bold">Follow</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/New Users-->
                </div>
                <div class="col-6">

                    <!-- GG Analytics -->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Google Analytics
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                    <!-- Tab item -->
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab_gg1_content" role="tab">
                                            @lang('admin/dashboard.ga_visit')
                                        </a>
                                    </li>
                                    <!-- /.Tab item -->
                                    <!-- Tab item -->
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#kt_widget4_tab_gg2_content" role="tab">
                                            @lang('admin/dashboard.ga_refer')
                                        </a>
                                    </li>
                                    <!-- /.Tab item -->
                                    <!-- Tab item -->
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#kt_widget4_tab_gg3_content" role="tab">
                                            @lang('admin/dashboard.ga_browser')
                                        </a>
                                    </li>
                                    <!-- /.Tab item -->
                                    <!-- Tab item -->
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#kt_widget4_tab_gg4_content" role="tab">
                                            @lang('admin/dashboard.ga_top_page')
                                        </a>
                                    </li>
                                    <!-- /.Tab item -->
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <!-- Tab content item -->
                                <div class="tab-pane active" id="kt_widget4_tab_gg1_content">
                                    <div class="kt-widget14__chart" style="height:120px;">
                                        <canvas id="total_visits"></canvas>
                                    </div>
                                    <script>
                                        var total_visits_labes = [];
                                        var total_visits_visitors = [];
                                        var total_visits_pageViews = [];
                                        @foreach($total_visitors as $tt)
                                            total_visits_labes.push('{{ $tt['date']->format('m-d-Y') }}');
                                            total_visits_visitors.push('{{ $tt['visitors'] }}');
                                            total_visits_pageViews.push('{{ $tt['pageViews'] }}');
                                        @endforeach

                                    </script>
                                </div>
                                <!-- /.Tab content item -->
                                <!-- Tab content item -->
                                <div class="tab-pane " id="kt_widget4_tab_gg2_content">
                                    <div class="kt-widget4">
                                        @foreach($top_referrers as $item)
                                        <div class="kt-widget4__item">
                                            {{--<div class="kt-widget4__pic kt-widget4__pic--pic">
                                                <img src="{{ url($user->avatar ?? '/assets/admin/assets/media/users/100_4.jpg') }}" alt="">
                                            </div>--}}
                                            <div class="kt-widget4__info">
                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                    {{ $item['url'] }}
                                                </a>
                                                {{--<p class="kt-widget4__text">
                                                </p>--}}
                                            </div>
                                            <a href="javascript:void(0);" class=" btn btn-sm btn-label-brand btn-bold">{{ $item['pageViews'] }}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.Tab content item -->
                                <!-- Tab content item -->
                                <div class="tab-pane " id="kt_widget4_tab_gg3_content">
                                    <div class="kt-widget4">
                                        @foreach($top_browser as $item)
                                            <div class="kt-widget4__item">
                                                {{--<div class="kt-widget4__pic kt-widget4__pic--pic">
                                                    <img src="{{ url($user->avatar ?? '/assets/admin/assets/media/users/100_4.jpg') }}" alt="">
                                                </div>--}}
                                                <div class="kt-widget4__info">
                                                    <a href="javascript:void(0);" class="kt-widget4__username">
                                                        {{ $item['browser'] }}
                                                    </a>
                                                    {{--<p class="kt-widget4__text">
                                                    </p>--}}
                                                </div>
                                                <a href="javascript:void(0);" class=" btn btn-sm btn-label-brand btn-bold">{{ $item['sessions'] }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.Tab content item -->
                                <!-- Tab content item -->
                                <div class="tab-pane " id="kt_widget4_tab_gg4_content">
                                    <div class="kt-widget4">
                                        @foreach($newUsers as $user)
                                        <div class="kt-widget4__item">
                                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                <img src="{{ url($user->avatar ?? '/assets/admin/assets/media/users/100_4.jpg') }}" alt="">
                                            </div>
                                            <div class="kt-widget4__info">
                                                <a href="javascript:void(0);" class="kt-widget4__username">
                                                    {{ $user->name }}
                                                </a>
                                                <p class="kt-widget4__text">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                            <a href="#" class="d-none btn btn-sm btn-label-brand btn-bold">Follow</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.Tab content item -->
                            </div>
                        </div>
                    </div>
                    <!-- /.GG Analytics -->
                </div>
                <div class="col-6">

                    <!--begin:: Widgets/Profit Share-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Google Analytics
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab_pie1_content" role="tab">
                                            @lang('admin/dashboard.ga_device')
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab_pie2_content" role="tab">
                                            @lang('admin/dashboard.ga_new_return')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_widget2_tab_pie1_content">

                                    <div class="kt-widget14">
                                        <div class="kt-widget14__content">
                                            <div class="kt-widget14__chart">
                                                <div class="kt-widget14__stat">{{ array_sum($listDevice) }}</div>
                                                <canvas class="pie_chart" id="device_chart" style="height: 140px; width: 140px;"></canvas>
                                            </div>
                                            <div class="kt-widget14__legends">
                                                <script>
                                                    var $devicesLabel = [];
                                                    var $devicesData = [];
                                                </script>
                                                @foreach($listDevice as $name => $number)
                                                    <script>
                                                        $devicesLabel.push('{{ $name }}');
                                                        $devicesData.push({{ $number }});
                                                    </script>
                                                    <div class="kt-widget14__legend">
                                                        <span class="kt-widget14__bullet kt-bg-{{ $deviceColor[$name] ?? 'success' }}"></span>
                                                        <span class="kt-widget14__stats">{{ number_format(($number/(array_sum($listDevice) ?? 1))*100, 0) }}% {{ $name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="kt_widget2_tab_pie2_content">

                                    <div class="kt-widget14">
                                        <div class="kt-widget14__content">
                                            <div class="kt-widget14__chart">
                                                <div class="kt-widget14__stat">{{ array_sum($listUserTypes) }}</div>
                                                <canvas class="pie_chart" id="user_type_chart" style="height: 140px; width: 140px;"></canvas>
                                            </div>
                                            <div class="kt-widget14__legends">
                                                <script>
                                                    var $utLabel = [];
                                                    var $utData = [];
                                                </script>
                                                @foreach($listUserTypes as $name => $number)
                                                    <script>
                                                        $utLabel.push('{{ $name }}');
                                                        $utData.push({{ $number }});
                                                    </script>
                                                    <div class="kt-widget14__legend">
                                                        <span class="kt-widget14__bullet kt-bg-{{ $userTypeColor[$name] ?? 'success' }}"></span>
                                                        <span class="kt-widget14__stats">{{ number_format(($number/(array_sum($listUserTypes) ?? 1))*100, 0) }}% {{ $name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .pie_chart { width: 140px !important; height: 140px !important; }
                    </style>
                    <!--end:: Widgets/Profit Share-->
                </div>
                <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">

                    <!--begin:: Widgets/Tasks -->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    @lang('admin/dashboard.new_contacts')
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab">
                                            @lang('admin/dashboard.total')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_widget2_tab1_content">
                                    <div class="kt-widget4">
                                        @foreach($newContact as $user)
                                            <div class="kt-widget4__item">
                                                <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                    <img src="{{ url($user->avatar ?? '/assets/admin/assets/media/users/100_4.jpg') }}" alt="">
                                                </div>
                                                <div class="kt-widget4__info">
                                                    <a href="javascript:void(0);" class="kt-widget4__username">
                                                        {{ $user->name }}
                                                    </a>
                                                    <p class="kt-widget4__text">
                                                        {{ $user->email }}
                                                    </p>
                                                </div>
                                                <a href="#" class="d-none btn btn-sm btn-label-brand btn-bold">Follow</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Tasks -->
                </div>
            </div>

            <!--End::Row-->

            <!--End::Dashboard 1-->
        </div>

        <!-- end:: Content -->
    </div>

@endsection

@section('pageJs')
    <script src="{{ url('/') }}/assets/admin/assets/js/v1/pages/dashboard.js" type="text/javascript"></script>
@endsection
