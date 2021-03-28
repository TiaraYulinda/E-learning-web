@extends('layout.template')

@section('title', 'Kerjakan Tugas')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/tugasmahasiswa/{{$tugas->id}}">Detail Tugas</a></li>
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
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tambah Tugas</strong>
                    </div>
                    
                    <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class ="form-group">
                                        <label for="semester"><b>Soal : </b></label><br>
                                        @if($tugas->tipe == "essay")
                                        <label for="" style="white-space: pre-line;">{{$tugas->soal_tugas}}</label>
                                        @else
                                        <embed src="{{ asset('file_tugas/' . $tugas->soal_tugas)}}" type="application/pdf" width="1000" height="400" >                                            @endif
                                    </div>

                                    <form id="del_id" method="post" action="/tugasmahasiswa/kirimjawaban">
                                        @csrf
                                        <input type="hidden" value="{{$tugas->id}}" name="txttugas_id">
                                        <input type="hidden" value="{{auth()->user()->id}}" name="txtmahasiswa_id" id="">
                                        <input type="hidden" value="essay" name="txttipe">

                                        <div class="form-group">
                                        <label for="jawaban"><b>Judul : </b></label>
                                        <input class="form-control @error('txtjudul') is-invalid @enderror" name="txtjudul" placeholder="Judul">
                                        @error('txtjudul')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="jawaban"><b>Jawaban : </b></label>
                                        <textarea rows="12" class="form-control @error('txtjawaban') is-invalid @enderror" name="txtjawaban" placeholder="Isi Jawaban"></textarea>
                                        @error('txtjawaban')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                        </div>

                                        {{-- <button type="submit" class="btn btn-success" onclick="return confirm('Setelah dikirim data tidak dapat diubah, Yakin ingin mengirim jawaban?')">Kirim Jawaban</button> --}}
                                        <button type="submit" class="btn btn-primary input">Kirim Jawaban</button>

                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection