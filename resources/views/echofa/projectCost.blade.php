@extends('layouts.echofa')
@section('content')
    <div class="container-fluid">
        @foreach($projectList as $hid=>$project)
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-info btn-lg">{{ $project['ProjectName'] }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        {{--<div id="table_div"></div>--}}
                        <div id="table{{ $hid }}_div"></div>
                        <?= Lava::render('TableChart', 'CostTable'.$hid, 'table'.$hid.'_div') ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-1"></div>

        </div>
        @endforeach
    </div>


@endsection
