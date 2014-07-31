<!DOCTYPE html>
<html>
<head>
    <title>Login - TRAPPED.IO</title>
    <link href="{{url('stylesheets/admin/screen.css')}}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{url('js/admin.js')}}"></script>
</head>
<body>
<div class="container container-login">
    <div class="panel panel-default panel-login">
        <div class="panel-heading">
            Dashboard Login
        </div>
        <div class="panel-body">
            <p class="logo">
                TRAPPED HQ
            </p>
            @if(Session::has("relogin"))
            <div class="alert alert-success">
                <h4>Please login again</h4>
                Your new settings have been applied.
            </div>
            @endif
            @include('includes.errors')

            {{Form::open(array('route'=>'dashboard.do-login', 'class'=>'form-horizontal form-login', 'style' => isset($forgot) ? "display:none" : ""))}}
            <div class="form-group">
                {{Form::label("email", "Email", array('class'=>'col-sm-3 control-label'))}}
                <div class="col-sm-9">
                    {{Form::text("email", Input::get("email"), array("class"=>"form-control", "id"=>"email", "placeholder"=>"Email"))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label("password", "Password", array('class'=>'col-sm-3 control-label'))}}
                <div class="col-sm-9">
                    {{Form::password("password", array("class"=>"form-control", "id"=>"password", "placeholder"=>"Password"))}}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                   <div class="checkbox">
                       <label class="control-label">
                         <input type="checkbox" name="remember-me" value="1" id="remember-me"> Remember me
                       </label>
                     </div>
                </div>
            </div>
            <a href="{{URL::route('dashboard')}}" class="btn btn-link forgot-password">Forgot your password?</a>
            <button type="submit" class="btn btn-success pull-right">Login</button>
            {{Form::close()}}

            {{Form::open(array('route'=>'dashboard.do-forgot', 'class'=>'form-horizontal form-forgot', 'style' => isset($forgot) ? "" : "display:none"))}}
            @if(isset($mailsend))
            <div class="alert alert-success">
                <h4>Email send</h4>
                <p>We have send an email to your address. You'll be able to restore your account from there.</p>
            </div>
            @endif
            <div class="form-group">
                {{Form::label("email", "Email", array('class'=>'col-sm-3 control-label'))}}
                <div class="col-sm-9">
                    {{Form::text("email", Input::get("email"), array("class"=>"form-control", "id"=>"email", "placeholder"=>"Email"))}}
                </div>
            </div>
            <a href="{{URL::route('dashboard')}}" class="btn btn-link link-login">Login?</a>
            <button type="submit" class="btn btn-success pull-right">Mail new password</button>
            {{Form::close()}}
        </div>
    </div>


</div>
</body>
</html>