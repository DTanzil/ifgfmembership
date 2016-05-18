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
            <!-- Display Validation Errors -->
            @include('common.errors')

            <div class="panel panel-default">
                <div class="panel-heading">
                    Anggota {{ $title['singular'] }} 
                </div>

                <div class="panel-body">

                    
                            
                    <div class="row">
                        
                        @foreach ($order as $role)

                            @if (isset($members[$role]) && count($members[$role]) >= 1)
                                @foreach ($members[$role] as $member)
                                    <!-- <p>I have one or more {{ $member->name }} records!</p> -->

                                    <div class="col-lg-6 col-sm-12 form-box">
                                        <div class="dt-media">
                                            <div class="media">
                                                <div class="media-left media-middle">
                                                    <a href="{{ $urls['edit'] }}/{{ $role }}">
                                                      <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                <h4 class="media-heading">{{ $role }} </h4>
                                                <p>Nama: {{ $member->name }}</p>
                                                <p>Umur: XXXXX</p>
                                                <p>Gender: {{ $member->gender }}</p>
                                                <p>iCare: XXXXX</p>

                                                <a href="">Edit</a>
                                                <a href="{{ $urls['edit'] }}/{{ $role }}" class="btn ">Ganti</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <!-- <p>Skip {{ $role }}</p> -->
                                
                                <div class="col-lg-6 col-sm-12 form-box">
                                    <div class="dt-media">
                                        <div class="media">
                                            <div class="media-left media-middle">
                                                <a href="{{ $urls['edit'] }}/{{ $role }}">
                                                    <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>
                                                
                                                  <!-- <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;"> -->
                                                </a>
                                            </div>

                                            <div class="media-body">
                                            <h4 class="media-heading">{{ $role }} </h4>
                                            <p>Nama: XXXXXXXXXX</p>
                                            <p>Nama: XXXXXXXXXX</p>
                                            <p>Nama: XXXXXXXXXX</p>
                                            <p>Nama: XXXXXXXXXX</p>
                                            <a href="">Edit</a>
                                            <a href="{{ $urls['edit'] }}/{{ $role }}" class="btn ">Ganti</a>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach

                </div>
                    <!-- /.row (nested) -->                   
                    <p> Apabila anda ingin mengedit/menambah anggota keluarga, klik tombol Next di bawah </p>
                    <button type="button" class="btn btn-next">+ Tambah Anak</button>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
@endsection
