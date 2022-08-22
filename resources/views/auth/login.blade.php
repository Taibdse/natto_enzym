@extends('layouts.auth')

@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ config('app.name', 'Laravel') }}</h3>
        </div>
        <form class="kt-form"  method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="{{ __('common.email') }}" name="email" autocomplete="off">

                @error('email')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="{{ __('common.password') }}" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row kt-login__extra">
                <div class="col">
                    <label class="kt-checkbox">
                        <input type="checkbox" name="remember"> {{ __('common.remember_me') }}
                        <span></span>
                    </label>
                </div>
                <div class="col kt-align-right">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" id="kt_login_forgot_1" class="kt-login__link">{{ __('common.forget_password') }}</a>
                    @endif
                </div>
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_signin_submits" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('common.sign_in') }}</button>
            </div>
        </form>
    </div>

    @if (Route::has('register'))
    <div class="kt-login__account">
        <span class="kt-login__account-msg">
            {{ __('common.dont_have_an_account') }}
        </span>
        &nbsp;&nbsp;
        <a href="{{ route('register') }}" id="kt_login_signup_1" class="kt-login__account-link">{{ __('common.sign_up') }} !</a>
    </div>
    @endif
@endsection