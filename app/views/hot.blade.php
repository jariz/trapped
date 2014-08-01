@extends($plain ? "plain" : "layout")

@section('content')
<div class="container">

    <div class="page-header">
        <a onclick="Player.startPlaylist()" class="btn btn-default btn-lg pull-right" href="#"><i class="fa fa-play"></i> Play all</a>
        <h1>{{$headline}} <small>{{$description}}</small></h1>
    </div>

    <ul class="nav nav-tabs">
        @foreach(\Model\Subreddit::formatted() as $sub_formalname => $sub_name)
        <li @if($subreddit == $sub_name) class="active"@endif><a href="{{url(Request::segment(1).'/'.$sub_name)}}" data-toggle="tab">{{$sub_formalname}}</a></li>
        @endforeach
    </ul>

    @foreach($threads as $thread)
    <div class="media">
        <a class="pull-left" href="{{$thread->url}}" target="_blank">
            <img class="media-object" src="{{str_replace('500x500', '200x200', $thread->embed_thumbnail)}}" width="200" height="200">
        </a>
        <div class="media-body">
            <h4 style="margin-top:0; margin-bottom:10px;">{{$thread->title}} <span class="label @include('votes') pull-right">{{$thread->votes}}</span> </h4>
            <p>
                {{$thread->embed_desc}}
            </p>
            <p>
                <a href="#" class="btn btn-ridiculous btn-default trapped-player-play" data-url="{{$thread->url}}" data-id="{{$thread->id}}"><i class="fa fa-play"></i></a>
            </p>
        </div>
    </div>
    <hr>
    @endforeach
    <div id="subredditPaginator">
        {{$threads->links()}}
    </div>
</div>
@stop

@section('scripts')
<script>
    var playlist = [];
    @foreach($all_threads as $thread)
    playlist[{{$thread->id}}] = "{{$thread->url}}";
    @endforeach
    Player.setPlaylist(playlist);
</script>
@stop