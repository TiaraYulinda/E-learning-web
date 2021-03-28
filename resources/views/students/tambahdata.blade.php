@extends('layout.main')

@section('title', 'Tambah Data Mahasiswa')


@section('container')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Form Tambah Data Mahasiswa</h1> 
            
            <form method="post" action="/students">
                {{-- token keamanan --}}
                @csrf 
                <div class="form-group">
                    <label for="npm">NPM</label>
                <input type="text" value="{{old('npm')}}" name="npm" class="form-control @error('npm') is-invalid @enderror" id="npm" placeholder="Masukkan NPM">
                    @error('npm')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" value="{{old('nama')}}" class="form-control @error('nama') is-invalid @enderror" name="txtnama" id="nama" placeholder="Masukkan Nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" value="{{old('email')}}" class="form-control" name="txtemail" id="email" placeholder="Masukkan Email">
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" value="{{old('jurusan')}}" class="form-control" name="txtjurusan" id="jurusan" placeholder="Masukkan Jurusan">
                </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>

        </div>
    </div>
</div>

@endsection