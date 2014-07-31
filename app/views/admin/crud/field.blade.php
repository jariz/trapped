@if(!isset($field["hideInEdit"]) || !$field["hideInEdit"])
<div class="form-group">
        @if($field['type'] != 'json')
        {{Form::label($field["name"], $name, array('class'=>'col-sm-2 control-label'))}}
        @else
            <div class="col-sm-2"></div>
        @endif
        <div class="col-sm-10 @if($field['type'] == 'checkbox') checkbox @endif ">
            @if($field["type"] == "text")
            {{Form::text($field["name"],  Input::old($field['name'], $data[$field["name"]]), array("class"=>"form-control", "id"=>$field["name"], "placeholder"=>$name))}}
            @elseif($field["type"] == "password")
            {{Form::password($field["name"], array("class"=>"form-control", "id"=>$field["name"], "placeholder"=>$name))}}
            @if(!is_null($id))<span class="text-info">Leave this field empy if you don't want to change the password</span>@endif
            @elseif($field["type"] == "radio")
            @foreach($field["options"] as $option => $value)
            <p>
            {{Form::radio($field["name"], $value,  Input::old($field['name'], $data[$field["name"]] == $value), array("id"=>$field["name"]."_".$value))}}
            {{Form::label($field["name"]."_".$value, $option)}}
            </p>
            @endforeach
            @elseif($field["type"] == "wysiwyg")
            {{Form::textarea($field["name"],  Input::old($field['name'], $data[$field["name"]]), array("class"=>"ckeditor"))}}
            @elseif($field["type"] == "textarea")
            {{Form::textarea($field["name"], Input::old($field['name'], $data[$field["name"]]), array("class"=>"form-control"))}}
            @elseif($field["type"] == "file")
             @if($editing && !empty($data[$field['name']]) )

                <?php
                      $uploader = 'Upload';
                      if( array_key_exists( 'uploader', $field ) ){
                         $uploader = $field['uploader'];
                      }

                      $class = "\\Trapped\\Upload\\".$uploader;
                      $upload = new $class($field['name']);

                      $preview = $original = $upload->getPath().'/'.$data[$field['name']];
                      $thumbnail = $upload->getPath().'/t/'.$data[$field['name']];
                      if( File::exists($thumbnail) ){
                        $preview = $thumbnail;
                      }

                ?>
              <p><strong>Huidige afbeelding: (Klik op de afbeelding om het te bekijken) </string></p>
              <a class="fancybox" href="{{$original}}"><img class="img-responsive img-thumbnail admin-thumbnail" src="{{$preview}}" alt="" /></a>

                <p class="help-block">Als er een nieuw bestand wordt gekozen, wordt de huidige overschreven.</p>
             @endif
                 {{Form::file($field["name"])}}


            @elseif($field["type"] == "date")
            <div class='datepicker' data-date-format="DD-MM-YYYY HH:MM:SS">
                {{Form::text($field["name"],  Input::old($field['name'], \Trapped\Date::input($data[$field["name"]])->forFrontEnd()), array("class"=>"form-control", "id"=>$field["name"], "placeholder"=>$name))}}

            </div>
            @elseif($field['type'] === 'text-with-prepend')
                <div class="input-group">
                  <span class="input-group-addon">{{$field['prepend']}}</span>
                  {{Form::text($field["name"],  Input::old($field['name'], $data[$field["name"]]), array("class"=>"form-control", "id"=>$field["name"], "placeholder"=>$name))}}
                </div>
            @elseif($field['type'] === 'checkbox')
                <?php $checked = (  Input::old($field['name'], $data[ $field['name'] ] ) == 1) ? true : false ?>
               {{ Form::checkbox($field['name'], 1, $checked, ['style'=>'margin-left: -4px;']) }}

            @elseif($editing && $field['type'] == 'json')
                <legend style="padding-top:15px;">{{$name}}</legend>

            @elseif($field['type'] == 'select')
                <select name="{{$field['name']}}" class="form-control">
                    @foreach($field['options'] as $option)
                        <option @if(Input::old($field['name'], $data[$field['name']]) == $option['id']) selected @endif value="{{$option['id']}}">{{$option['title']}}</option>
                    @endforeach
                </select>


            @elseif( $field['type'] === 'color' )
                <p>Na het kiezen van een kleur, moet dit worden bevestigd door op <strong>kiezen</strong> te klikken</p>
                {{Form::text($field["name"],  Input::old($field['name'], $data[$field["name"]]), array("class"=>"color-picker", "id"=>$field["name"], "placeholder"=>$name))}}

            @elseif($field["type"] == "download")
            {{Form::file($field["name"])}}
            @if($editing)
            <p class="text-primary"><i class="fa fa-info-circle"></i> Leave empty if you don't want to replace this</p>
            @endif
            @endif
        </div>
    </div>
@endif