@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Add {{ $title['singular'] }} 
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Family
                </div>

                <div class="panel-body">

                    <!-- Display Validation Errors -->
                    @include('common.errors')
                            
                    <div class="row">
                        <div class="col-sm-8 form-box">
                            
                            <!-- Add Member Form -->
                            <form role="form" action="{{ $urls['add'] }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}

                                <fieldset>
                                    <div class="form-top">
                                        <div class="form-top-left">
                                            <!-- <h1> Informasi Keluarga </h1>  -->
                                        </div>
                                        
                                    </div>
                                    <div class="form-bottom">
                                        <div class="form-group">
                                            <!-- <label>Nama Keluarga</label> -->
                                            <!-- <input type="text" name="name" class="form-control" value="{{ old('username') }}"> -->
                                        </div>
                                        <p> Tulis nama keluarga di kolom di bawah: </p>
                                        <div class="form-group input-group">

                                            <span class="input-group-addon">Keluarga</span>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nama Keluarga">
                                        </div>
                                        <!-- <button type="button" class="btn btn-next">Next</button> -->
                                    </div>

                                </fieldset>
                                
                               
                                <!-- <button type="button" class="btn btn-previous">Previous</button> -->
                                <button type="submit" class="btn">Submit</button>
 
                            </form>
                            <!-- /form -->
                        </div>
                    </div>                            
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
@endsection
