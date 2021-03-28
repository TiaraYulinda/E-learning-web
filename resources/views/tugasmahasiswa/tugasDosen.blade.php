@extends('layout.template')

@section('title', 'Daftar Tugas')

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
                <li class="breadcrumb-item active">Tugas Dosen</li>
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
        <strong class="card-title">Dosen</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-7">
                <div class="form-group row">
                    <label for="npm" class="col-sm-4 col-form-label">Nama</label>
                            <label for="npm" class="col-form-label">:</label>
                            <label for="npm" class="col-sm-7 col-form-label">{{$dosen->nama}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="npm" class="col-sm-4 col-form-label">Email</label>
                            <label for="npm" class="col-form-label">:</label>
                            <label for="" class="col-sm-7 col-form-label" style="white-space: pre-line;">{{($dosen->email)}}</label>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group row">
                            <label for="npm" class="col-sm-4 col-form-label">No telpon</label>
                            <label for="npm" class="col-form-label">:</label>
                            <label for="npm" class="col-sm-7 col-form-label">{{$dosen->no_telpon}}</label>
                        </div>
                    </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tugas dari dosen {{ $user->dosen->nama }}</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Matakuliah</th>
                    <th>Kelas</th>
                    <th>Judul</th>
                    <th>Tanggal Deadline</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>  
            @foreach ($tugas as $tgs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/tugas/{{$tgs->id}}/detail">{{ $tgs->matkul->nama }}</td>
                    <td class="text-center"><a href="/tugas/{{$tgs->id}}/daftarmahasiswa">{{ $tgs->kelas }}</td>
                    <td>{{ $tgs->judul_tugas }}</td>
                    <td>{{ Carbon\Carbon::parse($tgs->tanggal_deadline)->format('d F Y H:i') }}</td>
                    <td>
                        <a href="/tugas/{{$tgs->id}}/detail" class="btn btn-info">Detail</a>
                        @if ($tgs->tipe == 'essay')
                            <a href="/tugas/{{$tgs->id}}/edit" class="btn btn-warning">Edit</a>
                            @else
                            <a href="/tugas/{{$tgs->id}}/editfile" class="btn btn-warning">Edit</a>
                        @endif

                        <form action="/tugas/{{ $tgs->id}}/hapus" method="post" class="d-inline">
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

