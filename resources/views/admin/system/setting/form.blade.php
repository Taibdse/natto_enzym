@extends('admin.layout')

@section('header')

@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                @lang('admin/system/setting.setting')
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('admin.dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    @lang('admin/dashboard.dashboard')
                </a>

                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route($route) }}" class="kt-subheader__breadcrumbs-link">
                    @lang('admin/system/setting.setting')
                </a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-selected="true">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            @lang('admin/system/setting.general.general_title')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#social" role="tab" aria-selected="false">
                            <i class="la la-phone" aria-hidden="true"></i>
                            @lang('admin/system/setting.contact.contact_title')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#apikey" role="tab" aria-selected="false">
                            <i class="la la-facebook" aria-hidden="true"></i>
                            API Key
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#email" role="tab" aria-selected="false">
                            <i class="la la-envelope" aria-hidden="true"></i>
                            Email
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#storage" role="tab" aria-selected="false">
                            <i class="la la-cloud-upload" aria-hidden="true"></i>
                            Storage
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#offline" role="tab" aria-selected="false">
                            <i class="la la-clock-o" aria-hidden="true"></i>
                            @lang('admin/system/setting.offline.off_title_tab')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {!! Form::open( ['url' => route($route), 'method' => 'POST', 'class' => 'kt-form kt-form--label-right formData', 'name'=>'formData', 'files'=>true] ) !!}
            <div class="kt-portlet__body">
                <input type="hidden" name="_action" value="save"/>
                <div class="tab-content">
                    <div class="tab-pane active" id="general" role="tabpanel">
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.general.form_title'), 'setting[general_title]', $settings['general_title']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextareaInput(trans('admin/system/setting.general.form_des'), 'setting[general_description]', $settings['general_description']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getSelectMediaInput(trans('admin/system/setting.general.form_favicon'), 'setting[general_favicon]', $settings['general_favicon']->value ?? '', false, '', 'text') !!}
                            {!! \App\Helpers\AdminHelper::getSelectMediaInput(trans('admin/system/setting.general.form_logo'), 'setting[general_logo]', $settings['general_logo']->value ?? '', false, '', 'text') !!}
                            {!! \App\Helpers\AdminHelper::getCropImageInput(trans('admin/system/setting.general.form_sharefb'), 'setting[general_share]', $settings['general_share']->value ?? '', false, '', '1200,630') !!}
                            {!! \App\Helpers\AdminHelper::getTextareaInput(trans('admin/system/setting.general.form_fanpage'), 'setting[general_fanpage]', $settings['general_fanpage']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextareaInput('Twitter', 'setting[general_twitter]', $settings['general_twitter']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextareaInput('Instagram', 'setting[general_instagram]', $settings['general_instagram']->value ?? '', false) !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="social" role="tabpanel">
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.admin_name'), 'setting[contact_admin_name]', $settings['contact_admin_name']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getEmailInput(trans('admin/system/setting.contact.admin_email'), 'setting[contact_admin_email]', $settings['contact_admin_email']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.admin_mobile'), 'setting[contact_admin_mobile]', $settings['contact_admin_mobile']->value ?? '', false) !!}
                        </div>
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_name'), 'setting[contact_name]', $settings['contact_name']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getEmailInput(trans('admin/system/setting.contact.contact_email'), 'setting[contact_email]', $settings['contact_email']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Contact Mobile', 'setting[contact_mobile]', $settings['contact_mobile']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_address'), 'setting[contact_address]', $settings['contact_address']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Contact Facebook Messenger', 'setting[contact_facebook_messenger]', $settings['contact_facebook_messenger']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_fb'), 'setting[contact_facebook]', $settings['contact_facebook']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_youtube'), 'setting[contact_youtube]', $settings['contact_youtube']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_twitter'), 'setting[contact_twitter]', $settings['contact_twitter']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_google_plus'), 'setting[contact_google_plus]', $settings['contact_google_plus']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.contact.contact_pinterest'), 'setting[contact_pinterest]', $settings['contact_pinterest']->value ?? '', false) !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="apikey" role="tabpanel">
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getTextInput('Facebook App ID', 'setting[apikey_facebook_app_id]', $settings['apikey_facebook_app_id']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Facebook App Secret', 'setting[apikey_facebook_app_secret]', $settings['apikey_facebook_app_secret']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Facebook Pixel ID', 'setting[apikey_facebook_pixel_id]', $settings['apikey_facebook_pixel_id']->value ?? '', false) !!}
                        </div>
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getTextInput('Google Captcha SiteKey', 'setting[apikey_google_captcha_sitekey]', $settings['apikey_google_captcha_sitekey']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Google Captcha Secret', 'setting[apikey_google_captcha_secret]', $settings['apikey_google_captcha_secret']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Google Tag ID', 'setting[apikey_google_tag_id]', $settings['apikey_google_tag_id']->value ?? '', false) !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="email" role="tabpanel">
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getSelectInput('Email Type', 'setting[email_type]', $settings['email_type']->value ?? '', false, ['smtp' => 'SMTP']) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Email Host', 'setting[email_host]', $settings['email_host']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Email Port', 'setting[email_port]', $settings['email_port']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.email.email_username'), 'setting[email_username]', $settings['email_username']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.email.email_password'), 'setting[email_password]', $settings['email_password']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput('Email Encryption', 'setting[email_encryption]', $settings['email_encryption']->value ?? '', false) !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="storage" role="tabpanel">
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getSelectInput('Storage Type', 'setting[storage_type]', $settings['storage_type']->value ?? '', false, ['public' => 'Public', 'storage' => 'Storage']) !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="offline" role="tabpanel">
                        <div class="kt-portlet__body">
                            {!! \App\Helpers\AdminHelper::getSelectInput(trans('admin/system/setting.offline.off_status'), 'setting[offline_status]', $settings['offline_status']->value ?? 'no', false, ['yes' => 'Yes', 'no' => 'No']) !!}
                            {!! \App\Helpers\AdminHelper::getDateInput(trans('admin/system/setting.offline.off_datetime'), 'setting[offline_datetime]', $settings['offline_datetime']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.offline.off_title'), 'setting[offline_title]', $settings['offline_title']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.offline.off_des'), 'setting[offline_description]', $settings['offline_description']->value ?? '', false) !!}
                            {!! \App\Helpers\AdminHelper::getSelectMediaInput(trans('admin/system/setting.offline.off_image'), 'setting[offline_image]', $settings['offline_image']->value ?? '', false, 'Select Offline Image', 'text') !!}
                            {!! \App\Helpers\AdminHelper::getTextInput(trans('admin/system/setting.offline.off_opencode'), 'setting[offline_opencode]', $settings['offline_opencode']->value ?? '', false) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-9">
                            <button type="submit" class="btn btn-success btn-submit" data-action="save"><i class="la la-save"></i>@lang('admin.common.save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- end:: Content -->
@endsection

@section('pageJs')
@endsection
