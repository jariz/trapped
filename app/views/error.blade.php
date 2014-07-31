@extends("layout")

@section("content")
<div class="container">
    <div class="panel @if(!isset($class)) panel-danger @elseif {{$class}} @endif" style="margin-top:30px;">
        <div class="panel-heading">
            <i class="fa fa-warning"></i> {{$title}}
        </div>
        <div class="panel-body">
            {{$message}}
        </div>
    </div>
</div>
@stop