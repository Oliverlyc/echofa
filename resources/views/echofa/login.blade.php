@extends('layouts.echofa')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 " style="text-align: center">
                <img src="../img/logo_1.png" style="width: 600px;height: 180px;" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{__('登录')}}
                        <img src="" alt="">
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('usercode') ? ' has-error' : '' }}">
                                <label for="usercode" class="col-md-4 control-label">{{__('账号')}}</label>

                                <div class="col-md-6">
                                    <input id="usercode" type="usercode" class="form-control" name="usercode" value="{{ old('usercode') }}" required autofocus>

                                    @if ($errors->has('usercode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('usercode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">{{__('密码')}}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="width: 100%">
                                        {{__('登录')}}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
