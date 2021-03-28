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
                <li class="breadcrumb-item"><a href="/mahasiswa">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Laporan</li>
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

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
        <!-- left column -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Laporan</h2>
                        <div class="float-right">
                            <a href="/mahasiswa/exportpdf" class="btn btn-primary">All</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="row justify-content-center">
                        <div class="card-body col-8">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead class="text-center">
                                    <tr>
                                                                <th>#</th>
                                                                <th>Semester</th>
                                                                <th>Aksi</th>
                                    </tr>
                                </thead>
    
                                                            <tbody class="text-center">  
                                                                <tr>
                                                                    @for ($i = 1; $i <= 10; $i++)                      
                                                                    <td>{{ $i }}</td>
                                                                        <td>Semester {{$i}}</td>
                                                                        <td>
                                                                            <a href="/mahasiswa/{{$i}}/exportpdf" class="btn btn-warning btn-sm">Cetak</a>
                                                                            {{-- <a href="/mahasiswa/{{$mhs->id}}/hapus" class="delete btn btn-danger btn-sm" mahasiswa_id="{{$mhs->id}}">Hapus</a>  --}}
                                                                        </td>
                                                                    </tr>
                                                                @endfor
                                                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

