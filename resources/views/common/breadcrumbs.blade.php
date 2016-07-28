<!-- Page Heading & Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @if(!isset($fellowship)) 
                {{ $title['header'] }} 
            @else
                {{ $fellowship->name or '' }} {{ $title['singular'] or '' }}
            @endif
 
        </h1>
        <!-- Breadcrumbs -->
        @if(isset($defaultclass))
            {!! Breadcrumbs::render(Request::route()->getName(), $fellowship, $defaultclass) !!}
        @elseif(isset($defaultrole))
            {!! Breadcrumbs::render(Request::route()->getName(), $fellowship, $defaultrole) !!}
        @elseif(isset($fellowship))
            {!! Breadcrumbs::render(Request::route()->getName(), $fellowship) !!}
        @elseif(isset($member))
            {!! Breadcrumbs::render(Request::route()->getName(), $member) !!}
        @else
            {!! Breadcrumbs::render(Request::route()->getName()) !!}
        @endif
    </div>
</div>

