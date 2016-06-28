<!-- Member Information -->
    
<div class="panel panel-default">

    <div class="panel-heading">
        {{ trans('messages.members') }}
    </div>

    <div class="panel-body">
        <p class="center" style="margin-bottom:20px;"><?php echo trans('messages.panel-welcome', ['group' => $title['singular'], 'member' => $default_role]); ?></p>
        
        <div class="row">
            <div class="col-lg-6 col-sm-12" >
                <div class="mty-note"> 
                    <p><?php echo trans('messages.panel-add-a-member', ['roles' => $the_roles, 'group' => $title['singular']]); ?></p>
                    <a class="mty-btn btn" href="{{ $urls['assign'] }}"><i class="fa fa-btn fa-plus"></i>Add A Member</a>                                
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="mty-note"> 
                    <p><?php echo trans('messages.panel-add-members', ['group' => $title['singular']]); ?></p>
                    <a class="mty-btn btn" href="{{ $urls['assign'] }}"><i class="fa fa-btn fa-plus"></i>Add Multiple Members</a>  
                </div>                             
            </div>
        </div>
        
        <div class="row">
            @foreach ($order as $role)
                @if (isset($members[$role]) && count($members[$role]) >= 1)
                    @foreach ($members[$role] as $member)
                        <div class="col-lg-6 col-sm-12 form-box">
                            <div class="dt-media">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="{{ $urls['assign'] }}/{{ $role }}">

                                        @if(!empty($member->image))
                                          <img class="media-object dt-profile dt-circle"src="{{ asset($member->image) }}">
                                        @else
                                          <i class="fa fa-user dt-profile" style="color:orange;" aria-hidden="true"></i>
                                        @endif 

                                        </a>
                                    </div>
                                    <div class="media-body">
                                    <h4 class="media-heading"><span>{{ $role }} </span></h4>
                                    <p><b>{{ trans('messages.name') }}:</b> {{ $member->name }}</p>
                                    <p><b>{{ trans('messages.age') }}:</b> {{ $member->age }}</p>
                                    <p><b>{{ trans('messages.gender') }}:</b> {{ $member->gender }}</p>
                                    <p><b>{{ trans('messages.icare') }}:</b> XXXXX</p>

                                    <form action="{{ $urls['delete'] }}" method="POST">
                                        <a class="mty-btn btn green" href="{{ $urls['view'] }}/{{ $member->id }}"> <i class="fa fa-btn fa-info" aria-hidden="true"></i> {{ trans('messages.view') }} </a>
                                        <a class="mty-btn btn purple" href="{{ $urls['assign'] }}/{{ $role }}"> <i class="fa fa-btn fa-undo" aria-hidden="true"></i> {{ trans('messages.change') }}</a>

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
                    <div class="col-lg-6 col-sm-12 form-box">
                        <div class="dt-media">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="{{ $urls['assign'] }}/{{ $role }}">
                                        <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div class="media-body">
                                <h4 class="media-heading"><span>{{ $role }} </span></h4>

                                <p> <?php echo trans('messages.none-selected-2', ['role' => $role]); ?></p>
                                <p>{{ trans('messages.member-assign') }}</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>

                                <a class="mty-btn btn" href="{{ $urls['assign'] }}/{{ $role }}"><i class="fa fa-btn fa-bookmark-o" aria-hidden="true"></i> {{ trans('messages.assign') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>            
    </div>
</div>