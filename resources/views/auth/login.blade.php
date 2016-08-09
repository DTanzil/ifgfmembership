@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="login-page">
            <div class="myform">
                <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" placeholder="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" name="password" placeholder="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>

<!-- 
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
 -->

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Login
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}" style="margin-top:20px;">Forgot Your Password?</a>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection
