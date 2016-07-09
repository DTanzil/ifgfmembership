@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

    <div class="row">        
        <div class="col-lg-12">
            <!-- Display Notification & Validation Errors -->
            @include('common.errors')

            <div class="container">
    
            <div class="mty-note"> 
                <p>This page lists all the registered {{ $title['singular'] }} at IFGF Bandung.</p>
                <p> <a class="mty-btn btn" href="{{ $urls['add'] }}"><i class="fa fa-btn fa-plus"></i>Add New {{ $title['singular'] }}</a></p>
            </div>
        
            
            <div class="alert alert-info" role="alert">
                <?php echo trans('messages.search-group-instruction', ['group' => $title['singular']]); ?>
            </div>

            <table id="itemtable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        @foreach ($tableCols as $key => $name)
                             <th>{{ $name }}</th>
                        @endforeach
                            <th>Action</th>                    
                    </tr>
                </thead>
               
                <tbody>
                    @if (count($results) > 0)
                        @foreach ($results as $item)
                            <tr class="cap">
                                @include('common.tablecols')
                                <!-- Table actions: view,edit,delete -->
                                <td>
                                    <form action="{{ $urls['delete'] }}/{{ $item->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::hidden('_formaction', $dlt_act) }}
                                        <a class="mty-btn btn green" href="{{ $urls['view'] }}/{{ $item->id }}"> <i class="fa fa-btn fa-info" aria-hidden="true"></i> View </a>
                                        <a class="mty-btn btn" href="{{ $urls['edit'] }}/{{ $item->id }}"> <i class="fa fa-btn fa-pencil" aria-hidden="true"></i> Edit </a>
                                        <button type="submit" class="btn btn-danger mty-delete">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan"7">There is no data at this time.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
