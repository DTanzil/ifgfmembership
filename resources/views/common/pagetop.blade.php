<p class="media-heading"> 
	<a class="mty-btn btn purple" href="{{ $urls['view'] }}/"> <i class="fa fa-btn fa-file-text-o" aria-hidden="true"></i> 
	@if(isset($member))
		View {{ $member->name }}
	@else
	    View {{ $fellowship->name }} {{ $title['singular'] }}
	@endif
	</a>
</p>
<p><i>Fields marked with asterisk (<span style="color:red;">*</span>) are required </i></p>
                   