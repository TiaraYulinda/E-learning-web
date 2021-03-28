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
                <li class="breadcrumb-item"><a href="/materi">Mata kuliah</a></li>
                <li class="breadcrumb-item active">Dosen</li>
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
        <h2 class="card-title">Dosen yang mengajar mata kuliah {{$matkul->nama}}</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th class="text-center">NIDN</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                            @foreach ($dosen as $dosen_pivot)                      
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dosen_pivot->nidn }}</td>
                                                    <td>{{ $dosen_pivot->nama }}</td>
                                                    <td>
                                                        <a href="/dosen/{{$dosen_pivot->matkul_id}}/{{$dosen_pivot->dosen_id}}/materi" class="btn btn-primary btn-sm">Lihat Materi</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
        </table>
    </div>
</div>

@endsection

