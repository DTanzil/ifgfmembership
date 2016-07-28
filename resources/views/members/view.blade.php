@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12 col-sm-12 center">

            <!-- <p style="border-bottom:1px solid #eee;">
            @if(Storage::disk('img')->exists("{$member->qr_image}"))
                
                QR Code <br/><img class="media-object" style="height:197px; margin:auto;" src="{{ asset($member->qr_image) }}"> 
            @endif
            </p> -->

            <!-- <p><i>Scan this QR Code to view all information about this member.</i></p> -->
            
            <!-- @if(Storage::disk('img')->exists("{$member->image}"))
                <img class="media-object dt-circle" src="{{ asset($member->image) }}"> 
            @else
                <i class="fa fa-user dt-profile" aria-hidden="true"></i>
            @endif
 -->
<!--             
            <h3> {{ $member->name }} {{ $title['singular'] }} </h3>
            <p>
                @if(!empty($info['address']) && !empty($info['city']) && !empty($info['zipcode']))
                    {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} 
                @endif 
            </p>
            <p><b>Meets Every:</b> <br/>{{ $member->day }} @ {{ $member->hours }}:{{ $member->minutes }}</p>
            <p><b>Contact:</b> <br/>{{ $info['phone'] or ''}} {{ empty($info['phone']) ? '' : ' | ' }} {{ $member->email or ''}} </p>
            <h1><i class="fa fa-users" aria-hidden="true"></i></h1> -->
        </div>
    </div>
    

    <!-- <div class="row"> -->
        
        <div class="row" style="padding:30px;">
            <h2 style="padding:10px;text-align:center;border-bottom:1px solid #eee;font-weight:bold;"> GENERAL INFO</h2>
            <div class="col-lg-3">
                <p class="center"> 
                    @if(!empty($member->image))
                      <img class="media-object dt-circle" style="margin:auto;" src="{{ asset($member->image) }}">
                    @else
                      <i class="fa fa-user dt-profile" aria-hidden="true" style="margin:auto;" ></i>
                    @endif 
                </p>
                <h3 class="center" style="margin-bottom:30px;"> {{ $member->name}} </h3>
                <!-- <p class="center" style="color:red;"><b>{{ $member->is_member ? "MEMBER" : "VISITOR" }} </b></p> -->
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

        <div class="row" style="padding:30px;">
            <h2 style="padding:10px;text-align:center;border-bottom:1px solid #eee;font-weight:bold;"> FAMILY INFO</h2>
            
            <?php 
            // var_dump($member); die();
            $num = $member->family;
            foreach ($num as $key => $fam) {
                // var_dump($fam->id);
                // $fam_members = $fam->members;

                $fam_members = $fam->members->groupBy(function($item){
                    return $item->pivot->title;
                });

                var_dump($fam_members);
                die();
                $num = count($fam_members);
                // var_dump($num);
                if($num == 1 || $num == 0) {
                    $rownum = 12;
                } elseif($num%2 == 0) {
                    $rownum = 6;
                } else {
                    $rownum = 4;
                }

                foreach ($fam_members as $key => $mbr) { ?>

                @foreach ($validRoles->keys() as $role)
                    @if(isset($members[$role]) && count($members[$role]) > 0)
                        @foreach($members[$role] as $member)
                            <div class="col-lg-<?= $rownum?> col-sm-12 form-box">
                                <div class="dt-media">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <a href="{{ $urls['assign'] }}/{{ $role }}">
                                                @if(!empty($member->image))
                                                  <img class="media-object dt-profile dt-circle"src="{{ asset($member->image) }}">
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
                                       <!--  <a class="mty-btn btn purple" href="{{ $urls['assign'] }}/{{ $role }}"> <i class="fa fa-btn fa-undo" aria-hidden="true"></i> {{ trans('messages.change') }}</a>
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::hidden('_formaction', 'deleteMember') }}
                                        {{ Form::hidden('_mbrid', $member->id) }}
                                        <button type="submit" class="btn btn-danger mty-delete">
                                            <i class="fa fa-btn fa-times" aria-hidden="true"></i>Dismiss
                                        </button> -->
                                    </form>                                        
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach


            

        
            <?php                        
                }
            }

            ?>

            

        </div>

                <div class="row" style="padding:30px;">
            <h3 style="padding:10px;text-align:center;border-bottom:1px solid #eee;"> BIBLE STUDY INFO</h3>
            <div class="col-lg-3">
               <!--  <p class="center"> 
                    @if(!empty($member->image))
                      <img class="media-object dt-circle" style="margin:auto;" src="{{ asset($member->image) }}">
                    @else
                      <i class="fa fa-user dt-profile" aria-hidden="true" style="margin:auto;" ></i>
                    @endif 
                </p> -->
                <h3 class="center" style="margin-bottom:30px;"> {{ $member->name}} </h3>
                <!-- <p class="center" style="color:red;"><b>{{ $member->is_member ? "MEMBER" : "VISITOR" }} </b></p> -->
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


    <!-- </div> -->
@endsection
