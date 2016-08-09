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
                         
                        <div class="row dt-row listbuttons">
                             @include('members.memberdetail')
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endsection
