<div class="col-lg-3">
    <p class="center"> 
        @if(!empty($member->image))
          <img class="media-object dt-circle" style="margin:auto;" src="{{ asset($member->image) }}">
        @else
          <i class="fa fa-user dt-profile" aria-hidden="true" style="margin:auto;" ></i>
        @endif 
    </p>
    <h3 class="center" style="margin-bottom:30px;"> {{ $member->name}} </h3>
    
    <p class="center">
        @if($member->isMember())
            <b style="background-color: blue; color: white; padding: 10px;">MEMBER </b>
        @else
            <b style="background-color: red; color: white; padding: 10px;">VISITOR </b>
        @endif
    </p>

    @if(isset($role))
        <p class="center" style="color:green; text-transform:uppercase; margin:20px;"><b>({{ $role }})</b></p>
    @endif
</div>

<div class="col-lg-4">       
    <dl class="dt-view">   
        <dt>Status</dt>
        <dd class="cap">{{ $member->status }}</dd>
        <dt>Gender</dt>
        <dd class="cap">{{ $member->gender }}</dd>
        <dt>Cellphone & Email</dt>
        <dd>{{ $member->phone or 'N/A'}} | {{ $member->email or 'N/A'}}  </dd>
        <dt>Birth Date</dt>
        <dd>{{ !empty($member->birthdate) ? $member->birthdate->format("d M Y") : "-" }}
            @if(!empty($member->birthdate))
                <i>({{ $member->birthdate->age }} years old)</i>
            @endif
        </dd>
        <dt>Ibadah</dt>
        <dd><?php echo Config::get('constants.IBADAH.'.$member->service) ?></dd>
    </dl>
</div>

<div class="col-lg-5">   
    <dl class="dt-view">   
        <dt>iCare</dt>
        <dd>{{ count($member->icare) > 0 ? $member->icare->implode('name', ", ") : "-"}}</dd>
        <dt>Ministry</dt>
        <dd>{{ count($member->ministry) > 0 ? $member->ministry->implode('name', ", ") : "-"}}</dd>
        <dt>Address</dt>
        <dd><?php echo (!empty($info['address']) ? $info['address'] . "," : '-'); ?> {{ $info['city'] }} {{ $info['zipcode'] }}</dd>
        <dt>Date Joined</dt>
        <dd>{{ !empty($member->date_baptized) ? $member->date_baptized->format("d M Y") : "-"}}</dd>
        <dt>Date Baptized</dt>
        <dd>{{ !empty($member->date_baptized) ? $member->date_baptized->format("d M Y") : "-"}}</dd>
    </dl>
</div>