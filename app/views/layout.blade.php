<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}} - TRAPPED.IO</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('stylesheets/screen.css')}}">
    <script>
        var domain = "{{url()}}";
    </script>
</head>
<body>


<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{{url('/')}}" class="navbar-brand">TRAPPED</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                @foreach(Config::get("trapped.nav") as $label => $uri)
                <li @if(Request::segment(1) == $uri) class="active" @endif><a href="{{url($uri)}}">{{$label}}</a></li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a title="Reddit" target="_blank" href="http://trap.reddit.com"><i class="fa fa-reddit"></i></a>
                </li>
                <li>
                    <a title="IRC" target="_blank" href="http://webchat.snoonet.org/trap"><i class="fa fa-comment"></i></a>
                </li>
                <li>
                    <a title="Facebook" target="_blank" href="http://fb.com/trappedio"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a title="Twitter" target="_blank" href="http://twitter.com/trappedio"><i class="fa fa-twitter"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="navbar navbar-default navbar-fixed-bottom player">
    <div class="container">
        <ul class="nav navbar-nav controls">
            <li>
                <a href="#" class="prev"><i class="fa fa-backward"></i></a>
            </li>
            <li>
                <a href="#" class="play"><i class="fa fa-play"></i></a>
            </li>
            <li>
                <a href="#" class="pause"><i class="fa fa-pause"></i></a>
            </li>
            <li>
                <a href="#" class="next"><i class="fa fa-forward"></i></a>
            </li>
        </ul>
        <img width="45" height="45" style="display: none;" class="pull-left artwork">
        <p class="navbar-text title">
            <small class="author"></small><br>
            <span class="name"></span>
        </p>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a style="display:none;" class="listenon" target="_blank" href="http://soundcloud.com">Listen on <img src="{{url('img/sc-logo.png')}}"></a>
            </li>
        </ul>
    </div>
</div>

<div id="content">
    @yield('content')
</div>


<script src="{{url('js/plugins/jqury/jquery.min.js')}}"></script>
<script src="http://connect.soundcloud.com/sdk.js"></script>
<script src="{{url('js/plugins.js')}}"></script>
<script src="{{url('js/player.js')}}"></script>
<script src="{{url('js/asyncnav.js')}}"></script>
<script src="{{url('js/main.js')}}"></script>
@yield('scripts')
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<!--<script>-->
<!--    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=-->
<!--        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;-->
<!--        e=o.createElement(i);r=o.getElementsByTagName(i)[0];-->
<!--        e.src='//www.google-analytics.com/analytics.js';-->
<!--        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));-->
<!--    ga('create','UA-XXXXX-X');ga('send','pageview');-->
<!--</script>-->
</body>
</html>

<!-- Proudly not ran by Wordpress-->