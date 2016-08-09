@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="login-page">
            <div class="myform">
                <h4 class="mty-heading">Forgot Password</h4>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="login-form form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="your email address">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
