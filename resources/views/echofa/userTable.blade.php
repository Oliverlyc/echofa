@extends('layouts.echofaUsersTable')
@section('content')
    <body>
    <div class="container" style="width: 80%;margin-top:4%;">
        <div class="row">
            <div class="col-md-12 user-table-header">
                <p>{{__('用户列表')}}</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered table-striped user-table-body">
                <tr class="user-table-column">
                    <td>序号</td>
                    <td>账号</td>
                    <td>密码</td>
                    <td>用户名</td>
                </tr>
                @foreach($users as $index => $user)
                <tr class="user-table-row">
                    <td>{{__($index+1)}}</td>
                    <td>{{__($user['usercode'])}}</td>
                    <td>{{__($user['password'])}}</td>
                    <td>{{__($user['usercname'])}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    </body>

@endsection
