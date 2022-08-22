@extends('layouts.auth')

@section('content')
    <div class="kt-login__forgot" style="display: block;">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ __('common.forget_password') }}</h3>
            <div class="kt-login__desc">{{ __('auth.enter_your_email_to_reset_password') }} :</div>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="kt-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" value="{{ old('email') }}" id="kt_email" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_forgot_submit" type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('common.confirm') }}</button>&nbsp;&nbsp;
                <a href="{{ route('login') }}" class="btn btn-light btn-elevate kt-login__btn-secondary">{{ __('common.cancel') }}</a>
            </div>
        </form>
    </div>
    <div class="kt-login__account">
        <span class="kt-login__account-msg">
            {{ __('common.dont_have_an_account') }}
        </span>
        &nbsp;&nbsp;
        @if (Route::has('register'))
            <a href="{{ route('register') }}" id="kt_login_signup" class="kt-login__account-link">{{ __('common.sign_up') }} !</a>
        @endif
    </div>
@endsection