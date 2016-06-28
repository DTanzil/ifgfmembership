@extends('layouts.admin')

@section('content')
    
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $icare->name }} iCare > Select {{ $role }}
            </h1>
           <ol class="breadcrumb">
                <li class="active">
                    Home > All Families > 
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">   

        <!-- Display Notification & Validation Errors -->
        @include('common.errors')
        <div class="col-lg-3"></div>
        <div class="col-lg-6 col-sm-12 baseinfo">
            <div class="well well-lg center">
                
                @if (!empty($member))
                    <p> <?php echo trans('messages.member-selected', ['member' => $member->name, 'role' => $role, 'group-name' => $icare->name, 'group' => 'family']); ?></p>
                    <p class="media-heading"> <span>{{ $role }} </span></p>
                    
                    <div>
                        <div>
                            <p>
                                @if(!empty($member->image))
                                    <img class="dt-profile dt-circle" src="{{ asset($member->image) }}">            
                                @else
                                    <i class="fa fa-user dt-profile" aria-hidden="true"></i>
                                @endif
                            </p>    
                @else
                    <p> <?php echo trans('messages.none-selected', ['role' => $role, 'group-name' => $icare->name, 'group' => 'iCare']); ?> </p>
                    <p class="media-heading"> <span>{{ $role }} </span></p>
                    
                    <div>
                        <div>
                            <p><i class="fa fa-user-plus dt-profile" aria-hidden="true"></i></p>
                            
                @endif
                            <div>
                                <p><b>{{ trans('messages.name') }}:</b> {{ empty($member->name) ? '-' : $member->name }} </p>
                                <p><b>{{ trans('messages.age') }}:</b> {{ empty($member->birthdate) ? '-' : $member->birthdate->age }} </p>
                            </div>
                        </div>
                    </div>

                <p><b><?php echo trans('messages.select-member', ['role' => $role, 'group-name' => $icare->name, 'group' => 'family']); ?></b></p>
                <p><i>{{ trans('messages.back-prev-page') }}</i></p> 

                <p class="center">
                    <a id="next-step" class="mty-btn btn" href="#"> Next </a>
                    <a href=" {{ $urls['cancel'] }} " class="mty-btn red btn btn-next">Cancel</a>
                </p>
            </div>
        </div>
        <div class="col-lg-6"></div>

        <div class="col-lg-12">

            <div class="searchmembertable" style="display:none;">

                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    
                    <!-- Search Member Table -->
                    @include('common.searchtable')  

                    <form action="{{ $urls['save'] }}" method="POST" class="mbr-save-form center">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_icrid', $icare->id) }}
                        {{ Form::hidden('_mbrole', $role) }}
                        {{ Form::hidden('_fmaction', 'replace') }}
                        {{ Form::hidden('_mbrid', '') }}
                        {{ Form::hidden('_formaction', 'editRole') }}
                        <button type="submit" class="btn mty-btn mty-update-big">
                            <i class="fa fa-btn fa-check" aria-hidden="true"></i>{{ trans('messages.update') }}
                        </button>
                    </form>

                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
@endsection
