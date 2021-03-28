@extends('layout.template')

@section('title', 'Tambah Mata kuliah Dosen')


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
                        <strong class="card-title">Tambah Mata kuliah Dosen</strong>
                    </div>
                    
                    <div class="card-body">
                                    <form method="post" action="/dosen/{{$dosen->id}}/addmatakuliah">
                                        {{-- token keamanan --}}
                                        @csrf 

                                        <div class="form-group">
                                            <label for="matkul">Mata kuliah</label>
                                            <select class="form-control @error('txtmatkul') is-invalid @enderror" value="{{old('txtmatkul')}}" name="txtmatkul" id="exampleFormControlSelect1">
                                                <option value="">Pilih Matakuliah</option>
                                                @foreach($matkul as $matakuliah)
                                                        <option value="{{$matakuliah->id}}" {{ old('txtmatkul') == $matakuliah->id ? 'selected' : '' }}>{{$matakuliah->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('txtmatkul')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                                <select class="form-control select2" name="txtkelas[]" multiple="multiple" data-placeholder="Pilih Kelas"
                                                    style="width: 100%;">
                                                    <option value="">---Pilih Kelas------</option>
                                                        @foreach ($kelas as $kls)                      
                                                            <option value="{{$kls->id}}" {{ old('txtkelas') == $kls->nama_kelas ? 'selected' : '' }}>{{$kls->nama_kelas}}</option>
                                                        @endforeach
                                                </select>
                                                @error('txtkelas')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                        </div>

                                        <div class="form-gorup row">
                                            <button type="submit" class="btn btn-primary btn-block">Tambah Mata kuliah</button>
                                        </div>

                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection