@extends('layout.template')

@section('title', 'Tugas yang sudah dikerjakan')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>STMIK Insan Pembangunan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tugas Yang Sudah Di Kerjakan</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@if(count($errors) > 0)
    <div class="alert alert-danger">
        Pesan Kesalahan<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
    {{session('status')}}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tugas Saya</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                                            <th>#</th>
                                            <th>Dosen</th>
                                            <th>Matakuliah</th>
                                            <th>Kelas</th>
                                            <th>Judul</th>
                                            <th>Di Kerjakan</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                </tr>
            </thead>

                                        <tbody>  
                                        @foreach ($jawaban as $jwb)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $jwb->tugas->user->dosen->nama }}</td>
                                                <td>{{ $jwb->tugas->matkul->nama }}</td>
                                                <td>{{ $jwb->tugas->kelas->nama_kelas }}</td>
                                                <td>{{ $jwb->judul }}</td>
                                                <td>{{ Carbon\Carbon::parse($jwb->created_at)->format('d F Y H:i') }}</td>
                                                <td>{{ Carbon\Carbon::parse($jwb->tugas->tanggal_deadline)->format('d F Y H:i') }}</td>
                                                <td>{{$jwb->status == 1 ? 'Sudah dibaca':'Belum dibaca'}}</td>                                                
                                                <td>
                                                    <a href="/tugasmahasiswa/{{$jwb->id}}/lihatjawaban" class="btn btn-info">Lihat Jawaban</a>
                                                    <form action="/tugasmahasiswa/{{ $jwb->id}}/hapus" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger" name="archive" onclick="archiveFunction()">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
    
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#datatables').DataTable();

        // $('.delete').click(function (){
        //     var mahasiswa_id = $(this).attr('mahasiswa_id');
        //     swal({
        //         title: "Yakin ingin dihapus?",
        //         text: "Setelah dihapus, data tidak bisa dilihat lagi!",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //         if (willDelete) {
        //             console.log(willDelete);
        //             if(willDelete){
        //                 window.location = "/mahasiswa/"+mahasiswa_id+"/hapus";
        //             }
        //             swal("Poof! Your imaginary file has been deleted!", {
        //             icon: "success",
        //             });
        //         } else {
        //             swal("Your imaginary file is safe!");
        //         }
        //     });
        // });
    });
    
</script>

@endsection

