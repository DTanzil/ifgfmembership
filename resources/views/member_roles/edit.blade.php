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
                        Edit Role
                    </div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                        <form role="form" action="{{ $urls['save'] }}" method="POST">
                            <div class="row">
                                <!-- Add Member Role Form -->
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                {{ Form::hidden('_formaction', 'editMbrRole') }}
                                {{ Form::hidden($dlt_field, $fellowship->id) }}

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-bottom">
                                        
                                        <div class="form-group">
                                            <label class="required">Role Name</label>
                                            <input name="name" class="form-control" value="{{ $fellowship->name }}" placeholder="Role Name">
                                            <p class="help-block">Name should be concise and short. Example: "Teacher", "Core Teams", "Facilitator"</p>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="required">Group:</label>
                                                    <?php //$list = Config::get('constants.GROUPS_MODELS'); ?>
                                                    <?php $groups = array_keys(Config::get('constants.GROUPS')); 
                                                        $aa = array_values(Config::get('constants.GROUPS'));
                                                        $bb = array_search('App/Family', $aa);
                                                        var_dump($bb);
                                                        die();

                                                    ?>
                                                    <?php echo Form::select('group', array_combine($groups,$groups), array_search($fellowship->type, $list), array('class' => 'form-control center cap')); ?>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="required">Rank</label>
                                                    <?php echo Form::select('rank', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'), $fellowship->priority, array('class' => 'form-control center')); ?>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="required">Limit</label>
                                                    <?php echo Form::select('limit', array('0' =>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5', '6' => '6'), $fellowship->maxlimit, array('class' => 'form-control center')); ?>
                                                    <p class="help-block">Note: 0 means there is no limit to how many members can have this role in its group</p>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>                                                                                               
                                </div>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn mty-update center">
                                    <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
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
