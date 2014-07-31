@extends($plain ? "plain" : "layout")

@section('content')

<div class="container">

    <div class="page-header">
        <h1>Blog<small></small></h1>
    </div>

    @foreach($posts as $post)
    <div class="post">
        <h3>{{$post->title}}</h3>
        <p class="text-muted">By {{$post->author->name}} at {{$post->created_at}}</p>
        {{$post->content}}
        <hr>
    </div>
    @endforeach


    @if(count($posts) == 0)
    <p class="text-muted">Nothing here yet :(</p>
    @endif

    {{$posts->links()}}

</div>

@stop