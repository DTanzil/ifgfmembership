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
                            {{ Form::hidden('_formaction', 'addIcare') }}

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">
                                    <div class="form-group">
                                        <label class="required">iCare Name</label>
                                        <input name="name" class="form-control" value="{{ old('name') }}" placeholder="iCare Name">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">iCare Meeting Day</label>
                                                <?php echo Form::select('day', Config::get('constants.DAYS'), "{{ old('day') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">iCare Meeting Time</label>
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
                                        <label class="required">iCare Email</label>
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
