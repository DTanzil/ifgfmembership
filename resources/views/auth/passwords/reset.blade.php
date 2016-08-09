@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="login-page">
            <div class="myform">
                <h4 class="mty-heading">Reset Password</h4>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="login-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password" placeholder="new password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-refresh"></i>Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
