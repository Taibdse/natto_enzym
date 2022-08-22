<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi-VN" dir="LTR" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="{{ config('app.name') }}">
    <meta property="fb:app_id" content="{{ config('system.apikey_facebook_app_id') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="{{ url(config('system.general_favicon') ?? '') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="{{ url('/') }}" />
    <meta name="twitter:card" content="summary" />
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url(mix('assets/lib/css/all.css')) }}">
    <link type="text/css" href="{{ url('assets/natto/css/style.css') }}?{{ config('system.version') }}" rel="stylesheet">
    <script src="{{ url('assets/lib/jquery/jquery-3.3.1.js?'.config('system.version')) }}"></script>
    <script src="{{ url(mix('assets/lib/js/all.js')) }}"></script>
     <script src="{{ url('assets/lib/js/vue.js') }}"></script>
    <script src="{{ url('assets/lib/js/axios.min.js') }}"></script>
    <script src="{{ url('assets/lib/js/scroll-loader.umd.js') }}"></script>
    <!-- Admicro Tag Manager -->
    <script> (function(a, b, d, c, e) { a[c] = a[c] || [];
            a[c].push({ "atm.start": (new Date).getTime(), event: "atm.js" });
            a = b.getElementsByTagName(d)[0]; b = b.createElement(d); b.async = !0;
            b.src = "//deqik.com/tag/corejs/" + e + ".js"; a.parentNode.insertBefore(b, a)
        })(window, document, "script", "atmDataLayer", "ATMIBPSUXSJ1D");
    </script>
    <!-- End Admicro Tag Manager -->
    @yield('header')
    @include('layouts.system_script_header')
</head>
<body>
<header class="header" >
    <div class="menu_mb">
        <button class="nav-toggle">
            <span></span>
        </button>
        <a href="{{ url('/') }}" class="logo_mb"><img class="img_logo_mb" src="{{url('assets/natto/images/default/logo.png')}}" alt="logo-nattoenzym-mb"/></a>
    </div>
    <div class="clearfix clearfix-60 d-lg-none"></div>
    <div class="header_nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <a href="{{ url('/') }}" class="logo_pc"><img src="{{url('assets/natto/images/default/logo.png')}}" alt="logo-nattoenzym"></a>
                </div>
                <div class="col-lg-10">
                    <div class="mainMenu">
                        <nav class="mainMenu__nav">
                            <ul class="mainMenu__navCont">
                                <li @if(request()->is('/')) class="active" @endif>
                                    <a href="{{ url('/') }}" title="Tranh chủ" >Trang chủ</a>
                                </li>
                                <li @if(request()->is('products')) class="active" @endif>
                                    <a class="" href="{{ url('products') }}" title="Sản phẩm">Sản phẩm</a>
                                </li >
                                @if ($homeCategory)
                                    <li @if(request()->is($homeCategory->link ?? '')) class="active" @endif>
                                        <a href="{{ url($homeCategory->link ?? '') }}" title="Tin tức đột quỵ">Tin tức đột quỵ</a>
                                    </li>
                                @endif
                                <li @if(request()->is('videos')) class="active" @endif>
                                    <a href="{{ url('videos') }}" title="Video">Video</a>
                                </li>
                                <li class="p-7 flase-btn">
                                    <a href="{{ url('/contact') }}" title="Kiểm tra nguy cơ đột quỵ" class="btn-check-sk">Kiểm tra nguy cơ đột quỵ</a>
                                </li>
                                <li class="action-user">
                                    @if(!Auth::check())
                                        <div class="user-log">
                                            <div class="user-img">
                                                <img src="{{url('assets/natto/images/default/avar-user.png')}}" alt="avatar-user">
                                            </div>
                                            <div class="login-register">
                                                <a onclick="return $.app.checkLogin('{{ url('/') }}');" class="btn-login" href="javascript:void(0)"><span>Đăng nhập</span></a>
                                                <a onclick="return $.app.checkLogin('{{ url('/') }}');" class="btn-login" href="javascript:void(0)"><span>Đăng ký</span></a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="user">
                                            <a href="javascript:;">
                                                <img class="avat"  src="{{ url(Auth::user()->avatar) }}" alt="avatar-user">
                                            </a>
                                            <div class="box">
                                                <a class="username" href="javascript:;">
                                                    <b>{{ Auth::user()->name }}</b>
                                                </a>
                                                <a href="{{ url('logout') }}"> ( Thoát )</a>
                                            </div>
                                        </div>
                                    @endif

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    @yield('content')
</main>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 h-card">
                <p> <b class="p-name">CÔNG TY CỔ PHẦN DƯỢC HẬU GIANG</b> <br>
                    <b class="p-locality">Địa chỉ:</b> 288 Bis Nguyễn Văn Cừ, P. An Hòa, Q. Ninh Kiều, TP. Cần Thơ <br>
                    <b class="p-author">Người đại diện:</b> Mr. Masashi Nakaura <br>
                    <b class="p-summary">Chịu trách nhiệm nội dung:</b> Ông Đoàn Đình Duy Khương <br>
                    <b>Liên hệ:</b> (0292). 3891433 – 3890802 <br>
                    <b>Email:</b> <a href="mailto:dhgpharma@dhgpharma.com.vn" class="u-email" >dhgpharma@dhgpharma.com.vn</a></p>
            </div>
            <div class="col-sm-4">
                <p>Giấy chứng nhận đăng ký doanh nghiệp: số 1800156801 do Sở Kế hoạch đầu tư TP. Cần Thơ cấp ngày 02 tháng 01 năm 2020</p>
            </div>
            <div class="col-sm-4">
                <p>Giấy phép thiết lập trang thông tin điện tử tổng hợp Số 07A/GP-TTĐT do Sở Thông tin và Truyền thông Tp. Cần Thơ cấp ngày 26 tháng 09 năm 2017</p>
            </div>
        </div>
    </div>
</footer>
<div id="popupproduct" class="modal popupproduct">
    <div class="product-store-cnt" id="product-store">
        <h3>SẢN PHẨM HIỆN ĐANG CÓ BÁN <br>
            TẠI CÁC NHÀ THUỐC TRÊN TOÀN QUỐC</h3>
        <p>Hệ thống các cửa hàng</p>
        <img src="{{url('assets/natto/images/default/list-store-3.png')}}" alt="hệ thống các cửa hàng" class="img-fluid list-store">
        <p>Hệ thống các cửa hàng mua online</p>
        <ul>
            <li>
                <a href="https://nhathuoclongchau.com/thuc-pham-chuc-nang/nattoenzym-lo-90v-dhgpharma-14460.html" target="_blank" style="pointer-events: none;">
                    <img src="{{url('assets/natto/images/default/store1.png')}}" alt="nhà thuốc long châu" class="img-fluid">
                </a>
            </li>
            <li>
                <a href="https://s.admicro.vn/PO0K9lz" target="_blank">
                    <img src="{{url('assets/natto/images/default/store2.png')}}" alt="pharmacity" class="img-fluid">
                </a>
            </li>
            <li>
                <a href="https://trungsoncare.com/collections/nattoenzym" target="_blank">
                    <img src="{{url('assets/natto/images/default/store3.png')}}" alt="trung sơn pharma" class="img-fluid">
                </a>
            </li>
        </ul>
    </div>
</div>
<div id="notify" class="modal notify">
    <div class="notify-txt">
        <p>Thông tin khoá học sẽ được update trong thời gian sớm nhất. <br> Xin cảm ơn.</p>
    </div>
</div>
{{--<div class="phone-cta">--}}
    {{--<a href="tel:02923899000">--}}
        {{--<img src="{{url('assets/natto/images/phone.png')}}" alt="phone-number" class="img-fluid">--}}
    {{--</a>--}}
{{--</div>--}}
<div class="social__bot">
    <a class="sc__fb" target="_blank" href="https://www.facebook.com/NattoEnzym.DHG">
        <span>Facebook</span>
        <div>
            <img src="{{ url('assets/natto/images/default/fb.png') }}" alt="">
        </div>

    </a>
    <a class="sc__call" href="tel:02923899000">
        <span>(0292). 3899 000 <small>Để được tư vấn thêm chi tiết</small></span>
        <div>
            <img src="{{ url('assets/natto/images/default/call.png') }}" alt="">
        </div>
    </a>
</div>
<script src="{{ url('assets/lib/app.js?'.config('system.version')) }}"></script>
<script>
    $(document).ready(function () {
        $.ui.menu.init();
        $.ui.popup.init();
    });
</script>

@include('layouts.system_script_footer')
@yield('footer')
</body>
</html>
