@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $family->name }} Family
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
        
        <div class="col-lg-12">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- General Information -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    General Information 
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 form-box">
                            
                            <form role="form" action="{{ $urls['save'] }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                {{ Form::hidden('_formaction', 'editData') }}
                                {{ Form::hidden('_fmid', $family->id) }}
                                    <div class="form-bottom">
                                        <p> Family Name: </p>
                                        <div class="form-group input-group">
                                            <input name="name" class="form-control" value="{{ $family->name }}" placeholder="Family Name">
                                        </div>
                                    </div>                                                               
                                <button type="submit" class="btn">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Family Member Information -->
            <div class="panel panel-default">
                <div class="panel-heading">
                   {{ trans('messages.family-member') }}
                </div>

                <div class="panel-body">

                    <p> {{ trans('messages.family-welcome') }} </p>
                            
                    <div class="row">
                        
                        @foreach ($order as $role)

                            @if (isset($members[$role]) && count($members[$role]) >= 1)
                                @foreach ($members[$role] as $member)
                                    <!-- <p>I have one or more {{ $member->name }} records!</p> -->
                                    <?php //var_dump($member->groupid); die(); ?>
                                    <div class="col-lg-6 col-sm-12 form-box">
                                        <div class="dt-media">
                                            <div class="media">
                                                <div class="media-left media-middle">
                                                    <a href="{{ $urls['edit'] }}/{{ $role }}">
                                                      <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                <h4 class="media-heading"><span>{{ $role }} </span></h4>
                                                <p>{{ trans('messages.name') }}: {{ $member->name }}</p>
                                                <p>{{ trans('messages.age') }}: {{ $member->age }}</p>
                                                <p>{{ trans('messages.gender') }}: {{ $member->gender }}</p>
                                                <p>{{ trans('messages.icare') }}: XXXXX</p>

                                                <form action="{{ $urls['delete'] }}" method="POST">
                                                    <a class="mty-btn btn green" href="#"> <i class="fa fa-btn fa-info" aria-hidden="true"></i> {{ trans('messages.view') }} </a>
                                                    <a class="mty-btn btn purple" href="{{ $urls['edit'] }}/{{ $role }}"> <i class="fa fa-btn fa-undo" aria-hidden="true"></i> {{ trans('messages.change') }}</a>

                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    {{ Form::hidden('_grpid', $member->groupid) }}
                                                    <button type="submit" class="btn btn-danger mty-delete">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <!-- <p>Skip {{ $role }}</p> -->
                                
                                <div class="col-lg-6 col-sm-12 form-box">
                                    <div class="dt-media">
                                        <div class="media">
                                            <div class="media-left media-middle">
                                                <a href="{{ $urls['edit'] }}/{{ $role }}">
                                                    <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>
                                                
                                                  <!-- <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;"> -->
                                                </a>
                                            </div>

                                            <div class="media-body">
                                            <h4 class="media-heading"><span>{{ $role }} </span></h4>

                                            <p> <?php echo trans('messages.none-selected-2', ['role' => $role]); ?></p>
                                            <p>{{ trans('messages.member-assign') }}</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>

                                            <a class="mty-btn btn" href="{{ $urls['edit'] }}/{{ $role }}"><i class="fa fa-btn fa-bookmark-o" aria-hidden="true"></i> {{ trans('messages.assign') }}</a>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach

                </div>
                    <!-- /.row (nested) -->                   
                    <div class="mty-note">
                        <p> {{ trans('messages.family-add-child') }}  </p>
                        <a class="mty-btn btn" href="{{ $urls['addrole'] }}"><i class="fa fa-btn fa-plus"></i>Add Child</a>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
@endsection
