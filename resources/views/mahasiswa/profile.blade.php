@extends('layout.template')

@section('title', 'Profile Mahasiswa')

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
                <li class="breadcrumb-item active">Profile Mahasiswa</li>
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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <strong class="card-title">My Profile</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 pl-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img class="img-fluid img-responsive"
                                            src="{{$mahasiswa->getFotoProfile()}}"
                                            alt="User profile picture"><hr>
                                        <h3 class="profile-username text-center">{{$mahasiswa->nama}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 pl-5">
                                <form action="/mahasiswa/{{$mahasiswa->id}}/update" method="post" enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">NPM</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->npm}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Nama</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->nama}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Alamat</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->alamat}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->gender}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Agama</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->agama}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->tempat_lahir}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{ Carbon\Carbon::parse($mahasiswa->tgl_lahir)->format('d F Y') }}</label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Email</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->email}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">No Telpon</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->no_telpon}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Kelas</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->kelas->nama_kelas}}</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Jurusan</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->jurusan}}</label>
                                    </div>
                            
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 col-form-label">Semester</label>
                                        <label for="npm" class="col-form-label">:</label>
                                        <label for="npm" class="col-sm-8 col-form-label">{{$mahasiswa->semester}}</label>
                                    </div>
                    
                                    <a href="/mahasiswa/{{$mahasiswa->id}}/edit" class="btn btn-warning btn-md btn-block">Edit</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection