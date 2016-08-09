@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12">
                <!-- <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p> -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Membership Status
                    </div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                            <div class="row dt-row">
                                <h2 class="dt-title"> GENERAL INFO </h2>
                                @include('members.memberdetail')
                            </div>


                        <form role="form" action="{{ $urls['save'] }}" method="POST">                                  
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            {{ Form::hidden('_formaction', 'memberStatus') }}
                            {{ Form::hidden($dlt_field, $member->id) }}

                            <div class="center dt-roles">
                                <p class="mty-update-big"> By submitting this form, I would like to override and approve the membership status of this member ({{ $member->name }}) as 'MEMBER'. <br/>
                                    I declare that this member has sufficiently passed every requirements as a 'MEMBER' from here onwards.</p>
                                <label class="radio-inline">
                                    <input type="radio" name="membershipform" value="yesiagree" checked>I agree
                                </label>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn mty-btn mty-update-big center">
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
    </div>
</div>

@endsection
