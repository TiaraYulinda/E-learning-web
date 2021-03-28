<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Dosen</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}

        table{
            border: 3px;
        }
        hr{
            border: 0;
            border-top: 3px double #8c8c8c; 
        }

	</style>
</head>
<body>
	<table width="100%">
        <tr>
            <td width="25" align="center"></td>
            <td width="50" align="center"><h6>SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER</h5>
                <h5>INSAN PEMBANGUNAN</h4>
                <h6>Jl. Raya Serang Km.10 Bitung Tangerang Tlp. (021) 59492836</h5>
                <h6>Website : www.stmik.ipem.ac.id Email : stmik@ipem.ac.id</h5></td>
            <td width="25" align="center"></td>
            </tr>
    </table>
    <hr color="black">

    <center>
        <h6><u>Laporan Data Dosen</u></h6>
    </center>
    <br>

<table class="table table-bordered">
    
    <thead class="text-center">
        <tr>
        <th>#</th>
        <th>NIDN</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Email</th>
        <th>No Telpon</th>
        </tr>
    </thead>

    <tbody>  
        @foreach ($dosen as $dsn)                      
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dsn->nidn }}</td>
                <td>{{ $dsn->nama }}</td>
                <td>{{ $dsn->alamat }}</td>
                <td>{{ $dsn->gender }}</td>
                <td>{{ $dsn->agama }}</td>
                <td>{{ $dsn->tempat_lahir }}</td>
                <td>{{ Carbon\Carbon::parse($dsn->tgl_lahir)->format('d F Y') }}</td>
                <td>{{ $dsn->email }}</td>
                <td>{{ $dsn->no_telpon }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>