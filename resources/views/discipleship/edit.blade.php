@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12">
            @include('common.pagetop')

            <div class="panel panel-default">
                <div class="panel-heading">
                    General Information
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form role="form" action="{{ $urls['save'] }}" method="POST">
                        <div class="row">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            {{ Form::hidden('_formaction', $dlt_act) }}
                            {{ Form::hidden($dlt_field, $fellowship->id) }}
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input name="name" class="form-control" value="{{ $fellowship->name }}" placeholder="Name">
                                        <p class="help-block">Example: 2015 {{ $title['singular'] }} Batch #3</p>
                                    </div>
                                    <?php $classes = $fellowship->classes; ?>
                                    @foreach($classes as $key => $class)
                                        <div class="row">
                                            <div class="col-lg-8 col-sm-12">
                                                <div class="form-group ">
                                                    <label class="required">Session {{ $key+1 }}: ({{ $class->name }})</label>
                                                    <?php $field = 'session_'.$key; ?>
                                                    <input type="text" class="mydate form-control" name=<?=$field?> value="{{ empty($class->class_date) ? '' : $class->class_date->format('d/m/Y') }}" placeholder="Date">
                                                </div>
                                            </div>                                            
                                        </div>
                                    @endforeach
                                </div>                                                                                               
                            </div>
                            <div class="col-lg-6 col-sm-12 ">
                                @include('discipleship.graduationrule')
                            </div>
                        </div>
                        <div class="center">
                            <button type="submit" class="btn mty-btn mty-update-big">
                                <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                            </button>
                            <a class="btn mty-btn mty-update-big grey" href="{{ $urls['cancel'] }}"> 
                                <i class="fa fa-btn fa-times" aria-hidden="true"></i>{{ trans('messages.cancel') }}
                            </a>
                        </div>       
                    </form>
                </div>                  
            </div>

<!--========================================== Students ==========================================-->
            <div class="panel panel-default">
                <div class="panel-heading">
                   Students
                </div>
                <div class="panel-body">
                    <div class="row">                            
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                             @include('common.attendancetable', ['tableid' => 'itemtable'])
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="center">
                        <a class="btn mty-btn mty-update-big" href="{{ $urls['assign'] }}/{{ $role }}"> 
                            <i class="fa fa-btn fa-plus" aria-hidden="true"></i>Enroll Students
                        </a>         
                        <a class="mty-btn btn purple mty-update-big" href="{{ $urls['attend'] }}/{{ $classes->first()->name }}"> <i class="fa fa-btn fa-calendar-check-o" aria-hidden="true"></i> Mark Attendance</a>               
                    </div>  
                </div>                  
            </div>

<!--========================================== Teachers ==========================================-->
            <div class="panel panel-default">
                <div class="panel-heading">
                   Class Attendance & Teachers
                </div>
                <?php $count = Config::get('constants.TEACHERS_MAX_NUM'); ?>
                <div class="panel-body">     
                    <div class="alert alert-info center">
                            <p><strong>Important Notes</strong></p>             
                            <p>You may select up to {{ $count }} teachers per class.</p>
                        </div>               
                    <div class="row">
                        
                        @foreach($classes as $class)
                            <div class="col-lg-6 col-sm-12 form-box">
                                <div class="dt-media">
                                    <div class="media">
                                        <h4 class="media-heading"><span>teachers</span></h4>
                                        <h3 class="center">{{ $class->name }}</h3>
                                        <p class="center">{{ $class->class_date->format('D, d M Y') }}</p>
                                        <p class="center">({{ count($class->attendance) }} students attended)</p>
                                        
                                        <?php $teachers = $class->teachers; ?>                              
                                        @for($i = 0; $i < $count; $i++)
                                            <div class="col-lg-6 col-sm-12 form-box center">
                                                <a href="{{ $urls['assignteacher'] }}/{{ $class->name }}">
                                                    @if(isset($teachers[$i]))
                                                        @if(!empty($teachers[$i]->image))
                                                          <img class="media-object dt-circle" style="margin:auto;" src="{{ asset($teachers[$i]->image) }}">
                                                        @else
                                                          <i class="fa fa-user dt-profile orn" aria-hidden="true" ></i>
                                                        @endif 
                                                        <!-- <i class="fa fa-user dt-profile orn" aria-hidden="true"></i> -->
                                                    @else
                                                        <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>
                                                    @endif                                            
                                                </a>
                                                <p><b><?php echo (isset($teachers[$i]) ? $teachers[$i]->name . " (teacher)" : 'No Teacher Assigned'); ?></b></p>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="center">
                                        <a class="mty-btn btn" href="{{ $urls['assignteacher'] }}/{{ $class->name }}"> <i class="fa fa-btn fa-bookmark-o" aria-hidden="true"></i> Choose Teachers </a>
                                        <a class="mty-btn btn purple" href="{{ $urls['attend'] }}/{{ $class->name }}"> <i class="fa fa-btn fa-calendar-check-o" aria-hidden="true"></i> Mark Attendance</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>                  
            </div>
        </div>
    </div>
    
@endsection
