@extends('layout.template')

@section('title', 'Edit Tugas')

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
                <li class="breadcrumb-item active">Edit Tugas</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
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
                <div class="card card-warning">
                    <div class="card-header">
                        <strong class="card-title">Edit Tugas</strong>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="/tugas/{{$tugas->id}}/updatefile"  enctype="multipart/form-data">
                        {{-- token keamanan --}}
                        @method('patch')
                        @csrf 

                            <div class="form-group">
                                <label for="matkul">Mata kuliah</label>
                                <select class="form-control @error('txtmatkul') is-invalid @enderror" value="" name="txtmatkul" id="exampleFormControlSelect1">
                                    @foreach($matkul as $mtkuliah)
                                        <option value="{{$mtkuliah->id}}"" @if ($mtkuliah->id == $tugas->matkul_id)
                                            selected
                                        @endif>{{$mtkuliah->nama}}</option>
                                    @endforeach
                                </select>
                                @error('txtmatkul')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                                        {{-- <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select class="form-control @error('txtkelas') is-invalid @enderror" value="{{old('txtkelas')}}" name="txtkelas" id="exampleFormControlSelect1">
                                                @foreach($kelas as $kls)
                                                        <option value="{{$kls->id}}" @if ($kls->id == $tugas->kelas_id)
                                                            selected
                                                        @endif>{{$kls->nama_kelas}}</option>
                                                @endforeach
                                            </select>
                                            @error('txtkelas')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div> --}}

                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control @error('txtkelas') is-invalid @enderror" value="{{old('txtkelas')}}" name="txtkelas" data-placeholder="Pilih Kelas"
                                style="width: 100%;">
                                    <option value="">---Pilih Kelas------</option>
                                        @foreach ($kelas as $kls)                      
                                        <option value="{{$kls->id}}"" @if ($kls->id == $tugas->kelas_id)
                                            selected
                                            @endif>{{$kls->nama_kelas}}</option>                                        
                                        @endforeach
                                </select>                                @error('txtkelas')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class ="form-group">
                                <label for="semester">Semester</label>
                                <select class="form-control @error('txtsemester') is-invalid @enderror" name="txtsemester" id="exampleFormControlSelect1">
                                    <option value="Semester 1" @if ($tugas->semester == 'Semester 1') selected @endif>Semester 1</option>
                                    <option value="Semester 2" @if ($tugas->semester == 'Semester 2') selected @endif>Semester 2</option>
                                    <option value="Semester 3" @if ($tugas->semester == 'Semester 3') selected @endif>Semester 3</option>
                                    <option value="Semester 4" @if ($tugas->semester == 'Semester 4') selected @endif>Semester 4</option>
                                    <option value="Semester 5" @if ($tugas->semester == 'Semester 5') selected @endif>Semester 5</option>
                                    <option value="Semester 6" @if ($tugas->semester == 'Semester 6') selected @endif>Semester 6</option>
                                    <option value="Semester 7" @if ($tugas->semester == 'Semester 7') selected @endif>Semester 7</option>
                                    <option value="Semester 8" @if ($tugas->semester == 'Semester 8') selected @endif>Semester 8</option>
                                    <option value="Semester 9" @if ($tugas->semester == 'Semester 9') selected @endif>Semester 9</option>
                                    <option value="Semester 10" @if ($tugas->semester == 'Semester 10') selected @endif>Semester 10</option>
                                </select>
                                @error('txtsemester')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div> --}}
                            
                            <div class="form-group">
                                <label for="tgl_deadline">Batas Pengerjaan</label>
                                <input type="datetime-local" value="{{Carbon\Carbon::parse($tugas->tanggal_deadline)->format('Y-m-d\TH:i')}}" id="datetimepicker" class="datetimepicker form-control @error('txttgl_deadline') is-invalid @enderror" name="txttgl_deadline">
                                <small>AM = 00.00 - 11.59 <br> PM = 12.00-23.59</small>
                                @error('txttgl_deadline')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="judul">Judul</label><br>
                                <input type="text" value="{{old('txtjudul_tugas', $tugas->judul_tugas)}}" id="judul_tugas" class="form-control @error('txtjudul_tugas') is-invalid @enderror" name="txtjudul_tugas">
                                @error('txtjudul_tugas')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                            </div>
                                        
                            <div class="form-group">
                                <label for="soal">Tugas</label><br>
                                <embed src="{{ asset('file_tugas/' . $tugas->soal_tugas)}}" type="application/pdf" width="800" height="600" >
                            </div>

                            <div class="form-group">
                                <label for="filetugas">Ganti File Tugas</label>
                                <input type="file" name="txtuploadtugas" class="form-control" id="filetugas" value="">
                            </div>                                     
                                        {{-- <a href="/tugas/{{$tugas->id}}/editfile" class="btn btn-warning btn-sm">Edit</a> --}}
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection