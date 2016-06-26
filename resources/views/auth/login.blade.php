@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Sign in</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a class="btn btn-lg btn-primary" href="/auth/facebook">
                                    <i class="fa fa-facebook-square fa-3x pull-left"></i>Login using<br/> Facebook</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <a class="btn btn-lg btn-primary" href="/auth/twitter">
                                    <i class="fa fa-twitter-square fa-3x pull-left"></i>Login using <br/>Twitter</a>
                            </div>

                        </div>
                        <hr class="hr-text" data-content="OR">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i> Login
                                        </button>

                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your
                                            Password?</a>
                                    </div>
                                </div>
                        </form>

                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-10">
                                <a href="/register">Want to sign up? Click here!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
