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
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="container">
    
        <!-- <div class="col-sm-12"> -->

            <!-- <button type="button" class="btn btn-primary "><a href="/ifgfbdg/public/groups/family/add"><i class="fa fa-btn fa-plus"></i>Add New {{ $title['singular'] }}</a></button> -->

            <a href="{{ $urls['add'] }}"><i class="fa fa-btn fa-plus"></i>Add New {{ $title['singular'] }}</a>

            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>

                        @foreach ($tableCols as $key => $name)
                             <th>{{ $name }}</th>
                        @endforeach
                        
                        <th>Action</th>
                        
                    </tr>
                </thead>
               <!--  <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        
                        <th>Phone</th>
                        <th>Classes</th>
                        <th>Member</th>
                        <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @if (count($results) > 0)
                        @foreach ($results as $item)
                            <tr>
                                @foreach ($tableCols as $key => $col)
                                    <td>{{ $item->$key }}</td>
                                @endforeach

                                <!-- Table actions: view,edit,delete -->
                                <td>
                                    <form action="{{ $urls['delete'] }}{{ $item->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-task-{{ $item->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                        <button> Edit </button>
                                        <a href="family/view/1"> View </a>
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
