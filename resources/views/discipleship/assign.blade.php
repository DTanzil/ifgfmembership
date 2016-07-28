@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Enroll <span class="cap">{{ $defaultrole }}</span> in {{ $fellowship->name }}
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
                                    <div class="mty-note">
                                        Below is a list of registered members. Please select members that you wish to enroll as {{ $defaultrole }} in {{ $fellowship->name }} {{ $title['singular'] }}.                                
                                    </div>
                                    <div class="form-bottom">
                                        <div class="form-group">
                                            <label>Assigning Members of: </label>
                                            <input class="form-control center" value="{{ $fellowship->name }}" id="disabledInput" type="text" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>AS:</label>
                                            <input class="form-control center cap" value="{{ $defaultrole }}" id="disabledInput" type="text" disabled>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="searchmembertable">
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

