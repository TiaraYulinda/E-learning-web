@extends('layout.template')

@section('title', 'Mata kuliah yang di ajar')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dosen">Dosen</a></li>
                <li class="breadcrumb-item active">Mata kuliah</li>
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

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Mata kuliah yang di ajar oleh {{$dosen->nama}}</h2>
        <div class="float-right">
            <a href="/dosen/{{$dosen->id}}/tambahmatakuliah" class="btn btn-primary">Tambah Matakuliah</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th class="text-center">Matakuliah</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                            @foreach ($kelas as $matkul_pivot)                      
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $matkul_pivot->nama }}</td>
                                                    <td class="text-center">{{ $matkul_pivot->semester }}</td>
                                                    <td class="text-center">{{ $matkul_pivot->nama_kelas }}</td>
                                                    <td>
                                                        {{-- <a href="/dosen/{{$matkul_pivot->pivot->id}}/edit" class="btn btn-warning btn-sm">Edit</a> --}}
                                                        <a href="/dosen/{{$matkul_pivot->id}}/hapuspelajaran" class="btn btn-danger btn-sm">Hapus</a>
                                                        {{-- <form action="/dosen/{{ $matkul_pivot->pivot->id}}/hapuspelajaran" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Ingin Dihapus??')">Delete</button>
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
        </table>
    </div>
</div>

@endsection

