@extends("admin.layout")

@section("content")
<div class="container container-layout moar-padding">
    <div class="panel panel-danger">
        <div class="panel-heading">
            {{$title}}
        </div>
        <div class="panel-body">
            {{$message}}
        </div>
    </div>
</div>
@stop