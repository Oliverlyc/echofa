@extends('layouts.echofa')
@section('content')

    <div class="container-fluid">
        @foreach($projectList as $hid => $project)
        <div class="row ">
            <div class="col-xs-12">
                <div class="panel panel-default panel-success">
                    <div class="panel-heading ">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-default btn-info btn-lg" href="/echofa/project_cost/{{ $hid }}" role="botton">{{ $project['ProjectName'] }}</a>
                            </div>

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-danger btn-lg" disabled>
                                    {{__('截止日期：')}}{{ $project['EndDatetime'] }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($project['process'])
                        <div id="gantt{{ $hid }}_div" >
                            <?= Lava::render('GanttChart', 'Gantt'.$hid, 'gantt'.$hid.'_div') ?>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

@endsection
