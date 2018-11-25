@inject('request','Illuminate\Http\Request')
@extends('layouts.echofa')
@section('ganttBtn')
    <a href="{{ route('showProjectCostTable') }}" type="button " @if(!$request->query('type')||$request->query('type') == 'processing') class="btn btn-default btn-lg btn-primary" @else class="btn btn-default btn-lg active" @endif style="width: 200px;margin: 0 60px 0 150px;">{{__('进行中')}}</a>
    <a href="{{ route('showProjectCostTable').'?type=finish' }}" type="button" @if($request->query('type') == 'finish') class="btn btn-default btn-lg btn-primary" @else class="btn btn-default btn-lg active" @endif style="width: 200px;">{{__('已结束')}}</a>
    {{--<a href="{{ route('getProcessCostList') }}" >--}}
        {{--<button type="button" class="btn btn-info">{{__('下载表格')}}</button>--}}
    {{--</a>--}}
@endsection
@section('content')
    <div class="container-fluid">
            {{--@foreach($projectList as $hid => $project)--}}
                {{--@if(($loop->index ) % 3 == 0)--}}
                    {{--<div class="row">--}}
                {{--@endif--}}
                {{--<div class="col-md-4" >--}}
                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading text-center" id="table_heading_{{__($hid)}}" role="tab">--}}
                            {{--<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#table_{{__($hid)}}" aria-expanded="false" aria-controls="table_{{__($hid)}}">--}}
                                {{--{{__($project['ProjectName'])}}--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<div id="table_{{__($hid)}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="table_heading_{{__($hid)}}">--}}
                            {{--<div class="panel-body">--}}
                                {{--<table class="table table-bordered">--}}
                                    {{--<tr class="text-center">--}}
                                        {{--<td>{{__('工序')}}</td>--}}
                                        {{--<td>{{__('费用')}}</td>--}}
                                    {{--</tr>--}}
                                    {{--@foreach($project['process'] as $sort => $process)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{__($process['flowname'])}}</td>--}}
                                        {{--<td>{{__($process['cost'])}}</td>--}}
                                    {{--</tr>--}}
                                    {{--@endforeach--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@if((($loop->index + 1) % 3 == 0) || $loop->last)--}}
                {{--</div>--}}
            {{--@endif--}}
            {{--@endforeach--}}
                <div class="row">

                @foreach($projectList as $hid => $project)
                @if($loop->count != 1)
                <div class="col-md-4" >
                    <div class="panel panel-default">
                        <div class="panel-heading text-center" id="table_heading_{{__($hid)}}" role="tab">
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#table_{{__($hid)}}" aria-expanded="false" aria-controls="table_{{__($hid)}}">
                                {{__($project['ProjectName'])}}
                            </button>
                        </div>
                        <div id="table_{{__($hid)}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="table_heading_{{__($hid)}}">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <td>{{__('工序')}}</td>
                                        <td>{{__('费用')}}</td>
                                    </tr>
                                    @foreach($project['process'] as $sort => $process)
                                    <tr class="text-center">
                                        <td>{{__($process['flowname'])}}</td>
                                        <td>{{__($process['cost'])}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12" >
                    <div class="panel panel-default">
                        <div class="panel-heading text-center" id="table_heading_{{__($hid)}}" role="tab">
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#table_{{__($hid)}}" aria-expanded="false" aria-controls="table_{{__($hid)}}">
                                {{__($project['ProjectName'])}}
                            </button>
                        </div>
                        <div id="table_{{__($hid)}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="table_heading_{{__($hid)}}">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <td>{{__('工序')}}</td>
                                        <td>{{__('费用')}}</td>
                                    </tr>
                                    @foreach($project['process'] as $sort => $process)
                                    <tr class="text-center">
                                        <td>{{__($process['flowname'])}}</td>
                                        <td>{{__($process['cost'])}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            </div>
                        </div>
                </div>
                @endif
            @endforeach
                </div>

        {{--<div class="col-md-4" >--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading text-center" id="table_heading_2" role="tab">--}}
                        {{--<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#table_2" aria-expanded="false" aria-controls="table_2">--}}
                            {{--{{__('Pear')}}--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div id="table_2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="table_heading_2">--}}
                        {{--<div class="panel-body">--}}
                            {{--123456--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4" >--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading text-center" id="table_heading_3" role="tab">--}}
                        {{--<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#table_3" aria-expanded="false" aria-controls="table_3">--}}
                            {{--{{__('Orange')}}--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div id="table_3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="table_heading_3">--}}
                        {{--<div class="panel-body">--}}
                            {{--123456--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4" >--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">{{__('123')}}</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>


@endsection
