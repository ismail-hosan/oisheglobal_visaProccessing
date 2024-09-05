@extends('frontant_with_extra_path.layouts.master')

@section('title')
Video
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a class="active">Video </a></li>
@endsection


@section('main-content')
  <style>
        h2.text-st {
            font-family: 'Arial', sans-serif;
            color: #2c3e50;
            text-align: center;
            font-size: 2.5em;

            letter-spacing: 0.1em;
            background: linear-gradient(90deg, #4ca1af, #c4e0e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 50px;
        }
    </style>
<script>
    var scriptUrl = 'https:\/\/www.youtube.com\/s\/player\/b22ef6e7\/www-widgetapi.vflset\/www-widgetapi.js';try{var ttPolicy=window.trustedTypes.createPolicy("youtube-widget-api",{createScriptURL:function(x){return x}});scriptUrl=ttPolicy.createScriptURL(scriptUrl)}catch(e){}var YT;if(!window["YT"])YT={loading:0,loaded:0};var YTConfig;if(!window["YTConfig"])YTConfig={"host":"https://www.youtube.com"};
if(!YT.loading){YT.loading=1;(function(){var l=[];YT.ready=function(f){if(YT.loaded)f();else l.push(f)};window.onYTReady=function(){YT.loaded=1;var i=0;for(;i<l.length;i++)try{l[i]()}catch(e){}};YT.setConfig=function(c){var k;for(k in c)if(c.hasOwnProperty(k))YTConfig[k]=c[k]};var a=document.createElement("script");a.type="text/javascript";a.id="www-widgetapi-script";a.src=scriptUrl;a.async=true;var c=document.currentScript;if(c){var n=c.nonce||c.getAttribute("nonce");if(n)a.setAttribute("nonce",
n)}var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})()};
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2 class="text-st">Oisheglobal</h2>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($videos as $index => $video)
        <div class="col-md-4 mb-4" style="margin-bottom: 32px;">
            <div class="card">
                <div class="card-body">

                    <div class="embed-responsive embed-responsive-16by9">
                      @if(preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->link, $matches))
                            <iframe class="embed-responsive-item" id="video-{{ $index }}" src="https://www.youtube.com/embed/{{ $matches[1] }}?enablejsapi=1" allowfullscreen></iframe>
                        @endif
                    </div>
                      <h6 class="card-title text-center" style="background: #4D50A1; color: white; padding: 11px;    margin-top: 3px;">{{ $video->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    var players = [];
    function onYouTubeIframeAPIReady() {
        document.querySelectorAll('iframe').forEach((iframe, index) => {
            const player = new YT.Player(iframe.id, {
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
            players.push(player);
        });
    }

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {
            players.forEach(player => {
                if (player !== event.target) {
                    player.pauseVideo();
                }
            });
        }
    }
</script>
@endsection