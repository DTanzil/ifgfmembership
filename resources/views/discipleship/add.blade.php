@extends('layouts.admin')

@section('content')
    
@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12">
            <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
            <div class="panel panel-default">
                <div class="panel-heading">
                    General Information
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form role="form" action="{{ $urls['save'] }}" method="POST">
                        <div class="row">
                            <!-- Add Member Form -->
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            {{ Form::hidden('_formaction', $dlt_act) }}

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <input name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
                                        <p class="help-block">Example: Batch #3 - 2015</p>
                                    </div>
                                    
                                    @foreach($classes as $key => $class)
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group input-group">
                                                    <label class="required">Session {{ $key+1 }}: ({{ $class }})</label>
                                                    <?php $field = 'session_'.$key; ?>
                                                    <input type="text" class="mydate form-control" name=<?=$field?> value="{{ old($field) }}" placeholder="Date">
                                                </div>
                                            </div>                                            
                                        </div>
                                    @endforeach
                                </div>                                                                                               
                            </div>
                            <div class="col-lg-6 col-sm-12 "></div>
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
