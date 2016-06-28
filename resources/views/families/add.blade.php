@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Add New {{ $title['singular'] }} 
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                                        
            <div class="panel panel-default">
                <div class="panel-heading">
                    General Information
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

                        <div class="center"><button type="submit" class="btn mty-update center"><i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.submit') }}</button></div>       
                    </form>
                    <!-- /form -->
                </div>                  
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
@endsection
