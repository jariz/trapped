@extends('admin.layout')

@section('content')
<div class="container container-layout">
    <div class="page-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?php $i = 0; ?>
            @foreach($cruds as $crud)
            <?php $i++; ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    {{$crud->plural}}
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <?php $r = 0; ?>
                            @foreach($crud->columns as $column => $attributes)
                            <?php $r++; if($r > 3) continue;?>
                            <th>
                                {{$column}}
                            </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($crud->data) == 0)
                        <tr>
                            <td colspan="{{count($crud->columns)+1}}" class="text-center text-danger">
                                No results found
                            </td>
                        </tr>
                        @endif
                        @foreach($crud->data as $row)
                        <tr>
                            <?php $x=0; ?>
                            @foreach($crud->columns as $column)
                            <?php $x++; if($x > 3) continue; $with = $crud->with; ?>
                            <td>
                                @if(isset($column["boolean"]) && $column["boolean"] === true)
                                @if($row->$column["name"])
                                <span class="label label-success">
                                    Yes
                                </span>
                                @else
                                <span class="label label-danger">
                                    No
                                </span>
                                @endif
                                @else
                                @if( $with != false && array_key_exists( 'property', $column))
                                {{{$row->$with->$column['property']}}}
                                @elseif($column["type"] == "color")
                                <div style="width:20px;height:20px;border:2px solid black; border-radius:3px;background-color: {{$row->$column["name"]}}"></div>
                                @else
                                {{{$row->$column["name"]}}}
                                @endif
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($crud->count > 5)
                    <a class="btn btn-primary btn-block" href="{{URL::route($crud->route)}}">More...</a>
                    @endif
                </div>
            </div>
            @if(round(count($cruds) / 2) == $i)
        </div>
        <div class="col-lg-6">
            @endif
            @endforeach
        </div>
    </div>
</div>
@stop