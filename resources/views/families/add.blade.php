@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Add {{ $title['singular'] }} 
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Family
                </div>

                <div class="panel-body">

                    <!-- Display Validation Errors -->
                    @include('common.errors')
                            
                    <div class="row">
                        <div class="col-sm-8 form-box">
                            
                            <!-- Add Member Form -->
                            <form role="form" action="{{ $urls['save'] }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                {{ Form::hidden('_formaction', 'addFamily') }}
                                <fieldset>
                                    <div class="form-bottom">
                                        <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                                        
                                        <p class="mty-bold required"> Name </p>
                                        <div class="form-group input-group">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                                            <span class="input-group-addon">Family</span>
                                        </div>

                                        <div class="form-group input-group">
                                            <label>Home Phone</label>
                                            <input type="text" name="phone" value="{{ old('name') }}" class="form-control" placeholder="Home Phone">
                                            <p class="help-block">Example: 022-1234567</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Home Address</label>
                                            <input type="text" name="address" value="{{ old('name') }}" class="form-control" placeholder="Home Address">
                                        </div>

                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" value="{{ old('name') }}" class="form-control" placeholder="City">
                                        </div>

                                        <div class="form-group input-group">
                                            <label>Postal Code</label>
                                            <input type="text" name="zipcode" value="{{ old('name') }}" class="form-control" placeholder="Postal Code">
                                        </div>
                                
                                        <!-- <div class="form-group">
                                            <label for="disabledSelect">Country</label>
                                            <input class="form-control" id="disabledInput" type="text" placeholder="Indonesia" disabled>
                                        </div> -->

                                    </div>

                                </fieldset>
                                                               
                                <button type="submit" class="btn">Submit</button>
 
                            </form>
                            <!-- /form -->
                        </div>
                    </div>                            
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
@endsection
