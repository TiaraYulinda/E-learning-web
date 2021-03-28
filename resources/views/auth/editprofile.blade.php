@extends('layout.template')

@section('title', 'Edit Profile')

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
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
        <!-- general form elements -->
                <div class="card card-warning">
                    <div class="card-header">
                        <strong class="card-title">Edit Profile</strong>
                    </div>
                    
                    <div class="card-body">
                                    <form method="post" action="/profile/{{$dosen->id}}/update" enctype="multipart/form-data">
                                        {{-- token keamanan --}}
                                        @method('patch')
                                        @csrf 
                                        <div class="form-group">
                                            <label for="nidn">NIDN</label>
                                        <input type="text" readonly value="{{$dosen->nidn}}" name="txtnidn" class="form-control @error('txtnidn') is-invalid @enderror" id="nidn">
                                            @error('txtnidn')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                        <input type="text" value="{{$dosen->nama}}" name="txtnama" class="form-control @error('txtnama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama">
                                            @error('txtnama')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                        <input type="text" value="{{$dosen->alamat}}" name="txtalamat" class="form-control @error('txtalamat') is-invalid @enderror" id="alamat" placeholder="Masukkan Alamat">
                                            @error('txtalamat')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" name="txtgender" id="exampleFormControlSelect1">
                                                <option id="Laki-Laki" @if ($dosen->gender == 'Laki-Laki')
                                                    selected
                                                @endif>Laki-Laki</option>
                                                <option id="Perempuan" @if ($dosen->gender == 'Perempuan')
                                                    selected
                                                @endif>Perempuan</option>
                                                @error('txtgender')
                                                <span class="invalid-feedback">
                                                    {{$message}}
                                                </span>
                                                @enderror
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" value="{{$dosen->agama}}" class="form-control @error('txtagama') is-invalid @enderror" name="txtagama" id="agama" placeholder="Masukkan Agama">
                                            @error('txtagama')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" value="{{$dosen->tempat_lahir}}" class="form-control @error('txttempat_lahir') is-invalid @enderror" name="txttempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                            @error('txttempat_lahir')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" value="{{$dosen->tgl_lahir}}" class="form-control @error('txttgl_lahir') is-invalid @enderror" name="txttgl_lahir" id="tgl_lahir" placeholder="Masukkan Tempat Lahir">
                                            @error('txttgl_lahir')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" value="{{$dosen->email}}" class="form-control @error('txtemail') is-invalid @enderror" name="txtemail" id="email" placeholder="Masukkan Email">
                                            @error('txtemail')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telpon">No Telpon</label>
                                            <input type="text" value="{{$dosen->no_telpon}}" class="form-control @error('txtno_telpon') is-invalid @enderror" name="txtno_telpon" id="no_telpon" placeholder="Masukkan No Telpon">
                                            @error('txtno_telpon')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="profile">Foto Profile</label>
                                            <input type="file" name="fotoprofile" class="form-control @error('fotoprofile') is-invalid @enderror" id="profile" value="">
                                            @error('fotoprofile')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>

                                            <button type="submit" class="btn btn-warning">Ubah Data</button>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection