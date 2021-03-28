@extends('layout.template')

@section('title', 'Tambah Data Tugas')


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
                        <form method="post" action="/tugas/tambahtugas"  enctype="multipart/form-data">
                            {{-- token keamanan --}}
                            @csrf                            
                            <input type="hidden" value="{{auth()->user()->id}}" name="txtdosen_id" id="">
                            <input type="hidden" value="essay" name="txttipe">
                                        
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
                                <select class="form-control select2 @error('txtkelas') is-invalid @enderror" value="{{old('txtkelas')}}" name="txtkelas[]" multiple="multiple" data-placeholder="Pilih Kelas"
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
                                <label for="judul">Judul</label>
                                <input type="text" value="{{old('txtjudul')}}" class="form-control @error('txtjudul') is-invalid @enderror" name="txtjudul" id="judul" placeholder="Masukkan judul">
                                @error('txtjudul')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                                        
                            <div class="form-group">
                                <label for="soal">Soal</label>
                                <textarea name="txtsoal" value="" id="" rows="3" class="form-control @error('txtsoal') is-invalid @enderror" name="txtsoal" placeholder="Masukkan Soal" style="white-space: pre-line;">{{old('txtsoal')}}</textarea>
                                @error('txtsoal')
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