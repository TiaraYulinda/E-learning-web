<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="/adminlte/plugins/toastr/toastr.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
	{{-- SweetAlert --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
 <!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="/dashboard" class="nav-link">Home</a>
			</li>
		</ul>
		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			@php
			$user = DB::table('users')
						// ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
						->join('jawaban', 'users.id', '=', 'jawaban.user_mhs_id')
						->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
						->join('tugas', 'tugas.id', '=', 'jawaban.tugas_id')
						->select('tugas.*', 'mahasiswa.*', 'jawaban.*')
						->where('jawaban.status', '=', 0)
						->where('tugas.user_dsn_id', '=', auth()->user()->id)
						->get();
			$count = count($user);
			@endphp
			@if (auth()->user()->role == 'dosen')   
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-bell"></i>
					<span class="badge badge-danger navbar-badge">{{$count}}</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">{{$count}} Notifications</span>
					@foreach ($user as $usr)
					<div class="dropdown-divider"></div>
					<a href="/tugas/{{ $usr->id}}/jawaban" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i>{{$usr->nama}}<br>Sudah mengirimkan tugas
					<span class="float-right text-muted text-sm">3 mins</span>
					</a>
					<div class="dropdown-divider"></div>
				  @endforeach
				</div>
			  </li>
			@endif
			<li class="nav-item d-none d-sm-inline-block">
				<a href="/logout" class="nav-link">Log Out <i class="fas fa-sign-out-alt"></i></a>
			</li>
			{{-- <li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				<i class="fas fa-th-large"></i>
				</a>
			</li> --}}
		</ul>
	</nav>
<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="/dashboard" class="brand-link">
				<center>
					E-LEARNING
				</center>
			{{-- <img src="/adminlte/img/AdminLTELogo.png"
				alt="AdminLTE Logo"
				class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light">E-LEARNING</span> --}}
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
			<!-- Sidebar user (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img class="img-circle elevation-2" alt="User Image" src="
						@if(auth()->user()->role == 'mahasiswa')
						{{auth()->user()->mahasiswa->getFotoProfile()}}
						@elseif(auth()->user()->role == 'dosen')
							{{auth()->user()->dosen->getFotoProfile()}}
						@else 
							/images/default.png
						@endif">
				</div>
				<div class="info">
					<a href="/myprofile" class="d-block">{{auth()->user()->name}}</a>
				</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
				<li class="nav-item">
						<a href="/dashboard" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
						</a>
				</li>
				@if (auth()->user()->role == 'admin')
				<li class="nav-item">
						<a href="/admin_" class="nav-link">
						<i class="nav-icon far fa-user-circle"></i>
						<p>Admin</p>
						</a>
				</li>
				@endif
				<li class="nav-header">Menu</li>
				@if (auth()->user()->role == 'dosen')
				<li class="nav-item">
					<a href="/tugas" class="nav-link">
						<i class="nav-icon fa fa-list-ul"></i>
						<p>Tugas</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/Matakuliah" class="nav-link">
					<i class="nav-icon fas fa-chalkboard-teacher"></i>
					<p>Mata kuliah</p>
					</a>
				</li>
				
				@elseif(auth()->user()->role == 'mahasiswa')
				<li class="nav-item">
					<a href="/materi" class="nav-link">
					<i class="nav-icon fas fa-chalkboard-teacher"></i>
					<p>Materi</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/tugas" class="nav-link">
						<i class="nav-icon fa fa-list-ul"></i>
						<p>Tugas</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="/tugasmahasiswa/jawaban" class="nav-link">
					<i class="nav-icon fas fa-chalkboard-teacher"></i>
					<p>Jawaban</p>
					</a>
				</li>
				@else
				<li class="nav-item">
					<a href="/dosen" class="nav-link">
					<i class="nav-icon fas fa-user-tie"></i>
					<p>Dosen</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/mahasiswa" class="nav-link">
					<i class="nav-icon fas fa-users"></i>
					<p>Mahasiswa</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/matakuliah" class="nav-link">
					<i class="nav-icon fas fa-chalkboard-teacher"></i>
					<p>Mata kuliah</p>
					</a>
				</li>
				@endif
				{{-- <li class="nav-item">
					<a href="/logout" class="nav-link">
					<i class="nav-icon fas fa-sign-out-alt"></i>
					<p>Log Out</p>
					</a>
				</li> --}}
				</ul>
		</nav>
<!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/js/demo.js"></script>
<!-- Toastr -->
<script src="/adminlte/plugins/toastr/toastr.min.js"></script>
{{-- SweetAlert --}}
<script src="/sweetalert/sweetalert2.all.min.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
	$(function () {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
		});
	});
</script>

<script>
	$(".delete_type").click( function (e) {
    e.preventDefault();
    var _this = $(this)
    //console.info(_this.parent().prop('action'))
    swal.fire({
        title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			$('#del_id').submit();

		}
    });
});
</script>

<script>
	$(".input").click( function (e) {
    e.preventDefault();
    var _this = $(this)
    //console.info(_this.parent().prop('action'))
    swal.fire({
        title: 'Apa kamu yakin?',
		text: "Jawaban tidak bisa diubah kembali walaupun sudah dihapus!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Kirim!'
	}).then((result) => {
		if (result.value) {
			$('#del_id').submit();

		}
    });
});
</script>

<script>
	$(function () {
	  //Initialize Select2 Elements
	  $('.select2').select2()
  
	  //Initialize Select2 Elements
	  $('.select2bs4').select2({
		theme: 'bootstrap4'
	  })
	});
  </script>

@include('sweetalert::alert')

</body>
</html>
