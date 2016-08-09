@extends('layouts.admin')

@section('content')
    
<h3>Welcome, {{ Auth::user()->name }} !</h3>

<p> Please use the menu on the left to navigate your way. As an admin, you can manage membership, iCares, families, ministries and bible studies. </p>

<div class="row">    
	<div class="col-lg-3 col-sm-12">
	    <div class="dt-media" style="background-color:transparent;">
	        <div class="media">
	            <div class="media-left media-middle center">
	                <a href="{{ route('allmember') }}" style="color:black;">
	                	<span class="dt-icon dt-btm-space">
	                    	<i class="fa fa-user dt-profile" aria-hidden="true"></i> 
	                	</span>
	                <h3 class="dt-act-group">Members</h3>
	                </a>
	            </div>
	        </div>
	    </div>
	</div>

	@foreach ($groups as $group => $item)
        <div class="col-lg-3 col-sm-12">
            <div class="dt-media" style="background-color:transparent;">
                <div class="media">
                    <div class="media-left media-middle center">
                        <a href="{{ $item['url'] }}" style="color:black;">
                        	<span class="dt-icon dt-btm-space">
                            	<i class="fa fa-<?=$item['icons']?> dt-profile" aria-hidden="true"></i> 
                        	</span>

                        <h3 class="dt-act-group">{{ $group }}</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach 

@endsection