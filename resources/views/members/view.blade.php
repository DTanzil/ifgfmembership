@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

        <!--========================================== Member Info ==========================================-->
        
        <div class="row dt-row">
            <h2 class="dt-title"> GENERAL INFO </h2>
            @include('members.memberdetail')
        </div>

        <!--========================================== Family ==========================================-->

        <div class="row dt-row">
            <h2 class="dt-title"> FAMILY INFO </h2>
            <?php $families = $member->family; ?>

            @if(count($families) == 0)
                <div class="center">This member is not associated with any family.</div>
            @else
                @foreach($families as $key => $fam)
                    <?php 
                    $family = $fam->members->groupBy(function($item){
                        return $item->pivot->title;
                    }); ?>

                    <div class="col-lg-12 col-sm-12 center dt-btm-space">
                        <h3>{{ $fam->name }} Family </h3>
                        <?php $info = $fam->description; ?>
                        <p> <b>Address: </b>
                            @if(!empty($info['address']) && !empty($info['city']) && !empty($info['zipcode']))
                                {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} 
                            @else
                                N/A
                            @endif 
                        </p>
                        <p><b>Home Phone:</b> {{ !empty($info['phone']) ?  $info['phone'] : 'N/A'}}</p>
                    </div>

                    @foreach ($validRoles->keys() as $role)
                        @if(isset($family[$role]) && count($family[$role]) > 0)
                            @foreach($family[$role] as $mbr)
                                <div class="col-lg-4 col-sm-12 form-box">
                                    <div class="dt-media">
                                        <div class="media">
                                            <div class="media-left media-middle">
                                                <a href="{{ $urls['assign'] }}/">
                                                    @if(!empty($mbr->image))
                                                      <img class="media-object dt-profile dt-circle"src="{{ url('ifgf-photos/') }}/{{ $mbr->image }}">
                                                      
                                                    @else
                                                      <i class="fa fa-user dt-profile orn" aria-hidden="true"></i>
                                                    @endif 
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><span>{{ $role }} </span></h4>
                                                <h3>{{ $mbr->name }} </h3>
                                                <p>
                                                    <i class="fa fa-star" aria-hidden="true"></i> &nbsp; 
                                                    {{ $mbr->gender }} 
                                                    @if(!empty($mbr->age))
                                                        | {{ $mbr->age }} {{ $mbr->age > 1 ? 'years old' : 'year old' }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <!-- <a class="mty-btn btn green" href="{{ $urls['viewmember'] }}/{{ $mbr->id }}"> <i class="fa fa-btn fa-info" aria-hidden="true"></i> {{ trans('messages.view') }} </a>                                           -->
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach

                @endforeach
            @endif
        </div>

        <!--========================================== Bible Study ==========================================-->

        <div class="row dt-row">
            <h2 class="dt-title"> BIBLE STUDY INFO </h2>
                <?php $lessons = array('engage', 'establish', 'equip'); $num = 0; ?>
                @foreach($lessons as $biblestudy)

                    <?php $discipleship = $member->$biblestudy; $num += count($discipleship); ?>
                    @foreach($discipleship as $key => $item)
                        <div class="col-lg-6 col-sm-12 dt-btm-space">
                            <div id="dt-bible-group">
                                <h3 class="center mty-heading"><i class="fa fa-fw fa-btn fa-book"></i><?php echo strtoupper($biblestudy); ?></h3>
                                <p> {{ $member->name }} is a student in <b>{{ $item->name }} <span class="cap">{{ $biblestudy }}</span> </b></p>
                                <p> Status: <b>{{ $item->pivot->description }}</b></p>
                                <ul class="dt-view">
                                    @foreach($item->classes as $class)
                                        <?php 
                                            $attn = $class->attendance->lists('member_id', 'member_id')->toArray(); 
                                            $now = \Carbon\Carbon::now();
                                            $date = $class->class_date; 
                                        ?>                        
                                        @if(in_array($member->id, $attn))
                                            <li><span style="color:blue;"><b>Attended</b></span> {{ $class->name }} ({{ $class->class_date->format('D, d M Y') }})</li>
                                        @else
                                            <li><span style="color:red;"><b>N/A</b></span> {{ $class->name }} ({{ $class->class_date->format('D, d M Y') }})</li>                             
                                        @endif
                                    @endforeach
                                </ul> 
                            </div>
                        </div>
                    @endforeach
                @endforeach
                @if($num == 0)
                    <div class="center">This member is not a student in any bible study.</div>
                @endif            
        </div>

        <!--========================================== Teachings ==========================================-->

        <?php $teachings = $member->teachings; ?>
        @if(count($teachings) > 0)
            <div class="row dt-row">
                <h2 class="dt-title"> TEACHINGS </h2>
                <h3> This member has taught the following class sessions: </h3>
                <dl class="dt-view">
                    @foreach($teachings as $teach)
                        <dt>{{ $teach->lesson->name }}</dt>
                        <dd>{{ $teach->name }} ({{ $class->class_date->format('D, d M Y') }})</dd>
                    @endforeach
                </dl>
            </div>
        @endif

        <div class="center">
            <a class="btn mty-btn mty-update-big" href="{{ $urls['cancel'] }}"> 
                <i class="fa fa-btn fa-arrow-left" aria-hidden="true"></i><?php echo trans('messages.return-to-group', ['name' => $member->name, 'group' => '']); ?>
            </a>
        </div>
    </div>

@endsection
