@extends('layouts.auth')

@section("content")
    <div class="m-login__title">
        <h3>{{ __('auth.2fa.2fa_setting') }}</h3>
    </div>

    <div class="containers">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-none">{{ __('auth.2fa.2fa_setting') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form role="form" method="post" action="{{ route('2fa_enable') }}">
                            {{ csrf_field() }}
                            <h2>{{ __('auth.2fa.scan_barcode') }}</h2>
                            <p class="text-muted">
                                {{ __('auth.2fa.scan_barcode_desc') }}
                            </p>
                            <p class="text-center">
                                <img src="{{ $qrCodeUrl }}" />
                            </p>
                            <h5>
                                {{ __('auth.2fa.enter_code_desc') }}
                            </h5>
                            <p class="text-muted">
                                {{ __('auth.2fa.enter_code_desc2') }}
                            </p>
                            <div class="form-group">
                                <input type="text" name="code" required class="form-control" placeholder="" autocomplete="off" maxlength="6">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">{{ __('auth.2fa.enable') }}</button>
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   href="{{ route('home') }}" class="btn btn-secondary float-right">{{ __('auth.2fa.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection