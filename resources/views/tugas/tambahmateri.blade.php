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
                <li class="breadcrumb-item"><a href="/tugas">Materi</a></li>
                <li class="breadcrumb-item active">Tambah Materi</li>
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
                        <strong class="card-title">Tambah Materi</strong>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="/uploadmateri"  enctype="multipart/form-data">
                            {{-- token keamanan --}}
                            @csrf 
                            <input type="hidden" value="{{auth()->user()->dosen->id}}" name="txtdosen_id" id="">
                            <input type="hidden" value="{{$matkul->id}}" name="txtmatkul_id" id="">
                                
                            {{-- <div class="form-group">
                                            <label for="judul_tugas">Judul</label>
                                            <input type="text" value="{{old('txtjudul_tugas')}}" id="judul_tugas" class="form-control @error('txtjudul_tugas') is-invalid @enderror" name="txtjudul_tugas" placeholder="Masukkan Judul Tugas">
                                            @error('txtjudul_tugas')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                            </div> --}}

                                <div class="form-group">
                                            <label for="up_tugas">File Materi</label>
                                            <input type="file" name="txtmateri[]" multiple class="form-control @error('txtmateri') is-invalid @enderror" id="up_tugas" value="{{old('txtmateri')}}">
                                            
                                            @error('txtmateri')
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