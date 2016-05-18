@extends('layouts.admin')

@section('content')
    
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Keluarga {{ $family->name }} 
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
        <!-- Display Notification & Validation Errors -->
        @include('common.errors')
        <div class="col-lg-4"></div>
        <div class="col-lg-4 baseinfo">
            <div class="well well-lg">
                
                        @if (!empty($member))
                            <p> {{ $member->name }} saat ini terdaftar sebagai {{ $role }} dari Keluarga {{ $family->name }}. </p>

                            <div class="dt-media">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="#">
                                          <img class="media-object" src="http://localhost/ifgfbdg/public/img/dan.jpg" alt="..." style="height:150px;width:150px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                    <!-- <h4 class="media-heading">Bapak</h4> -->
                                        <p>Nama: {{ $member->name }}</p>
                                        <p>Umur: XXXXX</p>
                                        <p>iCare: XXXXX</p>
                                   

                                    </div>
                                </div>

                                <p><b>Apakah kamu ingin mendaftarkan member lain sebagai {{ $role }} dari Keluarga {{ $family->name }}?</b></p>
                                <p style="font-style:italic;">Jika iya, klik Next. Jika tidak, klik Cancel untuk kembali ke halaman keluarga.</p> 
                                    <a id="next-step">Next</a>
                                    <a href=" {{ $urls['edit'] }} " class="btn btn-next">Cancel</a>
                            </div>

                            
                        @else
                            <p> Saat ini belum ada member yang didaftarkan sebagai {{ $role }} dari Keluarga {{ $family->name }}.</p>

                            <div class="dt-media">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <!-- <a href="{{ $urls['edit'] }}/{{ $role }}"> -->
                                            <i class="fa fa-user-plus dt-profile" aria-hidden="true"></i>                                        
                                        <!-- </a> -->   
                                    </div>
                                    <div class="media-body">
                                    <!-- <h4 class="media-heading">Bapak</h4> -->
                                        <p>Nama: - </p>
                                        <p>Umur: - </p>
                                        <!-- <p>Nama: XXXXX</p>  -->                                  
                                    </div>
                                </div>

                                <p> Apakah kamu ingin mendaftarkan seorang member sebagai {{ $role }} dari Keluarga {{ $family->name }}? </p>
                                <p style="font-style:italic;">Jika iya, klik Next. Jika tidak, klik Cancel untuk kembali ke halaman keluarga.</p> 
                                    <a id="next-step">Next</a>
                                    <a href=" {{ $urls['edit'] }} " class="btn btn-next">Cancel</a>
                            </div>     

                        @endif

                <!-- <p> Berikut adalah data Bapak dari Keluarga {{ $family->name }} : </p> -->

                
            
                 
                
            </div>
        </div>
        <div class="col-lg-4"></div>

        <div class="col-lg-12">

            <div class="exampletable" style="display:none;">

                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="alert alert-info" role="alert">
                        Gunakan Search box di bawah untuk mencari Member yang diinginkan. Lalu klik tombol 'Pilih Member' dan Update untuk menyimpan pilihan Anda. 
                    </div>
                    <table id="example" class="display" cellspacing="0" width="100%" style="border:1px solid #ddd;" >
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
                                            <!-- <form action="/user/profile/add" method="POST"> -->
                                                <!-- {{ csrf_field() }} -->
                                                <!-- {{ method_field('POST') }} -->
                                                
                                                
                                                
                                                <?php //echo Form::email($name, $value = null, $attributes = []); ?>
                                                <span id="mbr-choice-{{ $item->id }}">
                                                    <a name="mbr_selection" class="btn btn-danger">
                                                    Pilih Member
                                                    </a>
                                                </span>

                                            <!-- </form> -->
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

                    <form action="{{ $urls['save'] }}" method="POST" class="mbr-save-form">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        {{ Form::hidden('_fmid', $family->id) }}
                        {{ Form::hidden('_mbrole', 'father') }}
                        {{ Form::hidden('_mbrid', '') }}
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Update
                        </button>
                    </form>

                </div>
                <div class="col-lg-2"></div>
            </div>
                
                    
                 
                </div>
                <!-- /.col-lg-12 -->
            </div>

    
@endsection
