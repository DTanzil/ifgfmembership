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
                                        <label>Gender</label>
                                        <div class="radio">
                                            <label>
                                                <?php echo Form::radio('gender', 'male', true); ?> Male
                                                <!-- <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Male -->
                                            </label>

                                        </div>
                                        <div class="radio">
                                            <label>
                                                <?php echo Form::radio('gender', 'female', true); ?> Female
                                                <!-- <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Female -->
                                            </label>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                                <?php echo Form::radio('status', 'single', true); ?> Single
                                                <!-- <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" checked>Single -->
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <?php echo Form::radio('status', 'married', true); ?> Married
                                                <!-- <input type="radio" name="optionsRadios" id="optionsRadios4" value="option4">Married -->
                                            </label>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Upload Profile Picture</label>
                                        <?php echo Form::file('image'); ?>
                                        <p class="help-block">Please upload a picture to be displayed as your profile picture.</p> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 form-box">

                                <div class="form-group input-group">
                                        <label>Cell Phone</label>
                                        <input type="text" name="phone" value="{{ old('name') }}" class="form-control" placeholder="Cell Phone">
                                        <!-- <p class="help-block">Example: 08112345678</p> -->
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ old('name') }}" class="form-control" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ old('name') }}" class="form-control" placeholder=" Address">
                                    </div>

                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" value="{{ old('name') }}" class="form-control" placeholder="City">
                                    </div>

                                    <div class="form-group input-group">
                                        <label>Postal Code</label>
                                        <input type="text" name="zipcode" value="{{ old('name') }}" class="form-control" placeholder="Postal Code">
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
