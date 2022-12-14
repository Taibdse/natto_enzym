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
                                    <a href="{{ url('/') }}" title="Tranh ch???" >Trang ch???</a>
                                </li>
                                <li @if(request()->is('products')) class="active" @endif>
                                    <a class="" href="{{ url('products') }}" title="S???n ph???m">S???n ph???m</a>
                                </li >
                                @if ($homeCategory)
                                    <li @if(request()->is($homeCategory->link ?? '')) class="active" @endif>
                                        <a href="{{ url($homeCategory->link ?? '') }}" title="Tin t???c ?????t qu???">Tin t???c ?????t qu???</a>
                                    </li>
                                @endif
                                <li @if(request()->is('videos')) class="active" @endif>
                                    <a href="{{ url('videos') }}" title="Video">Video</a>
                                </li>
                                <li class="p-7 flase-btn">
                                    <a href="{{ url('/contact') }}" title="Ki???m tra nguy c?? ?????t qu???" class="btn-check-sk">Ki???m tra nguy c?? ?????t qu???</a>
                                </li>
                                <li class="action-user">
                                    @if(!Auth::check())
                                        <div class="user-log">
                                            <div class="user-img">
                                                <img src="{{url('assets/natto/images/default/avar-user.png')}}" alt="avatar-user">
                                            </div>
                                            <div class="login-register">
                                                <a onclick="return $.app.checkLogin('{{ url('/') }}');" class="btn-login" href="javascript:void(0)"><span>????ng nh???p</span></a>
                                                <a onclick="return $.app.checkLogin('{{ url('/') }}');" class="btn-login" href="javascript:void(0)"><span>????ng k??</span></a>
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
                                                <a href="{{ url('logout') }}"> ( Tho??t )</a>
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
                <p> <b class="p-name">C??NG TY C??? PH???N D?????C H???U GIANG</b> <br>
                    <b class="p-locality">?????a ch???:</b> 288 Bis Nguy???n V??n C???, P. An H??a, Q. Ninh Ki???u, TP. C???n Th?? <br>
                    <b class="p-author">Ng?????i ?????i di???n:</b> Mr. Masashi Nakaura <br>
                    <b class="p-summary">Ch???u tr??ch nhi???m n???i dung:</b> ??ng ??o??n ????nh Duy Kh????ng <br>
                    <b>Li??n h???:</b> (0292). 3891433 ??? 3890802 <br>
                    <b>Email:</b> <a href="mailto:dhgpharma@dhgpharma.com.vn" class="u-email" >dhgpharma@dhgpharma.com.vn</a></p>
            </div>
            <div class="col-sm-4">
                <p>Gi???y ch???ng nh???n ????ng k?? doanh nghi???p: s??? 1800156801 do S??? K??? ho???ch ?????u t?? TP. C???n Th?? c???p ng??y 02 th??ng 01 n??m 2020</p>
            </div>
            <div class="col-sm-4">
                <p>Gi???y ph??p thi???t l???p trang th??ng tin ??i???n t??? t???ng h???p S??? 07A/GP-TT??T do S??? Th??ng tin v?? Truy???n th??ng Tp. C???n Th?? c???p ng??y 26 th??ng 09 n??m 2017</p>
            </div>
        </div>
    </div>
</footer>
<div id="popupproduct" class="modal popupproduct">
    <div class="product-store-cnt" id="product-store">
        <h3>S???N PH???M HI???N ??ANG C?? B??N <br>
            T???I C??C NH?? THU???C TR??N TO??N QU???C</h3>
        <p>H??? th???ng c??c c???a h??ng</p>
        <img src="{{url('assets/natto/images/default/list-store-3.png')}}" alt="h??? th???ng c??c c???a h??ng" class="img-fluid list-store">
        <p>H??? th???ng c??c c???a h??ng mua online</p>
        <ul>
            <li>
                <a href="https://nhathuoclongchau.com/thuc-pham-chuc-nang/nattoenzym-lo-90v-dhgpharma-14460.html" target="_blank" style="pointer-events: none;">
                    <img src="{{url('assets/natto/images/default/store1.png')}}" alt="nh?? thu???c long ch??u" class="img-fluid">
                </a>
            </li>
            <li>
                <a href="https://s.admicro.vn/PO0K9lz" target="_blank">
                    <img src="{{url('assets/natto/images/default/store2.png')}}" alt="pharmacity" class="img-fluid">
                </a>
            </li>
            <li>
                <a href="https://trungsoncare.com/collections/nattoenzym" target="_blank">
                    <img src="{{url('assets/natto/images/default/store3.png')}}" alt="trung s??n pharma" class="img-fluid">
                </a>
            </li>
        </ul>
    </div>
</div>
<div id="notify" class="modal notify">
    <div class="notify-txt">
        <p>Th??ng tin kho?? h???c s??? ???????c update trong th???i gian s???m nh???t. <br> Xin c???m ??n.</p>
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
        <span>(0292). 3899 000 <small>????? ???????c t?? v???n th??m chi ti???t</small></span>
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
