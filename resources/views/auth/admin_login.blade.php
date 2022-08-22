@extends('layouts.auth')

@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ config('app.name', 'Laravel') }}</h3>
        </div>
        <form class="kt-form"  method="POST" action="{{ route('admin.login') }}">
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
                    @if(0 && Route::has('password.request'))
                        <a href="{{ route('password.request') }}" id="kt_login_forgot_1" class="kt-login__link">{{ __('common.forget_password') }}</a>
                    @endif
                </div>
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_signin_submits" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('common.sign_in') }}</button>
            </div>
        </form>
    </div>
    @if (count($listLanguage) > 0)
        <div class="select-lang">
            <ul>
                @foreach ($listLanguage as $lang)
                    <li>
                        <a href="{{ route('admin.changLanguage', $lang->locale ) }}"
                           class="@if ($lang->locale == app()->getLocale()) lang_act @endif">{{ $lang->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
