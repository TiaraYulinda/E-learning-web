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
                <li class="breadcrumb-item"><a href="/Matakuliah">Mata Kuliah</a></li>
                <li class="breadcrumb-item active">Materi</li>
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
        <h2 class="card-title">Materi Untuk Mata kuliah {{$matkul->nama}}</h2>
        <div class="float-right" role="alert">
            <a href="/matkul/{{$matkul->id}}/tambahmateri" class="btn btn-primary btn-sm">Tambah Materi</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Materi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>  
                @foreach ($materi as $mtr)                      
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $mtr->materi }}</td>
                        <td>
                            <a href="/file_materi/{{$mtr->materi}}" download="{{$mtr->materi}}" class="btn btn-primary btn-md">Download</a>
                            <form id="del_id" action="/materi/{{ $mtr->id}}/hapus" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger delete_type">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

