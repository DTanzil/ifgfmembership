@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">        
        @include('common.pagetop')
                         
        <!-- General Information -->
        <div class="panel panel-default">
            <div class="panel-heading">
                General Information 
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <form role="form" action="{{ $urls['save'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    {{ Form::hidden('_formaction', 'editMinistry') }}
                    {{ Form::hidden($dlt_field, $fellowship->id) }}

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-bottom">
                                <div class="form-group">
                                    <label class="required">Ministry Name</label>
                                    <input name="name" class="form-control" value="{{ $fellowship->name }}" placeholder="Ministry Name">
                                </div>
                                <div class="form-group">
                                    <label>Ministry Description</label>
                                    <input name="description" value="{{ $fellowship->description }}" class="form-control" placeholder="Ministry Description">
                                    <p class="help-block">Example: Instagram Ministry is responsible to manage church Instagram account.</p>
                                </div>

                                <div class="form-group">
                                    <label class="required">Head Department</label>
                                    <?php echo Form::select('mtrname', $ministry_list, $parent_name, array('class' => 'form-control center')); ?>
                                    <p class="help-block"></p>
                                </div>

                                <div class="alert alert-info" role="alert">
                                    <b>Example:</b><br/>Worship Services Ministry has many subdepartments such as Tech, Hospitality and Production.
                                     If the "Usher" ministry is a subdepartment of Hospitality, "Usher" ministry's Head Department is Hospitality and not Worship Services.                                    </div>
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

    <!--========================================== Table list of Members ==========================================-->
    <div class="panel panel-default">
        <div class="panel-heading">
           List of Members
        </div>
        <div class="panel-body">
            <div class="row">                            
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <!-- List of Members -->
                    @include('common.viewtable')
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="center">
                <a class="btn mty-btn mty-update-big" href="{{ $urls['assign'] }}/{{ $default_role }}"> 
                    <i class="fa fa-btn fa-undo" aria-hidden="true"></i>Add/Edit <span class="cap">{{ $default_role }}</span>
                </a>         
            </div>  
        </div>                  
    </div>

<!--========================================== Detailed List of Members ==========================================-->

    <!-- List of Members -->
    @include('common.memberlist')
    </div>
</div>

@endsection
