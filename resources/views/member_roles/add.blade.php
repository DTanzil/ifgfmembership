@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- Display Member Roles Important Notes -->
        @include('member_roles.notes')

        <div class="row">
            <div class="col-lg-12">
                <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add New Role
                    </div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                        <form role="form" action="{{ $urls['save'] }}" method="POST">
                            <div class="row">
                                <!-- Add Member Role Form -->
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                {{ Form::hidden('_formaction', 'addMbrRole') }}

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-bottom">
                                        <div class="form-group">
                                            <label class="required">Role Name</label>
                                            <input name="name" class="form-control" value="{{ old('name') }}" placeholder="Role Name">
                                            <p class="help-block">Name should be concise and short. Example: "Teacher", "Core Teams", "Facilitator"</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="required">Group:</label>
                                                    <?php echo Form::select('group', Config::get('constants.GROUPS'), "{{ old('group') }}", array('class' => 'form-control center')); ?>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="required">Rank</label>
                                                    <?php echo Form::select('rank', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'), "{{ old('rank') }}", array('class' => 'form-control center')); ?>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="required">Limit</label>
                                                    <?php echo Form::select('limit', array('0' =>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'), "{{ old('limit') }}", array('class' => 'form-control center')); ?>
                                                    <p class="help-block">Note: 0 means there is no limit to how many members can have this role in its group</p>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                                                                                               
                                </div>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn mty-update center">
                                    <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.submit') }}
                                </button>
                            </div>       
                        </form>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
