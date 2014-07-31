<!DOCTYPE html>
<html>
<head>
    <title>Login - Fairtrade Amsterdam</title>
    <link href="{{url('plugins/bs/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('css/admin/screen.css')}}" rel="stylesheet">
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('js/admin.js')}}"></script>
</head>
<body>
<div class="container container-login">
    <img src="{{url('images/logo.png')}}" style="margin-bottom: 20px;">
    <div class="panel panel-primary panel-login">
        <div class="panel-heading">
            Fairtrade Amsterdam - Wachtwoord reset
        </div>
        <div class="panel-body">
            @include('includes.errors')
            {{Form::open(array('route'=>'dashboard-changepwd', 'class'=>'form-horizontal form-forgot'))}}
            <div class="form-group">
                {{Form::label("email", "E-mail", array('class'=>'col-sm-3 control-label'))}}
                <div class="col-sm-9 checkbox text-info">
                    {{$user->email}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label("password", "Wachtwoord", array('class'=>'col-sm-3 control-label'))}}
                <div class="col-sm-9">
                    {{Form::password("password", ['class'=>'form-control', 'placeholder' => "Wachtwoord"])}}
                </div>
            </div>
            <button type="submit" class="btn btn-success pull-right">Verander wachtwoord</button>

            {{Form::hidden("id", $user->id)}}
            {{Form::hidden("reset_code", $user->reset_code)}}
            {{Form::close()}}
        </div>
    </div>


</div>
</body>
</html>