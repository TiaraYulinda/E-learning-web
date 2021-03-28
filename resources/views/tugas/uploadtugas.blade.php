@extends('layout.template')

@section('title', 'Tambah Tugas')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/tugas">Tugas</a></li>
                <li class="breadcrumb-item active">Tambah Tugas</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
        <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <strong class="card-title">Tambah Tugas</strong>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="/tugas/uploadtugas"  enctype="multipart/form-data">
                            {{-- token keamanan --}}
                            @csrf 
                            <input type="hidden" value="{{auth()->user()->id}}" name="txtdosen_id" id="">
                            <input type="hidden" value="file" name="txttipe">
                            
                            <div class="form-group">
                                <label for="matkul">Mata kuliah</label>
                                    <select class="form-control @error('txtmatkul') is-invalid @enderror" value="{{old('txtmatkul')}}" name="txtmatkul" id="exampleFormControlSelect1">
                                        <option value="">---Pilih Mata kuliah------</option>
                                            @foreach ($matkul as $matakuliah)                      
                                                <option value="{{$matakuliah->id}}" {{ old('txtmatkul') == $matakuliah->id ? 'selected' : '' }}>{{$matakuliah->nama}}</option>
                                            @endforeach
                                    </select>
                                    @error('txtmatkul')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control @error('txtkelas') is-invalid @enderror" value="{{old('txtkelas')}}" name="txtkelas" data-placeholder="Pilih Kelas"
                                style="width: 100%;">
                                    <option value="">---Pilih Kelas------</option>
                                        @foreach ($kelas as $kls)                      
                                        <option value="{{$kls->id}}" {{ old('txtkelas') == $kls->nama_kelas ? 'selected' : '' }}>{{$kls->nama_kelas}}</option>
                                        @endforeach
                                </select>
                                @error('txtkelas')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- <div class ="form-group">
                                            <label for="semester">Semester</label>
                                            <select class="form-control @error('txtsemester') is-invalid @enderror" name="txtsemester" id="exampleFormControlSelect1">
                                                <option value="">-----Pilih Semester------</option>
                                                <option value="Semester 1" {{ old('txtsemester') == 'Semester 1' ? 'selected' : '' }}>Semester 1</option>
                                                <option value="Semester 2" {{ old('txtsemester') == 'Semester 2' ? 'selected' : '' }}>Semester 2</option>
                                                <option value="Semester 3" {{ old('txtsemester') == 'Semester 3' ? 'selected' : '' }}>Semester 3</option>
                                                <option value="Semester 4" {{ old('txtsemester') == 'Semester 4' ? 'selected' : '' }}>Semester 4</option>
                                                <option value="Semester 5" {{ old('txtsemester') == 'Semester 5' ? 'selected' : '' }}>Semester 5</option>
                                                <option value="Semester 6" {{ old('txtsemester') == 'Semester 6' ? 'selected' : '' }}>Semester 6</option>
                                                <option value="Semester 7" {{ old('txtsemester') == 'Semester 7' ? 'selected' : '' }}>Semester 7</option>
                                                <option value="Semester 8" {{ old('txtsemester') == 'Semester 8' ? 'selected' : '' }}>Semester 8</option>
                                                <option value="Semester 9" {{ old('txtsemester') == 'Semester 9' ? 'selected' : '' }}>Semester 9</option>
                                                <option value="Semester 10" {{ old('txtsemester') == 'Semester 10' ? 'selected' : '' }}>Semester 10</option>
                                            </select>
                                            @error('txtsemester')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                            </div> --}}

                                <div class="form-group">
                                            <label for="tgl_deadline">Deadline</label>
                                            <input type="dateTime-local" value="{{old('txttgl_deadline')}}" id="tgl_deadline" class="datetimepicker form-control @error('txttgl_deadline') is-invalid @enderror" name="txttgl_deadline">
                                            <small>AM = 00.00 - 11.59 <br> PM = 12.00-23.59</small>
                                            @error('txttgl_deadline')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                </div>

                                <div class="form-group">
                                            <label for="judul_tugas">Judul</label>
                                            <input type="text" value="{{old('txtjudul_tugas')}}" id="judul_tugas" class="form-control @error('txtjudul_tugas') is-invalid @enderror" name="txtjudul_tugas" placeholder="Masukkan Judul Tugas">
                                            @error('txtjudul_tugas')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                </div>

                                <div class="form-group">
                                            <label for="up_tugas">File Tugas</label>
                                            <input type="file" name="txtuploadtugas" class="form-control @error('txtuploadtugas') is-invalid @enderror" id="up_tugas" value="{{old('txtuploadtugas')}}">
                                            @error('txtuploadtugas')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                </div>
                
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection