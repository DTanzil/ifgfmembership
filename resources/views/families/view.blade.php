@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Data {{ $title['singular'] }} {{ $family->name }}
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Anggota {{ $title['singular'] }} 
                </div>

                <div class="panel-body">

                    <!-- Display Validation Errors -->
                    @include('common.errors')
                            
                    <div class="row">

                        <div class="col-sm-6 form-box">                            
                            <div class="testpic">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="#">
                                          <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                    <h4 class="media-heading">Bapak</h4>
                                    <p>Nama: XXXXX</p>
                                    <p>Nama: XXXXX</p>
                                    <p>Nama: XXXXX</p>

                                    <button type="button" class="btn btn-next">Edit</button>
                                    <a href=" {{ $urls['edit'] }} " class="btn btn-next">Ganti</a>

                                    </div>
                                </div>
                            </div>                                    
                                
                            <p> Apabila anda ingin mengedit/menambah anggota keluarga, klik tombol Next di bawah </p>
                            <button type="button" class="btn btn-next">+ Tambah Anak</button>
                        </div>

                        <div class="col-sm-6 form-box">
                            <div class="testpic">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="#">
                                          <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                    <h4 class="media-heading">Bapak</h4>
                                    <p>Nama: XXXXX</p>
                                    <p>Nama: XXXXX</p>
                                    <p>Nama: XXXXX</p>
                                    </div>
                                </div>
                            </div>
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

    
@endsection
