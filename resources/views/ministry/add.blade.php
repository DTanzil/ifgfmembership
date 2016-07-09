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
                            {{ Form::hidden('_formaction', 'addIcare') }}

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">

                                    <div class="form-group">
                                        <label class="required">Ministry Name</label>
                                        <input name="name" class="form-control" value="{{ old('name') }}" placeholder="iCare Name">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Ministry Meeting Day</label>
                                                <?php echo Form::select('day', array('Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', 'Sunday' => 'Sunday'), "{{ old('day') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Ministry Meeting Time</label>
                                                <?php 
                                                $time = array();
                                                $increment = 30;
                                                for ($i=0; $i <= 1440 ; $i+=$increment) { 
                                                    $hours = intval($i/60) < 10 ? "0".intval($i/60) : intval($i/60);
                                                    $minutes = $i%60 == 0 ? '00' : $i%60;
                                                    $time[$i] = "$hours:$minutes";
                                                } 
                                                ?>
                                                <?php echo Form::select('time', $time, "{{ old('time') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="required">Ministry Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="iCare Email">
                                    </div>

                                    <div class="form-group input-group">
                                        <label>iCare Contact Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="iCare Contact Phone">
                                        <p class="help-block">Example: 0812345678</p>
                                    </div>

                                     
                                </div>                                                                                               
                            </div>

                            <div class="col-lg-6 col-sm-12 ">
                                <div class="form-group">
                                    <label class="required">iCare Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="iCare Address">
                                </div>

                                <div class="form-group">
                                    <label class="required">iCare City</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control" placeholder="iCare City">
                                </div>

                                <div class="form-group input-group">
                                    <label class="required">iCare Postal Code</label>
                                    <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="form-control" placeholder="iCare Postal Code">
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
