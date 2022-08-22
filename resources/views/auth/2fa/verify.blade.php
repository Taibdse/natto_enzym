@extends('layouts.auth')

@section('content')
    <div class="kt-login__forgot" style="display: block;">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Verify Code</h3>
            <div class="kt-login__desc">Enter your Google Authenticator Code</div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form class="kt-form" method="POST" action="{{ route('2fa_verify') }}">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Code" name="code" value="" required autocomplete="email" autofocus>
            </div>
            <div class="kt-login__actions">
                <button class="btn btn-brand btn-elevate kt-login__btn-primary">Verify</button>
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn btn-light btn-elevate kt-login__btn-secondary" href="">Cancel</button>
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

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection