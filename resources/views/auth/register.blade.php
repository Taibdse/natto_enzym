@extends('layouts.auth')

@section('content')
    <div class="kt-login__forgot" style="display: block;">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ 'Đăng ký tài khoản' }}</h3>
            <div class="kt-login__desc">{{ 'Vui lòng nhập thông tin cho tài khoản mới' }} :</div>
        </div>
        <form class="kt-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <input id="name" type="text" placeholder="Nhập tên tài khoản" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <input id="email" type="email" placeholder="Nhập địa chỉ e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <input id="password-confirm" placeholder="Nhập lại mật khẩu" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_forgot_submit" type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('common.confirm') }}</button>&nbsp;&nbsp;
                <a href="{{ route('login') }}" class="btn btn-light btn-elevate kt-login__btn-secondary">{{ __('common.cancel') }}</a>
            </div>
        </form>
    </div>
    <div class="kt-login__account">
        <span class="kt-login__account-msg">
            {{ 'Bạn đã có tài khoản?' }}
        </span>
        &nbsp;&nbsp;
        <a href="{{ route('login') }}" id="kt_login_signup_1" class="kt-login__account-link">{{ __('common.sign_in') }} !</a>
    </div>
@endsection