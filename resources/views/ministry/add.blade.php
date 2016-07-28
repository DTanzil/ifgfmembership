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
                            {{ Form::hidden('_formaction', 'addMinistry') }}

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">
                                    <div class="form-group">
                                        <label class="required">Ministry Name</label>
                                        <input name="name" class="form-control" value="{{ old('name') }}" placeholder="Ministry Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Ministry Description</label>
                                        <input name="description" value="{{ old('description') }}" class="form-control" placeholder="Ministry Description">
                                        <p class="help-block">Example: Instagram Ministry is responsible to manage church Instagram account.</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="required">Head Department</label>
                                        <?php echo Form::select('mtrname', $ministry_list, "{{ old('mtr') }}", array('class' => 'form-control center')); ?>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="alert alert-info" role="alert">
                                        <b>Example:</b><br/>Worship Services Ministry has many subdepartments such as Tech, Hospitality and Production.
                                         If the "Usher" ministry is a subdepartment of Hospitality, "Usher" ministry's Head Department is Hospitality and not Worship Services.                                    </div>
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
