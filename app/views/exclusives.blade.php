@extends($plain ? "plain" : "layout")

@section('content')
<div class="container">

    <div class="page-header">
        <h1>Exclusives<small></small></h1>
    </div>

    @foreach($exclusives as $exclusive)
    <div class="media">
        <img class="media-object pull-left" src="{{str_replace('large', 't500x500', $exclusive->art)}}" width="200" height="200">
        <div class="media-body">
            <h4 style="margin-top:0; margin-bottom:10px;">{{$exclusive->title}}</h4>
            <p>
                {{\Trapped\Util::truncate($exclusive->desc, 255)}}
            </p>
            <p>
                <a href="{{url('exclusives/'.$exclusive->slug)}}" class="btn btn-link pull-right">Listen and read more <i class="fa fa-chevron-right"></i></a>
            </p>
        </div>
    </div>
    <hr>
    @endforeach
    @if(count($exclusives) == 0)
    <p class="text-muted">Nothing here yet :(</p>
    @endif
    {{$exclusives->links()}}
</div>
@stop

@section('scripts')
<script>
    var playlist = [];
    @foreach($all_exclusives as $exclusive)
    playlist[{{$exclusive->id}}] = "{{$exclusive->link}}";
    @endforeach
    Player.setPlaylist(playlist);
</script>
@stop