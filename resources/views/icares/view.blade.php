@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12 col-sm-12 center">
            <h3> {{ $fellowship->name }} {{ $title['singular'] }} </h3>
            <p>
                @if(!empty($info['address']) && !empty($info['city']) && !empty($info['zipcode']))
                    {{ $info['address'] }}, {{ $info['city'] }} {{ $info['zipcode'] }} 
                @endif 
            </p>
            <p><b>Meets Every:</b> <br/>{{ $fellowship->day }} @ {{ $fellowship->hours }}:{{ $fellowship->minutes }}</p>
            <p><b>Contact:</b> <br/>{{ $info['phone'] or ''}} {{ empty($info['phone']) ? '' : ' | ' }} {{ $fellowship->email or ''}} </p>
            <h1><i class="fa fa-users" aria-hidden="true"></i></h1>
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
@endsection
