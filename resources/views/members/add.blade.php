@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Add Member 
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                                        
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Family
                </div>

                <div class="panel-body">

                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- Add Member Form -->
                    <form role="form" action="{{ $urls['save'] }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_formaction', 'addMember') }}    
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 form-box">                                
                                <div class="form-bottom">
                                    
                                    <div class="form-group ">
                                        <label class="required">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Full Name">
                                    </div>

                                    <div class="form-group">
                                        <label class="required">Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Gender</label>
                                                <?php echo Form::select('gender', array('male' => 'Male', 'female' => 'Female'), "{{ old('gender') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Status</label>
                                                <?php echo Form::select('status', array('single' => 'Single', 'married' => 'Married'), "{{ old('status') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group input-group">
                                                <label>Cell Phone</label>
                                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Cell Phone">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group input-group">
                                                <label>Date of Birth</label>
                                                <input type="text" id="datepicker" name="birthdate" value="{{ old('birthdate') }}" class="form-control" placeholder="Date of Birth">
                                            </div>
                                        </div>
                                    </div>

                                   
                                    
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 form-box">

                                    
                                    
                                   

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder=" Address">
                                    </div>

                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" value="{{ old('city') }}" class="form-control" placeholder="City">
                                    </div>

                                    <div class="form-group input-group">
                                        <label>Postal Code</label>
                                        <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="form-control" placeholder="Postal Code">
                                    </div>

                                    <div class="form-group">
                                        <label>Upload Profile Picture</label>
                                        <?php echo Form::file('photo'); ?>
                                        <p class="help-block">Please upload a picture to be displayed as your profile picture.</p> 
                                    </div>
                            </div>
                        </div> 

                    <div class="center"><button type="submit" class="btn">Submit</button></div>
     
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
