@extends($plain ? "plain" : "layout")

@section('content')

<div class="video">
    <div class="holder">

    </div>
    <div class="content">
        <div class="box">
            <div class="container">
                <h1>TRAPPED</h1>
                <div class="row">
                    <div class="col-lg-4">
                        <p>
                            Easily browse your favorite trap music, listen to exclusives premiered by trapped, and read our blog.
                        </p>
                        <p>
                            <a href="{{url('hot?autoplay')}}" class="async-nav btn btn-default btn-lg"><i class="fa fa-play"></i> Start</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop