@extends('layout.template')

@section('title', 'Pengajar')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/matakuliah">Mata kuliah</a></li>
                <li class="breadcrumb-item active">pengajar</li>
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
    <div class="alert alert-success">
    {{session('status')}}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Pengajar</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th>NIDN</th>
                                            <th>Kelas</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                        @foreach ($matkul->dosen as $relasi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/dosen/{{$relasi->id}}/profile">{{ $relasi->nidn }}</td>
                                                <td>{{ $relasi->nama }}</td>
                                                <td>{{ $relasi->pivot->kelas}}</td>
                                                    <td>
                                                        {{-- <a href="/matakuliah/{{$relasi->id}}/ubah" class="btn btn-warning">Edit</a> --}}
                                                        <a href="/dosen/{{$relasi->id}}/profile" class="btn btn-primary">Detail</a>
                                                        <form action="/matakuliah/{{ $relasi->id}}/hapus" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Data Ingin Dihapus??')">Delete</button>
                                                        </form>
                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
        </table>                        
    </div>
</div>

@endsection

