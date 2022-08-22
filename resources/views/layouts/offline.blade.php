<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="en" class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>	<html lang="en" class="ie ie7"> <![endif]-->
<!--[if IE 8 ]>	<html lang="en" class="ie ie8"> <![endif]-->
<!--[if IE 9 ]>	<html lang="en" class="ie ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>{{ config('system.general_title') }}</title>
    <meta name="description" content="{{ config('system.general_description') }}">
    <meta property="og:type" content="article"/>
    <meta property="og:site_name" content="{{ url('/')  }}"/>
    <meta property="og:url" content="{{ Request::url()  }}" />
    <meta property="og:image" content="{{ url(config('system.general_share')) }}" />
    <meta property="og:title" content="{{ config('system.general_title') }}" />
    <meta name="description" content="{{ config('system.general_description') }}">

    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link rel="shortcut icon" href="{{ url(config('system.general_favicon')) }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/lib/offline/styles.css?'.config('system.version')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="home" style="background: url({{ url(config('system.offline_image')) }}) no-repeat center top; background-size:cover;">
<div id="Header">
    <div class="wrapper">
        <h1>{{ config('system.offline_title') }}</h1>
    </div>
</div>
<div id="Content" class="wrapper">
    <h2>{!!  nl2br(config('system.offline_description'))  !!}</h2>
    <div class="countdown styled"></div>
    <div id="subscribe">
        <h3>Unlock code</h3>
        <form action="" method="get" onsubmit="">
            <p><input name="code" value="" placeholder="Enter your Member code" type="text" id=""/>
                <input type="submit" value="Go" style="border:2px solid  #fff"/></p>
        </form>
        <div id="socialIcons" style="">
            <ul>
                @if (config('system.contact_twitter'))<li><a href="{{ url(config('system.contact_twitter')) }}" target="_blank" title="Twitter" class="twitterIcon"><i class="fa fa-twitter" style="width: 28px;font-size: 28px;margin: 3px 0;"></i></a></li>@endif
                @if (config('system.contact_facebook'))<li><a href="{{ url(config('system.contact_facebook')) }}" target="_blank" title="facebook" class="facebookIcon"><i class="fa fa-facebook-f "style="width: 28px;font-size: 28px;margin: 3px 0;"></i></a></li>@endif
                @if (config('system.contact_youtube'))<li><a href="{{ url(config('system.contact_youtube')) }}" target="_blank" title="Youtube" class="youtubeIcon"><i class="fa fa-youtube"style="width: 28px;font-size: 28px;margin: 3px 0;"></i></a></li>@endif
                @if (config('system.contact_pinterest'))<li><a href="{{ url(config('system.contact_pinterest')) }}" target="_blank" title="Pintrest" class="pintrestIcon"><i class="fa fa-pinterest-p"style="width: 28px;font-size: 28px;margin: 3px 0;"></i></a></li>@endif
            </ul>
        </div>
    </div>
</div>

<div id="overlay"></div>

<!--Scripts-->
<script type="text/javascript">
    var endDate = "{{ config('system.offline_datetime') }}";
</script>
<script type="text/javascript" src="{{ url('assets/lib/offline/jquery-1.9.1.min.js?'.config('system.version')) }}"></script>
<script type="text/javascript" src="{{ url('assets/lib/offline/Backstretch.js?'.config('system.version')) }}"></script>
<script type="text/javascript" src="{{ url('assets/lib/offline/jquery.countdown.js?'.config('system.version')) }}"></script>
<script type="text/javascript" src="{{ url('assets/lib/offline/global.js?'.config('system.version')) }}"></script>

</body>
</html>
