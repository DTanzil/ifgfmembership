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
        
        <div class="col-lg-12">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <p style="text-align:right;"> Member ID#: AAO393002XXU02 </p>
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
                                        <label class="required">Gender</label>
                                        <?php echo Form::select('gender', array('male' => 'Male', 'female' => 'Female'), $member->gender, array('class' => 'form-control center')); ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="required">Status</label>
                                        <?php echo Form::select('status', array('single' => 'Single', 'married' => 'Married'), $member->status, array('class' => 'form-control center mty-cap')); ?>
                                    </div>

                                     <div class="form-group input-group">
                                        <label class="required">Cell Phone</label>
                                        <input type="text" name="phone" value="{{ $info['phone'] }}" class="form-control" placeholder="Cell Phone">
                                        <!-- <p class="help-block">Example: 08112345678</p> -->
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

                                    <div class="form-group input-group">
                                        <label>Date of Birth</label>
                                        <input type="text" id="datepicker" name="birthdate" value="{{ $member->birthdate->toDateString() }}" class="form-control" placeholder="Date of Birth">
                                    </div>


                                    <div class="form-group {{{ empty($member->image) ? '' : 'mty-hidden' }}}">
                                        <label>Upload Profile Picture</label>

                                        <?php echo Form::file('photo'); ?>
                                        <p class="help-block">Please upload an image of the member for profile picture. Accepted image file format: (.jpeg, .png)</p>
                                    </div>

                                    <div class="form-group {{{ !empty($member->image) ? '' : 'mty-hidden' }}}">
                                        <p class="mty-bold"> Profile Picture</p>
                                        <a href="{{ $urls['edit'] }}">
                                          <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px; display:inline-block;">
                                        </a>

                                        <span class="mty-btn btn purple" id="changePhoto"> <i class="fa fa-btn fa-camera" aria-hidden="true"></i> {{ trans('messages.change') }}</span>

                                        <div>
                                            <form action="{{ $urls['deletephoto'] }}" method="POST">
                                                <!-- {{ csrf_field() }} -->
                                                {{ method_field('DELETE') }}
                                                {{ Form::hidden('_mbrid', $member->id) }}
                                                {{ Form::hidden('_formaction', 'deleteMemberPhoto') }}
                                               
                                                <button type="submit" id="deletePhoto" class="btn btn-danger mty-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </div>                                        
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

        
        <div class="panel panel-default">
            <div class="panel-heading">
               {{ trans('messages.family-member') }}
            </div>

            <div class="panel-body">

                <p> {{ trans('messages.family-welcome') }} </p>
                        
                
                <!-- /.row (nested) -->                   
                <div class="mty-note">
                    <p> {{ trans('messages.family-add-child') }}  </p>
                    <a class="mty-btn btn" href="{{ $urls['add'] }}"><i class="fa fa-btn fa-plus"></i>Add Child</a>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->


    </div>
    <!-- /.col-lg-12 -->
</div>

    
@endsection
