@extends('layout.template')

@section('title', 'Tambah Dosen')

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
                <li class="breadcrumb-item active">Tambah Dosen</li>
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
        <!-- left column -->
            <div class="col-md-12">
        <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <strong class="card-title">Tambah Dosen</strong>
                    </div>
                    
                    <div class="card-body">
                                    <form method="post" action="/dosen/tambah">
                                        {{-- token keamanan --}}
                                        @csrf 
                                        <div class="form-group">
                                            <label for="nidn">NIDN</label>
                                        <input type="text" value="{{old('txtnidn')}}" name="txtnidn" class="form-control @error('txtnidn') is-invalid @enderror" id="nidn" placeholder="Masukkan NIDN">
                                            @error('txtnidn')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>

                                    

                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                        <input type="text" value="{{old('txtnama')}}" name="txtnama" class="form-control @error('txtnama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama">
                                            @error('txtnama')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                        <input type="text" value="{{old('txtalamat')}}" name="txtalamat" class="form-control @error('txtalamat') is-invalid @enderror" id="alamat" placeholder="Masukkan Alamat">
                                            @error('txtalamat')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" name="txtgender" id="exampleFormControlSelect1">
                                                <option id="Laki-Laki">Laki-Laki</option>
                                                <option id="Perempuan">Perempuan</option>
                                                @error('txtgender')
                                                <span class="invalid-feedback">
                                                    {{$message}}
                                                </span>
                                                @enderror
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" value="{{old('txtagama')}}" class="form-control @error('txtagama') is-invalid @enderror" name="txtagama" id="agama" placeholder="Masukkan Agama">
                                            @error('txtagama')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" value="{{old('txttempat_lahir')}}" class="form-control @error('txttempat_lahir') is-invalid @enderror" name="txttempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                            @error('txttempat_lahir')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" value="{{old('txttgl_lahir')}}" class="form-control @error('txttgl_lahir') is-invalid @enderror" name="txttgl_lahir" id="tgl_lahir" placeholder="Masukkan Tempat Lahir">
                                            @error('txttgl_lahir')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" value="{{old('txtemail')}}" class="form-control @error('txtemail') is-invalid @enderror" name="txtemail" id="email" placeholder="Masukkan Email">
                                            @error('txtemail')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telpon">No Telpon</label>
                                            <input type="text" value="{{old('txtno_telpon')}}" class="form-control @error('txtno_telpon') is-invalid @enderror" name="txtno_telpon" id="no_telpon" placeholder="Masukkan No Telpon">
                                            @error('txtno_telpon')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection