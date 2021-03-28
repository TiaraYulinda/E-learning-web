@extends('layout.template')

@section('title', 'Tambah Mata kuliah')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/matakuliah">Mata kuliah</a></li>
                <li class="breadcrumb-item active">Tambah Mata kuliah</li>
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
                        <strong class="card-title">Tambah Mata kuliah</strong>
                    </div>
                    
                    <div class="card-body">
                                    <form method="post" action="/matakuliah/tambahmatkul"  enctype="multipart/form-data">
                                        {{-- token keamanan --}}
                                        @csrf 

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Kode</label>
                                            <select class="form-control @error('txtkode') is-invalid @enderror" name="txtkode" id="exampleFormControlSelect1">
                                                <option value="">-----Pilih Kode------</option>
                                                <option id="m-001">M-001</option>
                                                <option id="m-002">M-002</option>
                                                <option id="m-003">M-003</option>
                                                <option id="m-004">M-004</option>
                                                <option id="m-005">M-005</option>
                                                <option id="m-006">M-006</option>
                                                <option id="m-007">M-007</option>
                                                <option id="m-008">M-008</option>
                                            </select>
                                            @error('txtkode')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="matakuliah">Mata kuliah</label>
                                            <input type="text" value="{{old('txtmatakuliah')}}" class="form-control @error('txtmatakuliah') is-invalid @enderror" name="txtmatakuliah" id="matakuliah" placeholder="Masukkan Mata kuliah">
                                            @error('txtmatakuliah')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class ="form-group">
                                            <label for="semester">Semester</label>
                                            <select class="form-control @error('txtsemester') is-invalid @enderror" name="txtsemester" id="exampleFormControlSelect1">
                                                <option value="">-----Pilih Semester------</option>
                                                <option value="1" {{ old('txtsemester') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('txtsemester') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('txtsemester') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('txtsemester') == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ old('txtsemester') == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ old('txtsemester') == '6' ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ old('txtsemester') == '7' ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ old('txtsemester') == '8' ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ old('txtsemester') == '9' ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ old('txtsemester') == '10' ? 'selected' : '' }}>10</option>
                                            </select>
                                            @error('txtsemester')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
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