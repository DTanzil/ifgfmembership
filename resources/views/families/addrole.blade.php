@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $item->name }} {{ $title['singular'] }} -> Add {{ $title['singular'] }} Member
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New {{ $title['singular'] }} Member
                </div>

                <div class="panel-body">
                    <form action="{{ $urls['save'] }}" method="POST" class="mbr-save-form">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                            
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 col-sm-12 form-box">                            
                            <!-- Add Member Form -->
                            <fieldset class="center">
                                
                                <div class="form-bottom">
                                    
                                    <p> Adding a new member for: </p>
                                    <div class="form-group input-group" style="margin:auto;" >
                                        <input class="form-control center" value="{{ $item->name }} Family" id="disabledInput" type="text" placeholder="Nama Keluarga" disabled="">
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label>Select Role:</label>
                                        <?php echo Form::select('_mbrole', $validRoles, $defaultrole, array('class' => 'form-control center cap')); ?>
                                    </div>

                                    <p><b>Would you like to proceed?</b></p>
                                    <p><i>{{ trans('messages.back-prev-page') }}</i></p> 
                                    <p> 
                                        <a id="next-step" class="mty-btn btn" >Next</a>
                                        <a href=" {{ $urls['edit'] }} " class="mty-btn red btn btn-next">Cancel</a>
                                    </p>
                                </div>

                            </fieldset>
                        </div>
                         <div class="col-lg-4"></div>
                    </div>        


                    <div class="row">
                        <div class="col-lg-12">

                            <div class="searchmembertable" style="display:none;">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8">
                                    <!-- Search Member Table -->
                                    @include('common.searchtable')

                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    {{ Form::hidden($dlt_field, $item->id) }}
                                    {{ Form::hidden('_mbrid', '') }}
                                    {{ Form::hidden('_fmaction', 'add') }}
                                    {{ Form::hidden('_formaction', 'editRole') }}
                                   
                                    <div class="center">
                                        <button type="submit" class="btn mty-btn mty-update-big">
                                            <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                                        </button>
                                    </div>                                    
                                </div>
                                <div class="col-lg-2"></div>
                            </div>

                        </div>
                    </div>  
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

@endsection
