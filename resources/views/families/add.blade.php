@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12">
            <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>                                        
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New {{ $title['singular'] }} 
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form role="form" action="{{ $urls['save'] }}" method="POST">
                        <div class="row">
                            <!-- Add Member Form -->
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            {{ Form::hidden('_formaction', 'addFamily') }}

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">
                                    <div class="form-group">
                                        <label class="required">Family Name</label>
                                        <input name="name" class="form-control" value="{{ old('name') }}" placeholder="Family Name">
                                    </div>
                                    <div class="form-group input-group">
                                        <label>Home Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Home Phone">
                                        <p class="help-block">Example: 022-1234567</p>
                                    </div>
                                </div>                                                                                               
                            </div>
                            <div class="col-lg-6 col-sm-12 ">
                                <div class="form-group">
                                    <label>Home Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Home Address">
                                </div>

                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control" placeholder="City">
                                </div>

                                <div class="form-group input-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="form-control" placeholder="Postal Code">
                                </div>
                            </div>
                        </div>

                        <div class="center">
                            <button type="submit" class="btn mty-btn mty-update-big">
                                <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.submit') }}
                            </button>
                            <a class="btn mty-btn mty-update-big grey" href="{{ $urls['cancel'] }}"> 
                                <i class="fa fa-btn fa-times" aria-hidden="true"></i>{{ trans('messages.cancel') }}
                            </a>
                        </div>      
                    </form>
                </div>                  
            </div>
        </div>
    </div>

    
@endsection
