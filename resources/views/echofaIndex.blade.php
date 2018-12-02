@extends('layouts.echofa')

@section('content')
    <head>
        <style>
            .panel{
                /*opacity:0.0;*/
            }
        </style>
    </head>
    <div class="container">
        <div class="row index-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <img src="../img/logo.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-index" style="text-align: center;">
                        <p id="p1">功能</p>
                        <p id="p2">{{__('FUNCTION')}}</p>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12 div-btn-index" style="text-align: center;">
                        <a href="{{ route('showUserInfoTable')}}" style="width:100%;">
                            <button  class="btn btn-index" style="margin-bottom: 20px;">{{__('用户名单')}}</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 div-btn-index" style="text-align: center;">
                        <a href="{{ route('showProjectProcessChart')}}" style="width:100%;">
                            <button  class="btn btn-index" style="margin-bottom: 20px;">{{__('项目进度')}}</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 div-btn-index" style="text-align: center;">
                        <a href="{{ route('showProjectCostTable')}}" style="width:100%;">
                            <button  class="btn btn-index" style="">{{__('项目开销')}}</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

