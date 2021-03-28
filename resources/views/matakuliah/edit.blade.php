@extends('layout.template')

@section('title', 'Edit Mata kuliah')

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
                <li class="breadcrumb-item active">Edit Mata kuliah</li>
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
                        <strong class="card-title">Edit Mata kuliah</strong>
                    </div>
                    
                    <div class="card-body">
                                    <form method="post" action="/matakuliah/{{$matkul->id}}/update"  enctype="multipart/form-data">
                                        {{-- token keamanan --}}
                                        @method('patch')
                                        @csrf 

                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" value="{{old('txtkode', $matkul->kode)}}" id="kode" class="datetimepicker form-control @error('txtkode') is-invalid @enderror" name="txtkode">
                                            @error('txtkode')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="matakuliah">Mata kuliah</label>
                                            <input type="text" value="{{old('txtmatakuliah', $matkul->nama)}}" class="form-control @error('txtmatakuliah') is-invalid @enderror" name="txtmatakuliah" id="matakuliah" placeholder="Masukkan Mata kuliah">
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
                                                <option value="1" @if ($matkul->semester == '1') selected @endif>1</option>
                                                <option value="2" @if ($matkul->semester == '2') selected @endif>2</option>
                                                <option value="3" @if ($matkul->semester == '3') selected @endif>3</option>
                                                <option value="4" @if ($matkul->semester == '4') selected @endif>4</option>
                                                <option value="5" @if ($matkul->semester == '5') selected @endif>5</option>
                                                <option value="6" @if ($matkul->semester == '6') selected @endif>6</option>
                                                <option value="7" @if ($matkul->semester == '7') selected @endif>7</option>
                                                <option value="8" @if ($matkul->semester == '8') selected @endif>8</option>
                                                <option value="9" @if ($matkul->semester == '9') selected @endif>9</option>
                                                <option value="10" @if ($matkul->semester == '10') selected @endif>10</option>
                                            </select>
                                            @error('txtsemester')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection