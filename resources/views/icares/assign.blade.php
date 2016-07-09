@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Assign <span class="cap">{{ $defaultrole }}</span>
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
                                        <p> Assigning Members of: </p>
                                        <div class="form-group input-group" style="margin:auto;" >
                                            <input class="form-control center" value="{{ $fellowship->name }} {{ $title['singular'] }}" id="disabledInput" type="text" disabled>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label>AS:</label>
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
                                        @include('common.searchtable')

                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        {{ Form::hidden($dlt_field, $fellowship->id) }}
                                        {{ Form::hidden('_mbrids', $data) }}
                                        {{ Form::hidden('_formaction', 'editRole') }}
                                       
                                        <div class="center">
                                            <button type="submit" class="btn mty-btn mty-update-big">
                                                <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                                            </button>
                                            <a class="btn mty-btn mty-update-big grey" href="{{ $urls['cancel'] }}"> 
                                                <i class="fa fa-btn fa-times" aria-hidden="true"></i>{{ trans('messages.cancel') }} 
                                            </a>
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

@section('myscript')
    <script>
        jQuery(document).ready(function(){
            //redirect users if dropdown select is changed
            $('select[name="_mbrole"]').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var baseUrl = "{{ $urls['edit'] }}";
                var url = baseUrl+"/"+ this.value;
                window.location.replace(url); 
            });
        });
    </script>
@endsection

