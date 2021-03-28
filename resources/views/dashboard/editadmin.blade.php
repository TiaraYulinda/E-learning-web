@extends('layout.template')

@section('title', 'Edit Admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active">Edit Admin</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
        <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edit Admin</strong>
                    </div>
                    
                    <div class="card-body card-block">
                        <form method="post" action="/admin_/{{$user->id}}/update">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="passlama" class="col-md-4 col-form-label text-md-right">Username</label>
                                <div class="col-md-6 @error('txtusername') is-invalid @enderror">
                                    <input id="passlama" value="{{old('txtusername', $user->username)}}" type="text" name="txtusername" class="form-control @error('txtusername') is-invalid @enderror">
                                    @error('txtusername')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="passbaru" class="col-md-4 col-form-label text-md-right">Nama</label>
                                <div class="col-md-6">
                                    <input id="passbaru" value="{{old('txtnama', $user->name)}}" type="text" name="txtnama" class="form-control @error('txtnama') is-invalid @enderror">
                                    @error('txtnama')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passbaru" class="col-md-4 col-form-label text-md-right">E-mail</label>
                                <div class="col-md-6">
                                    <input id="passbaru" value="{{old('txtemail', $user->email)}}" type="text" name="txtemail" class="form-control @error('txtemail') is-invalid @enderror">
                                    @error('txtemail')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="konfirmasipass" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="konfirmasipass" type="password" name="txtpassword" class="form-control @error('txtpassword') is-invalid @enderror">
                                    @error('txtpassword')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection