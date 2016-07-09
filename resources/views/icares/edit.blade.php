@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required</i></p>
                         
        <!-- General Information -->
        <div class="panel panel-default">
            <div class="panel-heading">
                General Information 
            </div>

            <div class="panel-body">
                <form role="form" action="{{ $urls['save'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    {{ Form::hidden('_formaction', 'editIcare') }}
                    {{ Form::hidden($dlt_field, $fellowship->id) }}

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-bottom">
                                <div class="form-group">
                                    <label class="required">iCare Name</label>
                                    <input name="name" class="form-control" value="{{ $fellowship->name }}" placeholder="iCare Name">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="required">iCare Meeting Day</label>
                                            <?php echo Form::select('day', Config::get('constants.DAYS'), $fellowship->day, array('class' => 'form-control center')); ?>
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
                                            <?php echo Form::select('time', $time, $fellowship->time, array('class' => 'form-control center')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="required">iCare Email</label>
                                    <input type="text" name="email" value="{{ $fellowship->email }}" class="form-control" placeholder="iCare Email">
                                </div>
                                <div class="form-group input-group">
                                    <label>iCare Contact Phone</label>
                                    <input type="text" name="phone" value="{{ $info['phone'] }}" class="form-control" placeholder="Home Phone">
                                    <p class="help-block">Example: 022-1234567</p>
                                </div>
                            </div>                                                                                               
                        </div>

                        <div class="col-lg-6 col-sm-12 ">
                            <div class="form-group">
                                <label class="required">iCare Address</label>
                                <input type="text" name="address" value="{{ $info['address'] }}" class="form-control" placeholder="Home Address">
                            </div>
                            <div class="form-group">
                                <label class="required">iCare City</label>
                                <input type="text" name="city" value="{{ $info['city'] }}" class="form-control" placeholder="City">
                            </div>
                            <div class="form-group input-group">
                                <label class="required">iCare Postal Code</label>
                                <input type="text" name="zipcode" value="{{ $info['zipcode'] }}" class="form-control" placeholder="Postal Code">
                            </div>
                        </div>
                    </div>
                <div class="center">
                    <button type="submit" class="btn mty-update-big center">
                        <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- List of Members -->
    @include('common.memberlist')
    </div>
</div>

@endsection
