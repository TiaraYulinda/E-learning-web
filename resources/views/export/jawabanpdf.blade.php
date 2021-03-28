<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Dosen</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
		/* table tr td,
		table tr th{
			font-size: 9pt;
		}

        table{
            border: 3px;
            
        }

        hr{
            border: 0;
            border-top: 3px double #8c8c8c; 
        } */

        h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }
  
    table {
        border-collapse: collapse;
        width: 100%;
    }
  
    .table th {
        padding: 8px 8px;
        border:1px solid #000000;
        text-align: center;
    }
  
        .table td {
            padding: 3px 3px;
            border:1px solid #000000;
        }
    
        .text-center {
            text-align: center;
        }

        hr{
            border: 0;
            border-top: 3px double #8c8c8c; 
        }

        #column {
            width: 50%; float: left; margin: 0 20px 0 0; 
        }

	</style>
</head>
<body>
	<table width="100%">
        <tr>
            {{-- <td width="25" align="center"></td> --}}
            <td  align="center"><h6>SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER</h5>
                <h5>INSAN PEMBANGUNAN</h4>
                <h6>Jl. Raya Serang Km.10 Bitung Tangerang Tlp. (021) 59492836</h5>
                <h6>Website : www.stmik.ipem.ac.id Email : stmik@ipem.ac.id</h5></td>
            {{-- <td width="25" align="center"></td> --}}
            </tr>
    </table>
    <hr color="black">
    
    <center>
        <h6><u>Laporan Tugas Mahasiswa</u></h6>
    </center>
    <br>

    <div id="column">
<pre>
Mata kuliah : {{$tugas->matkul->nama}}                                              
Kelas       : {{$tugas->kelas->nama_kelas}}                                              
Deadline    : {{Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d F Y H:i')}}
Tugas       : {{$tugas->judul_tugas}}
</pre>
    </div>

<div class="column">
<pre>
Jumlah kelas A : {{$jumA}}                                              
Jumlah kelas B : {{$jumB}}                                              
Jumlah kelas C : {{$jumC}}                                              
Jumlah kelas D : {{$jumD}}                                              
</pre>
</div><br>

    <table class="table">
        <thead>
            <tr>
                <th>NO.</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Judul</th>
                <th>Tgl mengerjakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jawaban as $jwb)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $jwb->user->mahasiswa->npm }}</td>
                <td>{{ $jwb->user->mahasiswa->nama }}</td>
                <td class="text-center">{{ $jwb->user->mahasiswa->kelas->nama_kelas }}</td>
                <td>{{ $jwb->judul}}</td>
                <td>{{ Carbon\Carbon::parse($jwb->created_at)->format('d F Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>