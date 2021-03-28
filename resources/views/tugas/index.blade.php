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
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Tugas</li>
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
        <h2 class="card-title">Tugas</h2>
        <div class="float-right" role="alert">
            <a href="/tugas/{{auth()->user()->dosen->id}}/tambah" class="btn btn-primary btn-sm">Tambah Tugas</a>
            <a href="/tugas/{{auth()->user()->dosen->id}}/upload" class="btn btn-primary btn-sm">Upload Tugas</a>
        </div>
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
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>  
            @foreach ($tugas as $tgs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/tugas/{{$tgs->id}}/detail">{{ $tgs->matkul->nama }}</td>
                    <td class="text-center"><a href="/tugas/{{$tgs->id}}/daftarmahasiswa">
                        {{ $tgs->kelas->nama_kelas }}</td>
                    <td>{{ $tgs->judul_tugas }}</td>
                    <td>{{ Carbon\Carbon::parse($tgs->tanggal_deadline)->format('d F Y H:i') }}</td>
                    <td>{{$tgs->status_tugas == 1 ? 'Masa Pengerjaan':'Berakhir'}}</td>
                    <td>
                        <a href="/tugas/{{$tgs->id}}/detail" class="btn btn-info">Detail</a>
                        @if ($tgs->tipe == 'essay')
                            <a href="/tugas/{{$tgs->id}}/edit" class="btn btn-warning">Edit</a>
                            @else
                            <a href="/tugas/{{$tgs->id}}/editfile" class="btn btn-warning">Edit</a>
                        @endif

                        <form id="del_id" action="/tugas/{{ $tgs->id}}/hapus" method="post" class="d-inline">
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

