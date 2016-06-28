@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit Member Information : {{ $member->name }}
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    Home > All Families > 
                </li>
            </ol>

        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        
        <div class="col-lg-12 col-sm-12">

            <!-- Display Validation Errors -->
            @include('common.errors')
            <p style="text-align:right;"> Member ID#: AAO393002XXU02 </p>
            
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
                                                        @if(!empty($member->image))
                                                          <img class="media-object dt-profile dt-circle" src="{{ asset($member->image) }}">            
                                                        @else
                                                          <i class="fa fa-user dt-profile" aria-hidden="true"></i>
                                                        @endif   
                                                    <div> 
                                                        <form action="{{ $urls['deletephoto'] }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            {{ Form::hidden('_mbrid', $member->id) }}
                                                            {{ Form::hidden('_formaction', 'deleteMemberPhoto') }}

                                                            <button type="submit" id="deletePhoto" class="btn btn-danger mty-delete {{{ !empty($member->image) ? '' : 'mty-hidden' }}}" style="margin-top:10px; margin-bottom:30px;">
                                                                <i class="fa fa-btn fa-trash"></i>Delete
                                                            </button>
                                                        </form>                                            
                                                    </div>    

                                                    
                                                </div>

                                                

                                            </div>  

                                            <div class="col-lg-8 col-sm-12 form-box">
                                                <div>
                                                    <!-- <label>Upload Profile Picture</label> -->
                                                    <form action="{{ $urls['updatephoto'] }}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        {{ Form::hidden('_mbrid', $member->id) }}
                                                        {{ Form::hidden('_formaction', 'updateMemberPhoto') }}
                                                        <!-- {{ Form::hidden('photo', $member->image) }} -->

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
                                        Barcode 
                                    </div>

                                    <div class="panel-body">

                                        <p class="center"><img src="{{ asset('img/barcode.jpg') }}" style="height:100px;width:auto;"></p>
                                        <p class="center"> Member ID#: AAO393002XXU02 </p>
            
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
                    <form role="form" action="{{ $urls['save'] }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_formaction', 'editMember') }}
                        {{ Form::hidden('_mbrid', $member->id) }}

                       <div class="row">
                            <div class="col-lg-6 col-sm-12 form-box">                                
                                <div class="form-bottom">
                                    
                                    <div class="form-group ">
                                        <label class="required">Full Name</label>
                                        <input type="text" name="name" value="{{ $member->name }}" class="form-control" placeholder="Full Name">
                                    </div>

                                    <div class="form-group">
                                        <label class="required">Email</label>
                                        <input type="text" name="email" value="{{ $member->email }}" class="form-control" placeholder="Email">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="required">Membership Status</label>
                                        <?php $mbrstatus = $member->is_member ? 'member' : 'visitor'; ?>
                                        <?php echo Form::select('mbrstatus', array('member' => 'Member', 'visitor' => 'Visitor'), $mbrstatus, array('class' => 'form-control center')); ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="required">Gender</label>
                                                <?php echo Form::select('gender', array('male' => 'Male', 'female' => 'Female'), $member->gender, array('class' => 'form-control center')); ?>
                                            </div>
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
                                                <label>Cell Phone</label>
                                                <input type="text" name="phone" value="{{ $info['phone'] }}" class="form-control" placeholder="Cell Phone">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group input-group">
                                                <label>Date of Birth</label>
                                                <input type="text" id="datepicker" name="birthdate" value="{{ empty($member->birthdate) ? '' : $member->birthdate->format('d/m/Y') }}" class="form-control" placeholder="Date of Birth">
                                            </div>
                                        </div>
                                    </div>
                                    

                                    

                                    

                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 form-box">

                                    

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
                    <div class="center"><button type="submit" class="btn mty-update center"><i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}</button></div>
                </form>
            </div>
        </div>


        <!-- Member Activities -->
        <div class="row">
            <h2 class="center"> MEMBER ACTIVITIES </h2>
            
            <div>
                @foreach ($groups as $type => $data)
                    
                    @if($type == 'family') 
                        
                        <div class="col-lg-6 col-sm-12 form-box">
                            <div class="dt-media">
                                <div class="media">
                                    
                                    <div class="media-left media-middle center">
                                        <a href="{{ $urls['edit'] }}">
                                            <i class="fa fa-home dt-profile" aria-hidden="true"></i> FAMILY                                         
                                        </a>
                                    </div>
                                    
                                    <div class="media-body">

                                    @foreach ($data as $key => $group)
                                    
                                        <p> {{ $member->name }} is a {{ $group['title'] }} of {{ $group['name'] }} Family </p>
                                        <p><a class="mty-btn btn purple" href="{{ $urls['edit'] }}"> <i class="fa fa-btn fa-undo" aria-hidden="true"></i> {{ trans('messages.change') }}</a></p>

                                    @endforeach

                                    <p>{{ trans('messages.member-assign') }}</p>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>

                                    

                                    <a class="mty-btn btn" href="{{ $urls['edit'] }}/"><i class="fa fa-btn fa-bookmark-o" aria-hidden="true"></i> {{ trans('messages.assign') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        
                    @else 
                        @foreach ($data as $key => $group)
                            <div class="col-lg-6 col-sm-12 form-box">
                            <div class="dt-media">
                                <div class="media">
                                    
                                    <div class="media-left media-middle center">
                                        <a href="{{ $urls['edit'] }}">
                                            <i class="fa fa-users dt-profile" aria-hidden="true"></i> ICARE                                         
                                        </a>
                                    </div>
                                    
                                    <div class="media-body">

                                    @foreach ($data as $key => $group)
                                    
                                        <p> {{ $member->name }} is a {{ $group['title'] }} of {{ $group['name'] }} iCare </p>
                                        <p><a class="mty-btn btn purple" href="{{ $urls['edit'] }}"> <i class="fa fa-btn fa-undo" aria-hidden="true"></i> {{ trans('messages.change') }}</a></p>

                                    @endforeach

                                    <p>{{ trans('messages.member-assign') }}</p>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>

                                    <a class="mty-btn btn" href="{{ $urls['edit'] }}/"><i class="fa fa-btn fa-bookmark-o" aria-hidden="true"></i> {{ trans('messages.assign') }}</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                   
                @endforeach
                
            </div>
                
        
        </div>

<!--         
        <div class="panel panel-default">
            <div class="panel-heading">
               {{ trans('messages.family-member') }}
            </div>

            <div class="panel-body">

                <p> {{ trans('messages.family-welcome') }} </p>
                        
                
                <div class="mty-note">
                    <p> {{ trans('messages.family-add-child') }}  </p>
                    <a class="mty-btn btn" href="{{ $urls['add'] }}"><i class="fa fa-btn fa-plus"></i>Add Child</a>
                </div>
            </div>
        </div>
 -->

        <!-- /.panel -->


    </div>
    <!-- /.col-lg-12 -->
</div>

    
@endsection
