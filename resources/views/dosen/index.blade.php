@extends('layout.template')

@section('title', 'Halaman Dosen')

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
                <li class="breadcrumb-item active">Dosen</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@if(count($errors) > 0)
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Error!</h5>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Sukses!</h5>
        {{session('status')}}     
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Dosen</h2>
        <div class="float-right">
            <a href="/dosen/tambahdata" class="btn btn-primary">Tambah Data</a>
            <a href="/dosen/exportpdf" class="btn btn-primary">Laporan PDF</a>
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</button> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th>NIDN</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No Telpon</th>
                                            <th>Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                            @foreach ($dosen as $dsn)                      
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="/dosen/{{$dsn->id}}/profile">{{ $dsn->nidn }}</a></td>
                                                    <td><a href="/dosen/{{$dsn->id}}/profile">{{ $dsn->nama }}</a></td>
                                                    <td>{{ $dsn->email }}</td>
                                                    <td>{{ $dsn->no_telpon }}</td>
                                                    <td>
                                                        <a href="/dosen/{{$dsn->id}}/matakuliah" class="btn btn-primary btn-sm">Mata kuliah</a>
                                                        <a href="/dosen/{{$dsn->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                        {{-- <a href="/dosen/{{ $dsn->id}}/hapus" class="delete btn btn-danger btn-sm" mahasiswa_id="{{$dsn->id}}">Hapus</a>  --}}
                                                        <form id="del_id" action="/dosen/{{ $dsn->id}}/hapus" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm delete_type">Delete</button>
                                                        {{-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Ingin Dihapus??')">Delete</button> --}}
                                                        {{-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Ingin Dihapus??')">Delete</button> --}}
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
    </div>
</div>

@endsection

@push('script')
{{-- <script>
    function delete() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
                swal({
        title: "Are you sure?",
        text: "But you will still be able to retrieve this file.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm) {
            form.submit();          // submitting the form when user press yes
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
        });
    }
</script>
     --}}
@endpush