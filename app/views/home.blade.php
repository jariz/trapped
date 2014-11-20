@extends($plain ? "plain" : "layout")

@section('content')
<div class="hero">
    <div class="container">
        <h1>TRAPPED</h1>
        <p>
            Easily browse your favorite trap music, listen to tracks exclusive to TRAPPED, tune into our 24/7 radio and read our blog. <span>Welcome to the new trap experience.</span>
        </p>
        <p>
            <a href="#" onclick="Player.startPlaylist(); return false;" class="btn btn-primary"><i class="fa fa-play"></i> Start</a>
            <a href="#" onclick="Player.streamRadio(); return false;" class="btn btn-warning"><i class="fa fa-signal"></i> Start radio</a>
            <a href="{{url('about')}}" class="btn btn-info"><i class="fa fa-info"></i> About</a>
        </p>
    </div>
</div>

<div class="container">

<!--    <h1>Hot right now</h1>-->

    <div class="grid row">
        <?php $b = 0; ?>
        @foreach($threads as $thread)
        <?php $b++; ?>
        <div class="col-lg-4 item trapped-player-play" data-url="{{$thread->url}}" data-id="{{$b}}" style="background-image: url({{$thread->embed_thumbnail}})">
            <div class="hover">
                <span class="fa fa-play fa-5x"></span>
            </div>
            <div class="info">
                <h4>{{$thread->embed_title}}</h4>
                <span class="label @include('votes') pull-right">{{$thread->votes}}</span>
            </div>
        </div>
        @endforeach
        <div id="homePaginator">
            {{$threads->links()}}
        </div>
    </div>
</div>

@stop

@section('scripts')
<?php $i = 0; ?>
<script>
    var playlist = [];
    @foreach($all_threads as $thread)
    <?php $i++; ?>
    playlist[{{$i}}] = "{{$thread->url}}";
    @endforeach
    Player.setPlaylist(playlist);
</script>
@stop