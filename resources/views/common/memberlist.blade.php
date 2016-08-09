<!-- Member Information -->
    
<div class="panel panel-default">
    <div class="panel-heading">
        {{ trans('messages.members') }}
    </div>

    <div class="panel-body">
        <p class="center mty-heading"><?php echo trans('messages.panel-welcome', ['group' => $title['singular'], 'member' => $default_role]); ?></p>
        <div class="row listbuttons">
            @foreach($validRoles as $role => $limit)
                <div class="col-lg-3 col-sm-12" >
                    <div class="mty-note"> 
                        <p><?php echo trans('messages.panel-add-a-member', ['role' => $role, 'group' => $title['singular']]); ?></p>
                        <a class="mty-btn btn cap" href="{{ $urls['assign'] }}/{{ $role }}"><i class="fa fa-btn fa-undo" aria-hidden="true"></i>{{ trans('messages.edit') }} {{ $role }}</a> 
                        <p style="margin-top:4px;"><i>{{ $limit > 0 ? "Max: $limit member" : "Any number of members" }}</i></p> 
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            @foreach ($validRoles->keys() as $role)
                @if(isset($members[$role]) && count($members[$role]) > 0)
                    @foreach($members[$role] as $member)
                        <div class="col-lg-4 col-sm-12 form-box">
                            <div class="dt-media">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="{{ $urls['assign'] }}/{{ $role }}">
                                            @if(!empty($member->image))
                                              <img class="media-object dt-profile dt-circle"src="{{ url('ifgf-photos/') }}/{{ $member->image }}">
                                              
                                            @else
                                              <i class="fa fa-user dt-profile orn" aria-hidden="true"></i>
                                            @endif 
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><span>{{ $role }} </span></h4>
                                        <h3>{{ $member->name }} </h3>
                                        <p>
                                            <i class="fa fa-star" aria-hidden="true"></i> &nbsp; 
                                            {{ $member->gender }} 
                                            @if(!empty($member->age))
                                                | {{ $member->age }} {{ $member->age > 1 ? 'years old' : 'year old' }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <form action="{{ $urls['delete'] }}/{{ $fellowship->id }}" method="POST" class="center">
                                    <a class="mty-btn btn green" href="{{ $urls['viewmember'] }}/{{ $member->id }}"> <i class="fa fa-btn fa-info" aria-hidden="true"></i> {{ trans('messages.view') }} </a>
                                    <a class="mty-btn btn purple" href="{{ $urls['assign'] }}/{{ $role }}"> <i class="fa fa-btn fa-undo" aria-hidden="true"></i> {{ trans('messages.change') }}</a>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    {{ Form::hidden('_formaction', 'deleteMember') }}
                                    {{ Form::hidden('_mbrid', $member->id) }}
                                    <button type="submit" class="btn btn-danger mty-delete">
                                        <i class="fa fa-btn fa-times" aria-hidden="true"></i>Dismiss
                                    </button>
                                </form>                                        
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-4 col-sm-12 form-box">
                        <div class="dt-media">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="{{ $urls['assign'] }}/{{ $role }}">
                                        <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><span>{{ $role }} </span></h4>
                                    <p> <?php echo trans('messages.none-selected', ['role' => $role, 'group' => $title['singular']]); ?> {{ trans('messages.member-assign') }}</p>
                                </div>
                            </div>
                            <div class="center">
                            <a class="mty-btn btn" href="{{ $urls['assign'] }}/{{ $role }}"><i class="fa fa-btn fa-bookmark-o" aria-hidden="true"></i> {{ trans('messages.assign') }}</a>
                            </div> 
                        </div>                           
                    </div>
                @endif        
            @endforeach
            </div>
        </div>            
    </div>
</div>