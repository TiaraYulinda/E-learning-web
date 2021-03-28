
@extends('layout/template')

@section('title', 'Dashboard')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    @if(auth()->user()->role == 'dosen')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h3>{{$count}} Tugas</h3>
                        <p>Yang sudah anda buat</p>
                        </div>
                        <div class="icon"><i class="far fa-file-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{$jum}} Jawaban</sup></h3>
                      <p>Yang belum anda baca</p>
                    </div>
                    <div class="icon"><i class="fas fa-user-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
            </div>
    </section>
    @elseif(auth()->user()->role == 'mahasiswa')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-lightblue">
                        <div class="inner">
                        <h3>{{$jawab}} Tugas</h3>
                        <p>Yang sudah anda kerjakan</p>
                        </div>
                        <div class="icon"><i class="far fa-list-alt"></i>
                    </div>
                    <a href="/tugasmahasiswa/jawaban" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <!-- ./col -->
                {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>53<sup style="font-size: 20px">%</sup></h3>
      
                      <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div> --}}
            </div>
    </section>
    @else
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h3>{{$mhs}}</h3>
                        <p>Jumlah Mahasiswa saat ini</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i>
                    </div>
                    <a href="/mahasiswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h3>{{$dsn}}</sup></h3>
                      <p>Jumlah Dosen saat ini</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-tie"></i>
                    </div>
                    <a href="/dosen" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-lightblue">
                    <div class="inner">
                      <h3>{{$mtk}}</sup></h3>
                      <p>Jumlah Mata kuliah saat ini</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-book-open"></i>
                    </div>
                    <a href="/matakuliah" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
            </div>
    </section>
    @endif
    <!-- /.content -->
@stop

