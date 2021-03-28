@extends('layout.template')

@section('title', 'Halaman Mahasiswa')

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
                <li class="breadcrumb-item active">Mahasiswa</li>
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
        <h2 class="card-title">Data Mahasiswa</h2>
        <div class="float-right">
            <a href="/mahasiswa/tambahdata" class="btn btn-primary btn-sm">Tambah Data</a>
            {{-- <a href="/mahasiswa/exportpdf" class="btn btn-primary">Laporan PDF</a> --}}
            <a href="/mahasiswa/semester" class="btn btn-primary btn-sm">Laporan PDF</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th>NPM</th>
                                            <th>Nama</th>
                                            {{-- <th>Alamat</th> --}}
                                            <th>Jenis Kelamin</th>
                                            {{-- <th>Agama</th> --}}
                                            <th>Email</th>
                                            <th>No Telpon</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            {{-- <th>Semester</th> --}}
                                            <th>Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                            @foreach ($mahasiswa as $mhs)                      
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="/mahasiswa/{{$mhs->id}}/profile">{{ $mhs->npm }}</a></td>
                                                    <td><a href="/mahasiswa/{{$mhs->id}}/profile">{{ $mhs->nama }}</a></td>
                                                    {{-- <td>{{ $mhs->alamat }}</td> --}}
                                                    <td>{{ $mhs->gender }}</td>
                                                    {{-- <td>{{ $mhs->agama }}</td> --}}
                                                    <td>{{ $mhs->email }}</td>
                                                    <td>{{ $mhs->no_telpon }}</td>
                                                    <td>{{ $mhs->kelas->nama_kelas }}</td>
                                                    <td>{{ $mhs->jurusan }}</td>
                                                    {{-- <td>{{ $mhs->semester }}</td> --}}
                                                    <td>
                                                        <a href="/mahasiswa/{{$mhs->id}}/profile" class="btn btn-primary btn-sm">Detail</a>
                                                        <a href="/mahasiswa/{{$mhs->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                        <form id="del_id" action="/mahasiswa/{{ $mhs->id}}/hapus" method="post" class="d-inline">
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

