@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12">
            <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                                        
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Member
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- Add Member Form -->
                    <form role="form" action="{{ $urls['save'] }}" method="POST" enctype='multipart/form-data'>
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
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Email</label>
                                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Attended IFGF Bandung Since:</label>
                                                <?php 
                                                    $years = array();
                                                    for($i = Config::get('constants.JOIN_START') ; $i<= Config::get('constants.JOIN_END'); $i++) {
                                                        $years[$i] = $i;
                                                    }
                                                ?>
                                                <?php echo Form::select('date_joined', $years, "{{ old('date_joined') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Ibadah</label>
                                                <?php echo Form::select('service', Config::get('constants.IBADAH'), "{{ old('service') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group {{ old('service') == 'kids' ? '' : 'mty-hidden' }}" id="sundayschool">
                                                <label class="required">Sunday School Class</label>
                                                <?php echo Form::select('kids_class', Config::get('constants.KIDS_CLASSES'), "{{ old('kids_class') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Gender</label>
                                                <?php echo Form::select('gender', Config::get('constants.GENDER'), "{{ old('gender') }}", array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Status</label>
                                                <?php echo Form::select('status', Config::get('constants.MARITAL_STATUS'), "{{ old('status') }}", array('class' => 'form-control center')); ?>
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

@section('myscript')
    <script>
        jQuery(document).ready(function(){
            // make sunday school classes dropdown to appear if kids service is chosen
            $('select[name="service"]').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                if(this.value == 'kids') {
                    $("#sundayschool").fadeIn('slow').removeClass("mty-hidden");
                } else {
                    $("#sundayschool").fadeOut('slow');
                }
            });
        });
    </script>
@endsection
