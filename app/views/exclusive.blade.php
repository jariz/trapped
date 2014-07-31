@extends($plain ? "plain" : "layout")

@section('content')
<div class="container">

    <div class="page-header">
        <h1>{{$exclusive->title}}<small></small></h1>
    </div>

    <div class="media row">
        <div class="col-lg-3" style="text-align: center">
            <img src="{{str_replace('large', 't500x500', $exclusive->art)}}" width="250" height="250">
            <p style="margin-top: 20px">
                <a href="#" class="trapped-player-play btn btn-primary btn-lg" data-url="{{$exclusive->link}}" data-id="{{$exclusive->id}}"><i class="fa fa-play"></i></a>
                @if($exclusive->download && !empty($exclusive->download))
                <a data-no-async="true" class="btn btn-danger btn-lg" href="{{url('dl/'.$exclusive->download)}}" download="{{$exclusive->download}}"><i class="fa fa-download"></i> </a>
                @endif
            </p>
        </div>
        <div class="col-lg-9">
            <p>
                {{$exclusive->desc}}
            </p>
        </div>
    </div>
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
