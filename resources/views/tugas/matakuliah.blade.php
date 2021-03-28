@extends('layout.template')

@section('title', 'Daftar Dosen')

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

@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Mata Kuliah Yang diambil oleh {{$dosen->nama}}</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Matakuliah</th>
                    <th class="text-center">Semester</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>  
                @foreach ($kelas as $matkul_pivot)                      
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $matkul_pivot->nama }}</td>
                        <td class="text-center">{{ $matkul_pivot->semester }}</td>
                        <td class="text-center">{{ $matkul_pivot->nama_kelas }}</td>
                        <td>
                            <a href="/matkul/{{$matkul_pivot->id}}/tugas" class="btn btn-primary btn-md">Tugas</a>
                            <a href="/matkul/{{$matkul_pivot->id}}/materi" class="btn btn-warning btn-md">Materi</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

