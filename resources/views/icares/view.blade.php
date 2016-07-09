@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12 col-sm-12 center" style="margin-bottom:20px;">
            <h3> {{ $fellowship->name }} {{ $title['singular'] }} </h3>
            <p>
                @if(!empty($info['address']) && !empty($info['city']) && !empty($info['zipcode']))
                    {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} 
                @endif 
            </p>
            
            <?php 
                $time = $fellowship->time;
                $hours = intval($time/60) < 10 ? "0".intval($time/60) : intval($time/60);
                $minutes = $time%60 == 0 ? '00' : $time%60; 
            ?>

            <p><b>Meets Every:</b> <br/>{{ $fellowship->day }} @ {{ $hours }}:{{ $minutes }}</p>
            <p><b>Contact:</b> <br/>{{ $info['phone'] or ''}} {{ empty($info['phone']) ? '' : ' | ' }} {{ $fellowship->email or ''}} </p>

            <p style="font-size:40px;"><i class="fa fa-users" aria-hidden="true"></i></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">

        <!-- List of Members -->
        @include('common.viewtable')
        
        <div class="center">
            <a class="btn mty-btn mty-update-big" href="{{ $urls['cancel'] }}"> 
                <i class="fa fa-btn fa-arrow-left" aria-hidden="true"></i><?php echo trans('messages.return-to-group', ['name' => $fellowship->name, 'group' => $title['singular']]); ?>
            </a>
        </div>

        </div>
        <div class="col-lg-1"></div>
    </div>


    <!-- <div class="row">
        <div class="col-lg-12 col-sm-12">

            @foreach ($order as $role)
                @if (isset($members[$role]) && count($members[$role]) >= 1)
                    @foreach ($members[$role] as $member)

                        <div class="row" style="padding:30px;border-bottom:1px solid #eee;">
                            <div class="col-lg-3">
                                
                                <p class="center"> 
                                    @if(!empty($member->image))
                                      <img class="media-object dt-profile dt-circle" style="margin:auto;" src="{{ asset($member->image) }}">
                                    @else
                                      <i class="fa fa-user dt-profile" aria-hidden="true" style="margin:auto;" ></i>
                                    @endif 
                                </p>
                                    <h3 class="center" style="margin-bottom:30px;"> {{ $member->name}} </h3>
                                    <p class="center" style="color:red;"><b>{{ $member->is_member ? "MEMBER" : "VISITOR" }} </b></p>

                                    <p class="center"><i>First attended IFGF Bandung in XXXX</i></p>
                            </div>
                            <div class="col-lg-4">       
                                <ul class="dt-view">
                                    <li><b> Member ID</b> <br/>A0083BDOF738209</li>
                                    <li><b> Role in Family</b> <br/><span class="cap">{{ $role }}</span></li>
                                    <li><b> Cellphone</b> <br/>{{ $member->phone or 'N/A'}}  </li>
                                    <li class="cap">{{ $member->status }} | {{ $member->gender }}  
                                        @if(!empty($member->birthdate))
                                            | {{ $member->birthdate->age }} years old
                                        @endif
                                    <li>{{ $member->email or ''}}</li>
                                    <li>
                                        @if(!empty($member->birthdate))
                                            {{ $member->birthdate->format("d M Y") }}
                                        @else
                                            Date of birth not available
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-5">                            
                                <ul class="dt-view">
                                    <li><b> Address</b> <br/>Jalan Kejaksaan XII no 8 Blok 3, Bandung 32513</li>
                                    <li><b> iCare</b> <br/>The Awesome Breakthrough </li>
                                    <li><b> Other Activities</b> <br/>Bible Study Teacher, iCare Facilitator, Music Team  </li>
                                    <li><b> Date Baptized</b> <br/>8 July 2013 </li>
                                    <li><b> Date Baptized</b> <br/>8 July 2013 </li>                                        
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div> -->
@endsection
