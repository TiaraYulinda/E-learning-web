@extends('layout.template')

@section('title', 'Detail Tugas')


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
                <li class="breadcrumb-item active">Detail Tugas</li>
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
                        <strong class="card-title">Detail Tugas</strong>
                    </div>
                    <div class="card-body">
                        <div id="bootstrap-data-table-export_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if ($tugas->tipe == 'essay')
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Dosen</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->user->dosen->nama}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Mata kuliah</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->matkul->nama}}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Tanggal Deadline</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d F Y, H:i')}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Kelas</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->kelas->nama_kelas}}</label>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm 12">
                                        <div class="form-group">
                                            <label for=""><b>Soal : </b></label><br>
                                            <label for="" style="white-space: pre-line;">{{($tugas->soal_tugas)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-sm 12 ">
                                        <a href="/tugasmahasiswa/{{ $tugas->id }}/kerjakantugas" class="btn btn-success">Kerjakan Tugas</a>
                                        <a href="/tugasmahasiswa/{{ $tugas->id }}/uploadjawaban" class="btn btn-primary">Upload Jawaban</a>
                                    </div>
                                
                                    @else                                
                                    <div class="col-sm-7">
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Dosen</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->user->dosen->nama}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Mata kuliah</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->matkul->nama}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Tanggal Deadline</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d F Y, H:i')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        {{-- <div class="form-group row">
                                            <label for="npm" class="col-sm-3 col-form-label">Semester</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-8 col-form-label">{{$tugas->semester}}</label>
                                        </div> --}}
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-3 col-form-label">Kelas</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-8 col-form-label">{{$tugas->kelas->nama_kelas}}</label>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm 12">
                                        <div class="form-group">
                                            <label for="soal">Soal</label><br>
                                            <embed src="{{ asset('file_tugas/' . $tugas->soal_tugas)}}" type="application/pdf" width="100%" height="700" >
                                        </div>
                                        <a href="/tugasmahasiswa/{{ $tugas->id}}/kerjakantugas" class="btn btn-success">Kerjakan Tugas</a>
                                        <a href="/tugasmahasiswa/{{ $tugas->id}}/uploadjawaban" class="btn btn-primary">Upload Jawaban</a>
                                    </div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection