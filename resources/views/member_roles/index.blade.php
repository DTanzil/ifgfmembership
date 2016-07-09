@extends('layouts.admin')

@section('content')

@include('common.breadcrumbs')

<div class="row">
    <div class="col-lg-12">
        <!-- Display Validation Errors -->
        @include('common.errors')
        
        <div class="mty-note"> 
            <p>This is where you can add, edit or delete a role in Ministry, iCare, or Family.  </p>
            <p> <a class="mty-btn btn" href="{{ $urls['add'] }}"><i class="fa fa-btn fa-plus"></i>Add New {{ $title['singular'] }}</a></p>
        </div>
        
         <!-- Display Member Roles Important Notes -->
        @include('member_roles.notes')

        <table id="itemtable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    @foreach ($tableCols as $key => $name)
                         <th>{{ $name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @if (count($results) > 0)
                    @foreach ($results as $item)
                        <tr class="cap">
                            @foreach ($tableCols as $key => $col)
                                
                                @if($key == 'type') 
                                    <td>{{ substr($item->$key, 4, strlen($item->$key)) }} </td>

                                @else
                                    <td>{{ $item->$key or 'N/A'}}</td>
                                @endif
                            @endforeach

                            <!-- Table actions: view,edit,delete -->
                            <!-- <td>
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    

                                    <a class="mty-btn btn" href=""> <i class="fa fa-btn fa-pencil" aria-hidden="true"></i> Edit </a>
                                    <button type="submit" class="btn btn-danger mty-delete">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td> -->
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

@endsection
