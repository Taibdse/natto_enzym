@extends('layouts.auth')

@section('content')
    <div class="kt-login__forgot" style="display: block;">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ 'Reset Password' }}</h3>
            <div class="kt-login__desc">{{ 'Please enter your new password' }} :</div>
        </div>
        <form class="kt-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="input-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <input id="password" placeholder="New password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <input id="password-confirm" placeholder="Repeat new password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_forgot_submit" type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('common.confirm') }}</button>&nbsp;&nbsp;
                <button onclick="window.location.href = '{{ route('login') }}';" class="btn btn-light btn-elevate kt-login__btn-secondary">{{ __('common.cancel') }}</button>
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