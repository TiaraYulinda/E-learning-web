@extends('layout.template')

@section('title', 'Jawaban Tugas')


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/tugas/{{$jawaban->tugas->id}}/detail">Tugas Detail</a></li>
                <li class="breadcrumb-item active">Tugas Mahasiswa</li>
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
                        <strong class="card-title">Tugas Saya</strong>
                    </div>
                    
                    <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if ($jawaban->tugas->tipe == 'essay')
                                    <div class ="form-group">
                                        <label for="semester"><b>Soal : </b></label><br>
                                        <label for="" style="white-space: pre-line;">{{($jawaban->tugas->soal_tugas)}}</label>
                                    </div>
                                    @else
                                    <div class ="form-group">
                                        <label for="semester"><b>Soal : </b></label><br>
                                        <embed src="{{ asset('file_tugas/' . $jawaban->tugas->soal_tugas)}}" type="application/pdf" width="1000" height="400" >
                                        </div>
                                    <hr>
                                    @endif
                                    <div class="form-group">
                                        <label for="jawaban"><b>Jawaban : </b></label><br>
                                        @if ($jawaban->tipe == 'essay')
                                        <label for="" style="white-space: pre-line;">{{($jawaban->jawaban)}}</label>
                                        @else
                                        <embed src="{{ asset('file_jawaban/' . $jawaban->jawaban)}}" type="application/pdf" width="1000" height="700" >
                                        @endif
                                    </div>

                                    <a href="/tugasmahasiswa/jawaban" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection