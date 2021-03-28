@extends('layout.template')

@section('title', 'Ganti Password')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/myprofile">Profile</a></li>
                <li class="breadcrumb-item active">Ganti Password</li>
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
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
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
                        <strong class="card-title">Ganti Password</strong>
                    </div>
                    
                    <div class="card-body card-block">
                        <form method="post" action="/gantipassword">
                            @csrf

                            <div class="form-group row">
                                <label for="passlama" class="col-md-4 col-form-label text-md-right">Password Lama</label>
                                <div class="col-md-6 @error('txtpasslama') is-invalid @enderror">
                                    <input id="passlama" value="{{old('txtpasslama')}}" type="password" name="txtpasslama" class="form-control @error('txtpasslama') is-invalid @enderror">
                                    @error('txtpasslama')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="passbaru" class="col-md-4 col-form-label text-md-right">Password Baru</label>
                                <div class="col-md-6">
                                    <input id="passbaru" type="password" name="txtpassbaru" class="form-control @error('txtpassbaru') is-invalid @enderror">
                                    @error('txtpassbaru')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="konfirmasipass" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>
                                <div class="col-md-6">
                                    <input id="konfirmasipass" type="password" name="txtkonfirmasi" class="form-control @error('txtkonfirmasi') is-invalid @enderror">
                                    @error('txtkonfirmasi')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Ganti
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