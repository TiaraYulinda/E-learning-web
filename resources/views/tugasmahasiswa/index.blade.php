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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tugas</li>
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

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tugas</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>#</th>
                <th>Dosen</th>
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
                    <td><a href="/dosen/{{$tgs->user->id}}/tugas">{{ $tgs->user->dosen->nama }}</td>
                    <td><a href="/tugasmahasiswa/{{ $tgs->id}}">{{ $tgs->matkul->nama }}</td>
                    <td class="text-center"><a href="/tugasmahasiswa/{{ $tgs->id}}">{{ $tgs->kelas->nama_kelas }}</td>
                    <td>{{ $tgs->judul_tugas }}</td>
                    {{-- <td>{{ $tgs->tanggal_deadline }}</td> --}}
                    <td>{{ Carbon\Carbon::parse($tgs->tanggal_deadline)->format('d F Y H:i') }}</td>
                    <td>
                        @if ($tgs->tipe == 'essay')
                            <a href="/tugasmahasiswa/{{$tgs->id}}" class="btn btn-primary">Detail</a>
                            @else
                            <a href="/tugasmahasiswa/{{$tgs->id}}" class="btn btn-primary">Detail file</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>                    
    </div>
</div>

    
@endsection

