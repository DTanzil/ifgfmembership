@extends('layouts.admin')

@section('content')

     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $title['header'] }} <small>yaay</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    Home > All Families > 
                </li>
            </ol>

        </div>
    </div>

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
                            <tr>
                                @foreach ($tableCols as $key => $col)
                                    @if($key == 'age') 
                                        <td> {{ !empty($item->birthdate) ? $item->birthdate->age : '-' }} </td>                           
                                    @elseif($key == 'is_member')
                                        <td>{{ $item->$key ? 'Member' : 'Visitor'}}</td>
                                    @else
                                        <td>{{ $item->$key or 'N/A'}}</td>
                                    @endif
                                @endforeach

                                <!-- Table actions: view,edit,delete -->
                                <td>
                                    <form action="{{ $urls['delete'] }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::hidden($dlt_field, $item->id) }}
                                       
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
        <!-- </div> -->
        </div>
    </div>
</div>


    
@endsection
