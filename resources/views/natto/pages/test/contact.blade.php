@extends('natto.layouts.default')
@section('header')
    <title>{{ config('system.general_title') }}</title>
    <meta name="description" content="{{ config('system.general_description') }}">
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ Request::url()  }}" />
    <meta property="og:image" content="{{ url(config('system.general_share') ?? '') }}" />
    <meta property="og:title" content="{{ config('system.general_title') }}" />
    <meta property="og:description" content="{{ config('system.general_description') }}" />
@stop

@section('content')
    <div class="container" id="app">
        <form action="" id="js-form-contact">
            @csrf
            <div>
                <input type="text" name="name" v-model="name">
            </div>
            <div>
                <input type="text" name="email" v-model="email">
            </div>
            <div>
                <input type="text" name="mobile" v-model="mobile">
            </div>
            <div>
                <select v-model="day">
                    <option value="">Ngày</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select v-model="month">
                    <option value="">Tháng</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select v-model="year">
                    <option value="">Năm</option>
                    @for ($i = 1920; $i <= 2020; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                Nam <input type="radio" name="gender" value="0" v-model="gender">
                Nữ <input type="radio" name="gender" value="1" v-model="gender">
            </div>
            <div class="alert-form"></div>
            <button type="button" v-on:click="submitForm">Đăng ký</button>
        </form>
    </div>
@stop

@section('footer')
    <script src="{{ url('assets/natto/js/contact.js?'.config('system.version')) }}"></script>
@stop
