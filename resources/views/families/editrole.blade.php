@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $family->name }} family > Select {{ $role }}
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
        <div class="col-lg-4"></div>
        <div class="col-lg-4 col-sm-12 baseinfo">
            <div class="well well-lg">
                
                @if (!empty($member))
                    <p> <?php echo trans('messages.member-selected', ['member' => $member->name, 'role' => $role, 'group-name' => $family->name, 'group' => 'family']); ?></p>
                    <p class="media-heading"> <span>{{ $role }} </span></p>
                   
                    <div class="dt-media">
                        <div class="media">
                            <div class="media-left media-middle">
                                <a href="#">
                                  <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;">
                                </a>
                            </div>
                            <div class="media-body">
                            <!-- <h4 class="media-heading">Bapak</h4> -->
                                <p> {{ trans('messages.name') }}: {{ $member->name }}</p>
                                <p> {{ trans('messages.age') }}:  {{ $member->birthdate }}</p>
                                <p> {{ trans('messages.icare') }}: XXXXX</p>
                      
                @else
                    <p> <?php echo trans('messages.none-selected', ['role' => $role, 'group-name' => $family->name, 'group' => 'family']); ?> </p>
                    <p class="media-heading"> <span>{{ $role }} </span></p>
                    
                    <div class="dt-media">
                        <div class="media">
                            <div class="media-left media-middle">
                                <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>                                        
                            </div>
                            <div class="media-body">
                                <p>{{ trans('messages.name') }}: - </p>
                                <p>{{ trans('messages.age') }}: - </p>
                    
                @endif

                            </div>
                        </div>
                    </div>
                <p><b><?php echo trans('messages.select-member', ['role' => $role, 'group-name' => $family->name, 'group' => 'family']); ?></b></p>
                <p style="font-style:italic;">{{ trans('messages.back-prev-page') }}</p> 

                <p class="center">
                    <a id="next-step" class="mty-btn btn" href="#"> Next </a>
                    <a href=" {{ $urls['cancel'] }} " class="mty-btn red btn btn-next">Cancel</a>
                </p>
            </div>
        </div>
        <div class="col-lg-4"></div>

        <div class="col-lg-12">

            <div class="searchmembertable" style="display:none;">

                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    

                    <!-- Search Member Table -->
                    @include('common.searchtable')  

                    <form action="{{ $urls['save'] }}" method="POST" class="mbr-save-form center">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_fmid', $family->id) }}
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
