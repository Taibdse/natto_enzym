<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href="/">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('header')

    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>
    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ url('assets') }}/admin/assets/css/v1/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/admin/assets/css/v1/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/admin/assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ url('assets') }}/admin/assets/css/v1/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/admin/assets/css/v1/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/admin/assets/css/v1/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets') }}/admin/assets/css/v1/skins/aside/dark.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/admin/assets/media/logos/favicon.ico" />

    @yield('pageCss')

</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Logo" src="{{ url('/') }}/assets/admin/assets/media/logos/logo-light.png" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        @include('admin.common.menu')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            @include('admin.common.header')

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                @include('admin.common.message')

                @yield('content')
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        2019&nbsp;&copy;&nbsp;<a href="{{ url('/') }}" target="_blank" class="kt-link">{{ config('app.name') }}</a>
                    </div>
                    <div class="kt-footer__menu">
                        <a href="#" target="_blank" class="kt-footer__menu-link kt-link"></a>
                    </div>
                </div>
            </div>
            <!-- end:: Footer -->

            @yield('footer')
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->


<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ url('/') }}/assets/admin/assets/js/v1/plugins.bundle.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/admin/assets/js/v1/scripts.bundle.js" type="text/javascript"></script>

<!--begin::Page Scripts(used by this page) -->
<link rel="stylesheet" href="{{ url('assets/lib/cropper/cropper.css') }}"/>
<link rel="stylesheet" href="{{ url('assets/admin/admin.css') }}"/>

<script src="{{ url('assets/lib/sweetalert28.js') }}"></script>
<script src="{{ url('/') }}/assets/admin/assets/vendors/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{ url('assets/lib/cropper/cropper.js') }}"></script>

<script src="{{ url('/') }}/assets/lib/app.js" type="text/javascript"></script>
<script>
    $.app.init({
        url: '{{ url('/') }}/',
        adminUrl: '{{ url('/') }}/admin/',
        token: '{!! csrf_token() !!}',
        captcha_sitekey: '{{ config('custom.captcha_sitekey') }}',
        facebook_appid: '{{ config('custom.facebook_appid') }}'
    });

    $(activeParentMenu).addClass('kt-menu__item--open');
    $('.select2').select2({});
</script>
<script src="{{ url('assets/admin/admin.js') }}" type="text/javascript"></script>

@include('admin.common.media')

@yield('pageJs')

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
