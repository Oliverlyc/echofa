@extends('layouts.echofa')
@section('content')
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">{{__('用户列表')}}</div>

                    <div class="panel-body">
                        {{--<div id="table_div"></div>--}}
                        <div id="table_div"></div>
                        <?= Lava::render('TableChart', 'Table', 'table_div') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>

@endsection
