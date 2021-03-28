@extends('layout.template')

@section('title', 'Halaman Mata kuliah')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
@if (session('status'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
    {{session('status')}}     
</div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Mata kuliah</h2>
        <div class="float-right">
            <a href="/matakuliah/tambah" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Semester</th>
                                            <th>Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                            @foreach ($matkul as $matakuliah)                      
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="/matakuliah/{{$matakuliah->id}}/pengajar">{{ $matakuliah->kode }}</a></td>
                                                    <td><a href="/matakuliah/{{$matakuliah->id}}/pengajar">{{ $matakuliah->nama }}</a></td>
                                                    <td>{{ $matakuliah->semester }}</td>
                                                    <td>
                                                        <a href="/matakuliah/{{$matakuliah->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                        {{-- <a href="/mahasiswa/{{$matakuliah->id}}/hapus" class="delete btn btn-danger btn-sm" mahasiswa_id="{{$matakuliah->id}}">Hapus</a>  --}}
                                                        <form id="del_id" action="/matakuliah/{{ $matakuliah->id}}/hapus" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm delete_type">Delete</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
        </table>                            
    </div>
</div>

@endsection

