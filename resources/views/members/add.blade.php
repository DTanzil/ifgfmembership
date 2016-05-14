@extends('layouts.admin')

@section('content')
    <div class="container">
        
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary "><i class="fa fa-btn fa-plus"></i>Add People</button>
        </div>


        <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Member
                        </div>
                        <div class="panel-body">

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- Add Member Form -->
                            <form role="form" action="/ifgfbdg/public/member/add" method="POST">
                            {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('username') }}">
                                            <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Email</label>
                                            <!-- <input class="form-control" placeholder="Email"> -->
                                            <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">

                                        </div>

                                        <div class="form-group">
                                            <label>Hp/Telpon</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Phone">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" name="dob" class="form-control" value="{{ old('dob') }}" placeholder="DOB">
                                        </div>

                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="male" {{ (old('isFemale')) ? '' : 'checked' }} >Laki-laki
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="female" {{ (old('isFemale')) ? 'checked' : '' }} >Perempuan
                                            </label>
                                            
                                        </div>

                                       <div class="form-group">
                                            <label>Status</label>
                                            <label class="radio-inline">
                                               <input type="radio" name="status" value="single" {{ (old('isMarried')) ? '' : 'checked' }} >Single
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="married" {{ (old('isMarried')) ? 'checked' : '' }} >Menikah
                                            </label>
                                        </div>


                                       <!--  <div class="form-group">
                                            <label>Member?</label>
                                            <p class="form-control-static">Yes</p>
                                        </div> -->

                                        <div class="form-group">
                                            <label>Lulus Engage?</label>
                                            <select class="form-control">
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Keluarga:</label>
                                            <p class="form-control-static">XXXXXX</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Ministry</label>
                                            <select multiple class="form-control">
                                                <option>Worship</option>
                                                <option>Kids</option>
                                                <option>Comm</option>
                                                <option>Ushers</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    
                                    </div>
                                    

                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input class="form-control" placeholder="DOB">
                                        </div>

                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input class="form-control" placeholder="DOB">
                                        </div>

                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control">
                                                <option>Jabar</option>
                                                <option>Blabla</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>PO Box</label>
                                            <input class="form-control" placeholder="DOB">
                                        </div>


                                        <h1>Upload Picture</h1>

                                        <div class="form-group">
                                            <label>File input</label>
                                            <input type="file">
                                        </div>

                                        <!-- <form role="form">
                                            <div class="form-group has-success">
                                                <label class="control-label" for="inputSuccess">Input with success</label>
                                                <input type="text" class="form-control" id="inputSuccess">
                                            </div>
                                            <div class="form-group has-warning">
                                                <label class="control-label" for="inputWarning">Input with warning</label>
                                                <input type="text" class="form-control" id="inputWarning">
                                            </div>
                                            <div class="form-group has-error">
                                                <label class="control-label" for="inputError">Input with error</label>
                                                <input type="text" class="form-control" id="inputError">
                                            </div>
                                        </form> -->
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </form>
                            <!-- /form -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

    </div>
@endsection
