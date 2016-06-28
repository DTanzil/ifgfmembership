@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $item->name }} {{ $title['singular'] }} -> Add {{ $title['singular'] }} Members
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New {{ $title['singular'] }} XXXXXX
                </div>

                <div class="panel-body">
                    <form action="{{ $urls['save'] }}" method="POST" class="mbr-save-mul-form">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                                
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 col-sm-12 form-box">                            
                                <!-- Add Member Form -->
                                <fieldset class="center">                                
                                    <div class="form-bottom">
                                        <p> Assigning new members for: </p>
                                        <div class="form-group input-group" style="margin:auto;" >
                                            <input class="form-control center" value="{{ $item->name }} {{ $title['singular'] }}" id="disabledInput" type="text" disabled>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label>Selected Role:</label>
                                            <?php echo Form::select('_mbrole', $validRoles, $defaultrole, array('class' => 'form-control center cap')); ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="searchmembertable" style="display:block;">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <?php $data = json_encode($current_members); ?>
                                        <!-- Search Member Table -->
                                        @include('common.searchmultiple')

                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        {{ Form::hidden($dlt_field, $item->id) }}
                                        {{ Form::hidden('_mbrids', $data) }}
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
            </div>
        </div>
    </div>
@endsection
