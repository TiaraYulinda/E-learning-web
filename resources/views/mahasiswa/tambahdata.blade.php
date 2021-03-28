@extends('layout.template')

@section('title', 'Tambah Mahasiswa')


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
                <li class="breadcrumb-item active">Tambah Mahasiswa</li>
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
                        <strong class="card-title">Tambah Mahasiswa</strong>
                    </div>
                    
                    <div class="card-body">
                                    <form method="post" action="/mahasiswa/tambah">
                                        {{-- token keamanan --}}
                                        @csrf 
                                        <div class="form-group">
                                            <label for="npm">NPM</label>
                                        <input type="text" value="{{old('txtnpm')}}" name="txtnpm" class="form-control @error('txtnpm') is-invalid @enderror" id="npm" placeholder="Masukkan NPM">
                                            @error('txtnpm')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class ="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" value="{{old('txtnama')}}" class="form-control @error('txtnama') is-invalid @enderror" name="txtnama" id="nama" placeholder="Masukkan Nama">
                                            @error('txtnama')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" value="{{old('txtalamat')}}" class="form-control @error('txtalamat') is-invalid @enderror" name="txtalamat" id="alamat" placeholder="Masukkan Alamat">
                                            @error('txtalamat')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                            <select class="form-control @error('txtgender') is-invalid @enderror" name="txtgender" id="exampleFormControlSelect1">
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
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select class="form-control" value="{{old('txtkelas')}}" name="txtkelas" id="exampleFormControlSelect1">
                                            @foreach($kelas as $kls)
                                                    <option value="{{$kls->id}}">{{$kls->nama_kelas}}</option>
                                            @endforeach
                                            @error('txtkelas')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Jurusan</label>
                                            <input type="text" value="{{old('txtjurusan')}}" class="form-control @error('txtjurusan') is-invalid @enderror" name="txtjurusan" id="jurusan" placeholder="Masukkan Jurusan">
                                            @error('txtjurusan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <input type="text" value="{{old('txtsemester')}}" class="form-control @error('txtsemester') is-invalid @enderror" name="txtsemester" id="semester" placeholder="Masukkan Semester">
                                            @error('txtsemester')
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