@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $family->name }} {{ $title['singular'] }}
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
                    <form role="form" action="{{ $urls['save'] }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_formaction', 'editFamily') }}
                        {{ Form::hidden('_fmid', $family->id) }}


                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-bottom">

                                    <div class="form-group">
                                        <label class="required">Family Name</label>
                                        <input name="name" class="form-control" value="{{ $family->name }}" placeholder="Family Name">
                                    </div>

                                    <div class="form-group input-group">
                                        <label>Home Phone</label>
                                        <input type="text" name="phone" value="{{ $info['phone'] }}" class="form-control" placeholder="Home Phone">
                                        <p class="help-block">Example: 022-1234567</p>
                                    </div>

                                    <p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                                      
                                </div>                                                                                               
                            </div>

                            <div class="col-lg-6 col-sm-12 ">
                                <div class="form-group">
                                    <label>Home Address</label>
                                    <input type="text" name="address" value="{{ $info['address'] }}" class="form-control" placeholder="Home Address">
                                </div>

                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ $info['city'] }}" class="form-control" placeholder="City">
                                </div>

                                <div class="form-group input-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="zipcode" value="{{ $info['zipcode'] }}" class="form-control" placeholder="Postal Code">
                                </div>
                            </div>
                        </div>
                    <div class="center"><button type="submit" class="btn center">Update</button></div>
                </form>
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
