@extends('admin.layout')

@section('content')
<div class="container container-layout moar-padding">
    {{Form::open(array("autocomplete"=>"off","class"=>"form-horizontal", "route"=>"dashboard.do-settings"))}}
    @include('includes.errors')
        <fieldset>
            <legend>User settings</legend>
            <div class="form-group">
                {{Form::label("email", "Email", array("class"=>"col-lg-2 control-label"))}}
                <div class="col-lg-10">
                    {{Form::text("email", @$data["email"], array("autocomplete"=>"off","class"=>"form-control","placeholder"=>"Email"))}}
                </div>
            </div>

            <div class="form-group">
                {{Form::label("new_password", "New password", array("class"=>"col-lg-2 control-label"))}}
                <div class="col-lg-10">
                    {{Form::password("new_password", array("autocomplete"=>"off","class"=>"form-control","placeholder"=>"New password"))}}
                    <span class="text-info"><br><i class="glyphicon glyphicon-info-sign"></i> Leave this field empty if you don't want to change your password</span>
                </div>
            </div>

            <div class="form-group">
                {{Form::label("new_password_confirm", "New password (repeat)", array("class"=>"col-lg-2 control-label"))}}
                <div class="col-lg-10">
                    {{Form::password("new_password_confirm", array("autocomplete"=>"off","class"=>"form-control","placeholder"=>"New password (repeat)"))}}
                </div>
            </div>

            <legend style="padding-top:10px;">Verification</legend>
            <div class="form-group">
                {{Form::label("current_password", "Current password", array("class"=>"col-lg-2 control-label"))}}
                <div class="col-lg-10">
                    {{Form::password("current_password", array("autocomplete"=>"off","class"=>"form-control","placeholder"=>"Current password"))}}
                </div>
            </div>
        </fieldset>
    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>
    {{Form::close()}}
</div>
@stop