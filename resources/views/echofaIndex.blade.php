@extends('layouts.echofa')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{__('登录')}}</div>

                    <div class="panel-body">
                        <div class="row col-md-8 col-md-offset-2">
                            <a href="{{ route('showUserInfoTable')}}" style="width:100%;">
                                <button  class="btn btn-success" style="width:100%;margin-bottom: 20px;">{{__('用户名单')}}</button>
                            </a>
                            <a href="{{ route('showProjectProcessChart')}}" style="width:100%;">
                                <button  class="btn btn-primary" style="width:100%;margin-bottom: 20px;">{{__('项目进度')}}</button>
                            </a>
                            <a href="{{ route('showProjectCostTable')}}" style="width:100%;">
                                <button  class="btn btn-info" style="width:100%;">{{__('项目开销')}}</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

