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
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
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
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="npm" class="col-sm-4 col-form-label">Mata kuliah</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->matkul->nama}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Judul</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="" class="col-sm-7 col-form-label" style="white-space: pre-line;">{{($tugas->judul_tugas)}}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Tanggal Deadline</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{$tugas->tanggal_deadline}}</label>
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
                                            @if($tugas->tipe == "essay")
                                            <label for="" style="white-space: pre-line;">{{($tugas->soal_tugas)}}</label>
                                            @else
                                            <embed src="{{ asset('file_tugas/' . $tugas->soal_tugas)}}" type="application/pdf" width="1000" height="400">
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


                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tugas Mahasiswa</strong>
                        <div class="float-right">
                            <a href="/tugas/{{ $tugas->id }}/jawabanpdf" class="btn btn-primary btn-sm">Laporan</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Judul</th>
                                    <th>Di kirim</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach ($jawaban as $jwb)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="/tugas/{{ $jwb->id}}">{{ $jwb->user->mahasiswa->npm }}</td>
                                    <td><a href="/tugas/{{ $jwb->id}}">{{ $jwb->user->mahasiswa->nama }}</td>
                                    <td><a href="/tugas/{{ $jwb->id}}">{{ $jwb->user->mahasiswa->kelas->nama_kelas }}</td>
                                    <td><a href="/tugas/{{ $jwb->id}}">{{ $jwb->judul }}</td>
                                    <td><a href="/tugas/{{ $jwb->id}}">{{ Carbon\Carbon::parse($jwb->created_at)->format('d F Y H:i') }}</td>
                                    <td>{{$jwb->status == 1 ? 'Sudah dibaca':'Belum dibaca'}}</td>                                                
                                    <td>
                                        @if ($jwb->status == 1)
                                        <a href="/tugas/{{ $jwb->id}}/jawaban" class="btn btn-success">Lihat Jawaban</a>
                                        @else
                                        <a href="/tugas/{{ $jwb->id}}/jawaban" class="btn btn-info">Lihat Jawaban</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


@endsection

