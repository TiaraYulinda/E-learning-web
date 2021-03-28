@extends('layout.template')

@section('title', 'Data Admin')

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
                <li class="breadcrumb-item active">Admin</li>
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

<section class="content">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
        <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Admin yang masuk</strong>
                        <div class="float-right">
                            <a href="/admin_/tambah" class="btn btn-primary">Tambah Admin</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="npm" class="col-sm-4 col-form-label">Username</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{auth()->user()->username}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">Nama</label>
                                            <label for="npm" class="col-form-label">:</label>
                                            <label for="npm" class="col-sm-7 col-form-label">{{auth()->user()->name}}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group row">
                                            <label for="npm" class="col-sm-4 col-form-label">E-mail</label>
                                            <label for="npm" class="col-form-label">:</label> 
                                            <label for="npm" class="col-sm-7 col-form-label">{{auth()->user()->email}}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm 12">
                                        <div class="form-group">
                                            <a href="gantipassword" class="btn btn-warning">Ganti Password</a>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Semua Admin</strong>
                        {{-- <div class="float-right">
                            <a href="/tugas/{{ $tugas->id }}/jawabanpdf" class="btn btn-primary btn-sm">Laporan</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>E-mail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach ($user as $usr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usr->username }}</td>
                                    <td>{{ $usr->name }}</td>                                            
                                    <td>{{ $usr->email }}</td>                                            
                                    <td>
                                        <a href="/admin_/{{$usr->id}}/edit" class="btn btn-primary btn-md">Edit</a>
                                        <form id="del_id" action="//admin_/{{ $usr->id}}/hapus" method="post" class="d-inline">
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

