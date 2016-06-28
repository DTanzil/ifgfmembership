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
        <div class="col-lg-12 col-sm-12 center" style="margin-bottom:20px;">
            <h3> {{ $family->name }} Family </h3>
            <p> Address: 
                @if(!empty($info['address']) && !empty($info['city']) && !empty($info['zipcode']))
                    {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} 
                @else
                    N/A
                @endif 
            </p>
            <p> Home Phone: {{ !empty($info['phone']) ?  $info['phone'] : 'N/A'}}</p>
            <p style="font-size:40px;"><i class="fa fa-users" aria-hidden="true"></i></p>
        </div>
    </div>
    
    <div class="row">
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
    </div>
@endsection
