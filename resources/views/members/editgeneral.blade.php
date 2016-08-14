@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            @include('common.pagetop')
            <!-- Display Validation Errors -->
            @include('common.errors') 
                <div class="row">
                    <div class="col-lg-6 col-sm-12">                        
                        <!-- Profile Picture Information -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Profile Picture 
                            </div>       
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12 center">
                                        <div class="form-group">
                                            @if(Storage::disk('img')->exists("{$member->image}"))
                                                <img class="media-object dt-profile dt-circle" style="margin:15px auto;" src="{{ url('ifgf-photos/') }}/{{ $member->image }}"> 
                                            @else
                                                <i class="fa fa-user dt-profile" aria-hidden="true" style="margin:15px auto;" ></i>
                                            @endif
                                            <p class="center">
                                                @if($member->isMember())
                                                    <b style="background-color: blue; color: white; padding: 10px;">MEMBER </b>
                                                @else
                                                    <b style="background-color: red; color: white; padding: 10px;">VISITOR </b>
                                                @endif
                                            </p>
                                            
                                            <div> 
                                                <form action="{{ $urls['deletephoto'] }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    {{ Form::hidden($dlt_field, $member->id) }}
                                                    {{ Form::hidden('_formaction1', 'deleteMemberPhoto') }}
                                                    <button type="submit" id="deletePhoto" class="btn btn-danger mty-delete {{{ !empty($member->image) ? '' : 'mty-hidden' }}}" style="margin-top:10px; margin-bottom:30px;">
                                                        <i class="fa fa-btn fa-trash"></i>Delete Picture
                                                    </button>
                                                </form>                                            
                                            </div>    
                                        </div>
                                    </div>  
                                    <div class="col-lg-8 col-sm-12 form-box">
                                        <div>
                                            <form action="{{ $urls['updatephoto'] }}" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                {{ Form::hidden($dlt_field, $member->id) }}
                                                {{ Form::hidden('_formaction2', 'updateMemberPhoto') }}
                                                <label>Upload Profile Picture</label>
                                                <p class="help-block">Please upload an image of the member for profile picture. <br/>You can change an existing picture by simply uploading a new image. <br/> </p>
                                                <p class="help-block">Accepted image file format: (.jpeg, .bmp, .png)</p>                                                
                                                <?php echo Form::file('photo'); ?>
                                                <p style="margin-top:10px;">
                                                    <button type="submit" class="btn mty-update center"><i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}</button>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <!-- Profile Picture Information -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                QR Code 
                            </div>
                            <div class="panel-body">
                                <p class="center"><i>Scan this QR Code to view all information about this member.</i></p>
                                @if(Storage::disk('img')->exists("{$member->qr_image}"))
                                    <img class="media-object dt-qr" src="{{ url('ifgf-photos/') }}/{{ $member->qr_image }} " />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>                     

            <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
            <!-- General Information -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    General Information 
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ $urls['save'] }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_formaction', 'editMember') }}
                        {{ Form::hidden($dlt_field, $member->id) }}

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 form-box">                                
                                <div class="form-bottom">
                                    <div class="form-group ">
                                        <label class="required">Full Name</label>
                                        <input type="text" name="name" value="{{ $member->name }}" class="form-control" placeholder="Full Name">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Email</label>
                                                <input type="text" name="email" value="{{ $member->email }}" class="form-control" placeholder="Email">
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
                                                <?php echo Form::select('date_joined', $years, $member->date_joined, array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Ibadah</label>
                                                <?php echo Form::select('service', Config::get('constants.IBADAH'), $member->service, array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group {{ $member->service == 'kids' ? '' : 'mty-hidden' }}" id="sundayschool">
                                                <label class="required">Sunday School Class</label>
                                                <?php echo Form::select('kids_class', Config::get('constants.KIDS_CLASSES'), $info['kids_class']  , array('class' => 'form-control center')); ?>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <fieldset disabled>
                                                <div class="form-group">
                                                    <label class="required">Gender</label>
                                                    <?php echo Form::select('gender', array('male' => 'Male', 'female' => 'Female'), $member->gender, array('class' => 'form-control center', 'id' => 'disabledSelect')); ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Status</label>
                                                <?php echo Form::select('status', array('single' => 'Single', 'married' => 'Married'), $member->status, array('class' => 'form-control center mty-cap')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group input-group">
                                                <label>Date of Birth</label>
                                                <input type="text" id="datepicker" name="birthdate" value="{{ empty($member->birthdate) ? '' : $member->birthdate->format('d/m/Y') }}" class="form-control" placeholder="Date of Birth">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group input-group">
                                                <label>Baptism Date</label>
                                                <input type="text" id="datepicker1" name="baptism" value="{{ empty($member->date_baptized) ? '' : $member->date_baptized->format('d/m/Y') }}" class="form-control" placeholder="Baptism Date">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-box">
                                <div class="form-group input-group">
                                    <label>Cell Phone</label>
                                    <input type="text" name="phone" value="{{ $info['phone'] }}" class="form-control" placeholder="Cell Phone">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ $info['address'] }}" class="form-control" placeholder=" Address">
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

            <!-- Member Activities -->
            <div class="row">
                <h2 class="center mty-heading"> MEMBER ACTIVITIES </h2>
                <div>
                    @foreach ($groups as $group)
                        <div class="col-lg-12 col-sm-12 form-box">
                            <div class="dt-media">
                                <div class="media">                                
                                    <?php $icon = Config::get("constants.GROUPS."."$group".".icons"); ?> 
                                    <div class="media-left media-middle center">
                                        <span class="dt-icon">
                                            <i class="fa fa-<?=$icon?> dt-profile" aria-hidden="true"></i> 
                                        </span>
                                    </div>
                                    
                                    <div class="media-body">
                                        <h3 class="dt-act-group">{{ $group }}</h3>
                                        @if(count($member->$group) == 0)
                                            <p> {{ $member->name }} is not associated with any {{ $group }}. </p>                                    
                                            <a class="mty-btn btn green" href="{{ $urls['allgroup'][$group] }}"> {{ trans('messages.view') }} All <span class="cap">{{ $group }}</span></a>                                                    
                                        @else
                                            @foreach($member->$group as $role)                                
                                                <form action="{{ $urls['delete'][$group] }}/{{ $role->id }}" method="POST">
                                                    <p class="dt-act"> 
                                                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                                        <span id="dt-act-info">{{ $member->name }} is a {{ $role->pivot->title }} of {{ $role->name }} {{ $group }}</span>
                                                        <a class="mty-btn btn green" href="{{ $urls['viewgroup'][$group] }}/{{ $role->id }}"> <i class="fa fa-btn fa-info" aria-hidden="true"></i> {{ trans('messages.view') }} {{ $group }}</a>
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        {{ Form::hidden('_formaction', 'deleteMember') }}
                                                        {{ Form::hidden($dlt_field, $member->id) }}
                                                        <button type="submit" class="btn btn-danger mty-delete">
                                                            <i class="fa fa-btn fa-trash"></i>Remove Activity
                                                        </button>
                                                    </p>
                                                </form>
                                            @endforeach
                                        @endif
                                   </div>
                                </div>
                            </div>
                        </div>
                    @endforeach                
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

