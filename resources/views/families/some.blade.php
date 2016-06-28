@extends('layouts.admin')

<!-- @section('content') -->
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Keluarga {{ $family->name }} > Bapak
            </h1>
           <!--  <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol> -->
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Bapak {{ $title['singular'] }} 
                </div>

                <div class="panel-body">

                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    

                    
                
                    <div class="row">
                        <div class="col-sm-12 form-box">
                            
                            <!-- Add Member Form -->
                            <form role="form" action="/ifgfbdg/public/member/add" method="POST" class="registration-form">
                                {{ csrf_field() }}

                                <fieldset>
                                    
                                    <div class="form-bottom">
                                        

                                         <div class="form-group">

                                            

                                            <table id="example" class="display" cellspacing="0" width="100%" style="border:1px solid black;">
                                        <!-- <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%" > -->
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
                                                                <td>{{ $item->$key }}</td>
                                                            @endforeach

                                                            <!-- Table actions: view,edit,delete -->
                                                            <td>
                                                                <form action="/user/profile/add" method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('POST') }}
                                                                    {{ Form::hidden('_familyrole', 'father') }}
                                                                    {{ Form::hidden('_memberkey', $item->id) }}
                                                                    
                                                                    <?php //echo Form::email($name, $value = null, $attributes = []); ?>
                                                                    <a name="family-father-role" id="father-{{ $item->id }}" class="btn btn-danger">
                                                                        Pilih
                                                                    </a>
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


                                                <p> Nama Bapak </p>
                                                <div class="info"></div>
                                        </div>

                                        <button type="button" class="btn btn-next">Next</button>
                                    </div>

                                </fieldset>
                                
                                <fieldset>
                                    <div class="form-top">
                                        <div class="form-top-left">
                                            <h1> Step 2 / 3: Bapak & Ibu </h1> 
                                            <h4>Silakan memilih nama <b>Bapak</b> dari daftar member di tabel bawah. Gunakan search box di kanan untuk mempermudah pencarian.</h4>
                                        </div>
                                    </div>
                                    <div class="form-bottom">
                                                                               
                                        <div class="form-group">

                                            <table id="example" class="display" cellspacing="0" width="100%">
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
                                                                        <td>{{ $item->$key }}</td>
                                                                    @endforeach

                                                                    <!-- Table actions: view,edit,delete -->
                                                                    <td>
                                                                        <form action="/user/profile/add" method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('POST') }}
                                                                            {{ Form::hidden('_familyrole', 'father') }}
                                                                            {{ Form::hidden('_memberkey', $item->id) }}
                                                                            
                                                                            <?php //echo Form::email($name, $value = null, $attributes = []); ?>
                                                                            <a name="family-father-role" id="father-{{ $item->id }}" class="btn btn-danger">
                                                                                Select
                                                                            </a>
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

                                                <p> Nama Bapak </p>
                                                <div class="info"></div>
                                        </div>

                                        <button type="button" class="btn btn-previous">Previous</button>
                                        <button type="button" class="btn btn-next">Next</button>
                                    </div>
                                </fieldset>
                                
           
                                <fieldset>
                                    <div class="form-top">
                                        <div class="form-top-left">
                                            <h1> Step 3 / 3: Anak-anak </h1> 
                                            <h4>Silakan memilih nama <b>Bapak</b> dari daftar member di tabel bawah. Gunakan search box di kanan untuk mempermudah pencarian.</h4>
                                        </div>
                                    </div>
                                    <div class="form-bottom">
                                                                               
                                        <div class="form-group">

                                            <!-- <table id="example2" class="display" cellspacing="0" width="100%"> -->
                                            <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border:1px solid black;">
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
                                                                        <td>{{ $item->$key }}</td>
                                                                    @endforeach

                                                                    <!-- Table actions: view,edit,delete -->
                                                                    <td>
                                                                        <form action="{{ $urls['delete'] }}{{ $item->id }}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('POST') }}

                                                                            <button type="submit" name="family-father-{{ $item->id }}" class="form-father-{{ $item->id }}" class="btn btn-danger">
                                                                                Select
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

                                        <button type="button" class="btn btn-previous">Previous</button>
                                        <button type="submit" class="btn">Sign me up!</button>
                                    </div>
                                </fieldset>                            
                            </form>
                            <!-- /form -->
                        </div>
                    </div>

                                <!-- /.row (nested) -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

    
<!-- @endsection -->
