@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12 col-sm-12 center" style="margin-bottom:20px;">
            <h3> {{ $fellowship->name }} {{ $title['singular'] }} </h3>
            <p> <b>Address: </b>
                @if(!empty($info['address']) && !empty($info['city']) && !empty($info['zipcode']))
                    {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} 
                @else
                    N/A
                @endif 
            </p>
            <p><b>Home Phone:</b> {{ !empty($info['phone']) ?  $info['phone'] : 'N/A'}}</p>
            <h1><i class="fa fa-home" aria-hidden="true"></i></h1>
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
                                <!-- <p class="center" style="color:red;"><b>{{ $member->is_member ? "MEMBER" : "VISITOR" }} </b></p> -->
                                <p class="center" style="color:green; text-transform:uppercase;"><b>{{ $role }}</b></p>
                                <p class="center"><i>Attended IFGF Bandung since {{ $member->date_joined or "-"}}</i></p>
                            </div>

                            <div class="col-lg-4">       
                                <ul class="dt-view">
                                    <li class="cap"><b> General Info</b> <br/>{{ $member->status }} | {{ $member->gender }}  
                                        @if(!empty($member->birthdate))
                                            | {{ $member->birthdate->age }} years old
                                        @endif
                                    </li>
                                    <li><b> Member ID</b> <br/>A0083BDOF738209</li>
                                    <li><b> Membership Status</b> <br/><b><?php echo ($member->is_member ? "<span style='color:blue;'>MEMBER</span>" : "<span style='color:red;'>VISITOR</span>"); ?></b></li>
                                    <!-- <li><b> Role in Family</b> <br/><span class="cap">{{ $role }}</span></li> -->
                                    <li><b> Cellphone & Email</b> <br/>{{ $member->phone or 'N/A'}} | {{ $member->email or 'N/A'}} </li>
                                    <li><b> Birth Date</b> <br/>{{ !empty($member->birthdate) ? $member->birthdate->format("d M Y") : "-" }}</li>
                                   
                                    

                                    
                                   
                                </ul>
                            </div>
                            <div class="col-lg-5">                            
                                <ul class="dt-view">
                                    <li><b> Address</b> <br/>{{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }}</li>
                                    <li><b> iCare</b> <br/>{{ count($member->icare) > 0 ? $member->icare->implode('name', ", ") : "-"}}</li>
                                    <li><b> Ministry</b> <br/>{{ count($member->ministry) > 0 ? $member->ministry->implode('name', ", ") : "-"}}</li>
                                  
                                    <li><b> Ibadah </b> <br/> <?php echo Config::get('constants.IBADAH.'.$member->service) ?></li>
                                    <li><b> Date Baptized</b> <br/>{{ !empty($member->date_baptized) ? $member->date_baptized->format("d M Y") : "-"}}</li>                                        
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endsection
