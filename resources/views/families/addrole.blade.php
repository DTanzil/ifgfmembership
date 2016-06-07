@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $family->name }} Family -> Add {{ $title['singular'] }} Member
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Family Member
                </div>

                <div class="panel-body">
                    <form action="{{ $urls['save'] }}" method="POST" class="mbr-save-form">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                            
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 col-sm-12 form-box">
                            
                            <!-- Add Member Form -->
                            <!-- <form role="form" action="{{ $urls['save'] }}" method="POST"> -->
                                <!-- {{ csrf_field() }}
                                {{ method_field('POST') }}
                                {{ Form::hidden('_formaction', 'addFamily') }} -->
                                <fieldset class="center">
                                    <div class="form-top">
                                        <div class="form-top-left">
                                            <!-- <h1> Informasi Keluarga </h1>  -->
                                        </div>
                                        
                                    </div>
                                    <div class="form-bottom">
                                        
                                        <p> Adding a new member for: </p>
                                        <div class="form-group input-group" style="margin:auto;" >

                                            <!-- <span class="input-group-addon">Keluarga</span> -->
                                            <input class="form-control center" value="{{ $family->name }} Family" id="disabledInput" type="text" placeholder="Nama Keluarga" disabled="">

                                            <!-- <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nama Keluarga"> -->
                                        </div>

                                        <div class="form-group">
                                            <label>Select Role:</label>
                                            <?php echo Form::select('_mbrole', $validRoles, $defaultrole, array('class' => 'form-control center')); ?>
                                        </div>

                                        <p style="font-style:italic;">{{ trans('messages.back-prev-page') }}</p> 
                                        <p> 
                                            <a id="next-step" class="mty-btn btn" >Next</a>
                                            <a href=" {{ $urls['edit'] }} " class="mty-btn red btn btn-next">Cancel</a>
                                        </p>
                                    </div>

                                </fieldset>
                                
                               
                                <!-- <button type="button" class="btn btn-previous">Previous</button> -->
                                <!-- <button type="submit" class="btn">Submit</button> -->
 
                            <!-- </form> -->
                            <!-- /form -->
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
                                        {{ Form::hidden('_fmid', $family->id) }}
                                        {{ Form::hidden('_mbrid', '') }}
                                        {{ Form::hidden('_fmaction', 'add') }}
                                        {{ Form::hidden('_formaction', 'editRole') }}
                                        <!-- <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>{{ trans('messages.update') }}
                                        </button>
 -->    
                                        <button type="submit" class="btn mty-btn mty-update center">
                                            <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                                        </button>
                                    
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
