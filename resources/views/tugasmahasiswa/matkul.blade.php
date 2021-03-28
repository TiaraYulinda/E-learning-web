@extends('layout.template')

@section('title', 'Tugas yang sudah dikerjakan')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Mata kuliah</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@if(count($errors) > 0)
    <div class="alert alert-danger">
        Pesan Kesalahan<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Mata kuliah</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th>Matakuliah</th>
                                            <th>Semester</th>
                                            <th>Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                        @foreach ($matkul as $mtkl)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mtkl->nama }}</td>
                                                <td>{{ $mtkl->semester }}</td>
                                                <td>
                                                    <a href="/tugasmahasiswa/{{$mtkl->id}}/dosen" class="btn btn-info">Lihat Dosen</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
    
    </div>
</div>

@endsection

