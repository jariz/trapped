@extends($plain ? "plain" : "layout")

@section('content')

<div class="container">
    <div class="page-header">
        <h1>TRAPPED.IO Radio</h1>
    </div>

    <div class="alert alert-warning">
        <p><strong><i class="fa fa-music"></i> DJ's wanted!</strong> Are you an expert on trap? Do you have a music library with thousands of tracks? We need you! <a href="mailto:michael@trapped.io">E-mail us!</a> (no mixing skills necessary)</p>
    </div>

    <p>
        TRAPPED Radio is here to bring you the very best in Trap music, 24 hours a day.<br>
        Featuring exclusive live mixes, guest DJ's, and some of the best trap that the internet has to offer, TRAPPED
        Radio will not disappoint!<br>
        Kick back, Keep it Trill, and Enjoy!
    </p>

    <div class="panel panel-primary" style="margin-top: 20px">
        <div class="panel-heading">
            Statistics
        </div>
        <div class="panel-body">
            <div class="col-lg-6">
                <p><span class="text-primary">Now playing: </span><br>{{$radio->current_song}}</p>
                @if($radio->prev) <p><span class="text-muted">Previous: </span><br>{{$radio->prev}}</p> @endif
                @if($radio->next) <p><span class="text-muted">Next: </span><br>{{$radio->next}}</p> @endif
                <p><span class="text-muted">Listeners: </span><br>{{$radio->listeners}}</p>
            </div>
            <div class="col-lg-6">
                @if($radio->current_show) <p><span class="text-primary">Current show: </span><br>{{$radio->current_show}}</p> @endif
                @if($radio->next_show) <p><span class="text-muted">Next show: </span><br>{{$radio->next_show}}</p> @endif

                <div class="airtime" style="margin-top:30px;">
                    <h3 class="text-center"><i style="margin-top:30px; display:block;" class="fa fa-spinner fa-spin fa-2x"></i></h3>
                </div>
            </div>
        </div>
    </div>

    <a href="#" onclick="Player.streamRadio(); return false;" class="btn btn-lg btn-primary"><i class="fa fa-music"></i> Listen</a>
    <a href="http://radio.trapped.io:8000/TRAPPED.m3u" class="btn btn-lg btn-danger"><i class="fa fa-file"></i> M3U</a>
    <a href="http://radio.trapped.io:8000/TRAPPED.xspf" class="btn btn-lg btn-warning"><i class="fa fa-file"></i>
        XSPF</a>
</div>
@stop