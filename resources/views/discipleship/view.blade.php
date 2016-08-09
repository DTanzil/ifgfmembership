@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">
        <div class="col-lg-12 col-sm-12 center">
            <h3> {{ $fellowship->name }}</h3>  
            <h5> {{ count($fellowship->students) }} students enrolled</h5>   
            <h1><i class="fa fa-graduation-cap" aria-hidden="true"></i></h1> 
        </div>
    </div>    
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="listbuttons">
                <h2> Class Sessions </h2>
                <ul class="dt-view">
                    @foreach($fellowship->classes as $class)
                        @if(count($class->teachers) >= 1 )
                            <li><b>{{ $class->name }}</b> ({{ $class->class_date->format('D, d M Y') }}) <br/> Taught by <b>{{ $class->teachers->implode('name', ' and ')  }}</b></li>                        
                        @else
                            <li><b>{{ $class->name }}</b> ({{ $class->class_date->format('D, d M Y') }}) <br/> <i>No teacher assigned</i></li>
                        @endif 
                    @endforeach
                </ul>
            </div>
            <!-- List of Class Attendance -->
            @include('common.attendancetable')
            <div class="center">
                <a class="btn mty-btn mty-update-big" href="{{ $urls['cancel'] }}"> 
                    <i class="fa fa-btn fa-arrow-left" aria-hidden="true"></i><?php echo trans('messages.return-to-group', ['name' => $fellowship->name, 'group' => $title['singular']]); ?>
                </a>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>

@endsection
