@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                         
        <!-- General Information -->
        <div class="panel panel-default">
            <div class="panel-heading">
                General Information 
            </div>

            <div class="panel-body">
                <form role="form" action="{{ $urls['save'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    {{ Form::hidden('_formaction', 'editFamily') }}
                    {{ Form::hidden('_fmid', $fellowship->id) }}

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-bottom">
                                <div class="form-group">
                                    <label class="required">Family Name</label>
                                    <input name="name" class="form-control" value="{{ $fellowship->name }}" placeholder="Family Name">
                                </div>
                                <div class="form-group input-group">
                                    <label>Home Phone</label>
                                    <input type="text" name="phone" value="{{ $info['phone'] }}" class="form-control" placeholder="Home Phone">
                                    <p class="help-block">Example: 022-1234567</p>
                                </div>
                            </div>                                                                                               
                        </div>

                        <div class="col-lg-6 col-sm-12 ">
                            <div class="form-group">
                                <label>Home Address</label>
                                <input type="text" name="address" value="{{ $info['address'] }}" class="form-control" placeholder="Home Address">
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{ $info['city'] }}" class="form-control" placeholder="City">
                            </div>
                            <div class="form-group input-group">
                                <label>Postal Code</label>
                                <input type="text" name="zipcode" value="{{ $info['zipcode'] }}" class="form-control" placeholder="Postal Code">
                            </div>
                        </div>
                    </div>
                <div class="center"><button type="submit" class="btn mty-update center"><i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}</button></div>
            </form>
        </div>
    </div>

    <!-- List of Members -->
    @include('common.memberlist')

    </div>
</div>

@endsection
