<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>

<div id="loginModal" class="modal modal-login">
    <div class="form text-center">
        <div class="pu-b1-text ">Bạn có thể đăng nhập để lưu lại thông tin cá nhân, bài test,...</div><br/>
        <a href="#" class="btn-fblogin-modal btn btn-sm btn-primary" style="background-color: #253785;">
            <i class="fa fa-facebook" style="margin-right: 7px"></i>
            Đăng nhập bằng Facebook
        </a>
        {{--<a data-href="{{ url('contest/vietid_login') }}" href="#" class="btn btn-vietid btn-vidlogin-modal btn-sm btn-warning" style="">
            <img class="img-fluid image_full" style="margin-right: 7px" src="{{url('assets/images/vietid.png')}}" alt="">
            Đăng nhập bằng VietID
        </a>--}}
        <a href="#" class="btn-gg btn btn-sm btn-primary" style="background-color: #c61015; border-color: #c61015;">
            <i class="fa fa-google" style="margin-right: 7px"></i>
            Đăng nhập bằng Google
        </a>
        <br/><br/><br/>
        <div>
            * Trong trường hợp trình duyệt của bạn không hỗ trợ Popup và không bấm được nút đăng nhập ở trên, bạn có thể bấm
            <a class="redirect_link" href="#">vào đây</a> để tiếp tục đăng nhập.
        </div>
    </div>
    <div class="process">
        Đang xử lý...
    </div>
</div>

<div id="voteModal" class="modal">
    <div class="modal-headers" style="display: block">
        <button type="button" class="close hidden" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xác nhận Bình chọn</h4>
    </div>
    <div class="modal-bodys" style="">
        <div class="alert alert-message alert-success hidden"></div>

        <div class="alert-captcha">
            Để Bình chọn cho bài này, bạn vui lòng bấm nút tick xác nhận dưới đây:<br/><br/>
            <div id="recaptchaVote"></div>
        </div>
    </div>
</div>

<div id="sysModal" class="modal">
    <div class="form text-center body">
    </div>
</div>

{{--    popup login--}}
<div id="profile" class="modal popup-login">
    <form class="form-login form-profile">
        <h3 class="form-title">Chào {{ Auth::check() ? Auth::user()->name : '' }}</h3>
        <div class="form-des">Hãy điền đầy đủ thông tin cá nhân để Lotus gửi những phần qua hấp dẫn trong trường hợp bạn được giải nhé!</div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Họ và tên</label>
            <div class="col-sm-8">
                <input name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}"  type="text" class="form-control" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Số điện thoại</label>
            <div class="col-sm-8">
                <input name="mobile" value="{{ Auth::check() ? Auth::user()->mobile : '' }}"  type="text" class="form-control" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
                <input name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" type="text" class="form-control" >
            </div>
        </div>
        <div class="alert hidden alert-profile"></div>
        <button onclick="return $.app.submitProfile(this, '.form-profile');" class="btn-send">Gửi</button>
    </form>
</div>
{{--    popup login--}}


<script>
    $.app.init({
        url: '{{ url('/') }}/',
        token: '{!! csrf_token() !!}',
        captcha_sitekey: '{{ config('system.apikey_google_captcha_sitekey') }}',
        facebook_appid: '{{ config('system.apikey_facebook_app_id') }}',
        contest_hastag: '{{ config('system.share_hastag') }}',
        contest_quote: '{{ config('system.share_quote') }}',
        contest_campaign: '{{ config('system.share_utm_campaign') }}',
    });
</script>
<script>
    @if(app('request')->input('fbRedirect'))
    // Redirect user to link/action when comeback from facebook login
    $(document).ready(function () {
        var $href = window.location.href.replace('?fbRedirect=1', '').replace('#_=_', '').replace('#', '');
        //$.app.checkProfile();

        if ($href !== $.app.cookie.getCookie('fbRedirect')) {
            window.location.href = $.app.cookie.getCookie('fbRedirect');
        } else {
            var $cb = $.app.cookie.getCookie('fbCallback');
            if ($cb) {
                window[$cb]({code: 1, redirect: 1});
            }
        }
    });
    @endif

    @if(app('request')->input('share') && !app('request')->input('error_code'))
    $(document).ready(function () {
        $.app.contest.shareForm('{{ app('request')->input('share') }}');
    });
    @endif

    @if(app('request')->input('vote'))
    $(document).ready(function () {
        $.app.contest.vote('{{ app('request')->input('vote') }}');
    });
    @endif

</script>
