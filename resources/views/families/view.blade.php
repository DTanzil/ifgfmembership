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
            <p> Address: {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} </p>
            <p> Home Phone: {{ $info['phone'] }}</p>
            <p style="font-size:40px;"><i class="fa fa-users" aria-hidden="true"></i></p>
        </div>
    </div>
    
    @foreach ($order as $role)
        @if (isset($members[$role]) && count($members[$role]) >= 1)
            @foreach ($members[$role] as $member)

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="col-lg-6">
                            
                            <p> 
                                <a href="{{ $urls['edit'] }}/">
                                    <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="margin-right:30px;height:230px;width:230px;float:left;">
                                </a>
                                <div style="padding:5px;">
                                <h3 style="margin-top:0;"> {{ $member->name}} </h3>
                                <p> <span class="mty-bold"> Role in family: </span> {{ $role }} </p>
                                <p> <span class="mty-bold"> Member ID: </span> A0083BDOF738209</p>
                                <p> Member since XXXX or Not a member of IFGF Bandung</p>
                                <p> <span class="mty-bold"> iCare:</span> The Awesome Breakthrough </p>
                                <p> <span class="mty-bold"> Other Roles: </span>Bible Study Teacher, iCare Facilitator, Music Team </p>
                                </div>
                            </p>

                        </div>
                        <div class="col-lg-6" style="border-left: 3px solid blue;">
                            <p> Date of birth: XXXXX (Age ##)</p>
                            <p> Date of birth: XXXXX (Age ##)</p>
                            <p> Address: XXXXX </p>
                            <p> E-mail: XXXXX </p>
                            <p> Cell phone: XXXXX </p>
                            <p> Home Phone: XXXX </p>
                            <p> Date Baptized: XXXX </p>
                            <p> Home Phone: XXXX </p>
                        </div>
                    </div>
            </div>


            @endforeach

        @else
            <!-- <p> NONE </p> -->

        @endif
    @endforeach

    
    

    
@endsection
