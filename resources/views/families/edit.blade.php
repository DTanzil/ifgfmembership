@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">
        
        @include('common.pagetop')

        <!-- General Information -->
        <div class="panel panel-default">
            <div class="panel-heading">
                General Information 
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <form role="form" action="{{ $urls['save'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    {{ Form::hidden('_formaction', 'editFamily') }}
                    {{ Form::hidden($dlt_field, $fellowship->id) }}

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
                <div class="center">
                    <button type="submit" class="btn mty-btn mty-update-big center">
                        <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                    </button>
                    <a class="btn mty-btn mty-update-big grey" href="{{ $urls['cancel'] }}"> 
                        <i class="fa fa-btn fa-times" aria-hidden="true"></i>{{ trans('messages.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
           List of Members
        </div>
        <div class="panel-body">
            <div class="row">                            
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <!-- List of Members -->
                    @include('common.viewtable')
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="center">
                <a class="btn mty-btn mty-update-big" href="{{ $urls['assign'] }}/{{ $default_role }}"> 
                    <i class="fa fa-btn fa-undo" aria-hidden="true"></i>Add/Edit <span class="cap">{{ $default_role }}</span>
                </a>         
            </div>  
        </div>                  
    </div>

    
    <!-- List of Members -->
    @include('common.memberlist')

    </div>
</div>

@endsection
