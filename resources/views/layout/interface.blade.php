<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" integrity="sha256-bLNUHzSMEvxBhoysBE7EXYlIrmo7+n7F4oJra1IgOaM=" crossorigin="anonymous" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/dashboard">E-Learning</a>
                <a class="navbar-brand hidden" href="/dashboard"><img src="{{asset('admin/images/logo2.png')}}" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Menu</h3><!-- /.menu-title -->
                    @if (auth()->user()->role == 'admin')
                        <li class="active">
                            <a href="/mahasiswa"> <i class="menu-icon fa fa-user"></i>Mahasiswa</a>
                        </li>
                        <li class="active">
                            <a href="/dosen"> <i class="menu-icon fa fa-user"></i>Dosen</a>
                        </li>
                        <li class="active">
                            <a href="/matakuliah"> <i class="menu-icon fa fa-user"></i>Mata Kuliah</a>
                        </li>
                    @endif

                    @if (auth()->user()->role == 'mahasiswa')
                        <li class="active">
                            <a href="/tugasmahasiswa"> <i class="menu-icon fa fa-list-ul"></i>Tugas</a>
                        </li>
                        <li class="active">
                            <a href="/tugasmahasiswa/jawaban"> <i class="menu-icon fa fa-check-square"></i>Jawaban</a>
                        </li>
                    @endif

                            @if (auth()->user()->role == 'dosen')   
                            <li class="active">
                                <a href="/tugas"> <i class="menu-icon fa fa-table"></i>Tugas</a>
                            </li>            
                            <li class="active">
                                <a href="/Matakuliah"> <i class="menu-icon fa fa-table"></i>Mata kuliah</a>
                            </li>            
                            @endif
                        {{-- </ul>
                    </li> --}}
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
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
                        
                        // dd($user);

                        $count = count($user);
                        @endphp
                        @if (auth()->user()->role == 'dosen')   
                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                <span class="count bg-primary">{{$count}}</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">{{$count}} jawaban belum dibaca</p>
                                @foreach ($user as $usr)
                                <a class="dropdown-item media bg-flat-color-1" href="/tugas/{{ $usr->id}}/jawaban">
                                <span class="photo media-left"><img alt="avatar" src="{{asset('admin/images/avatar/1.jpg')}}"></span>
                                <span class="message media-body">
                                    <span class="name float-left">{{$usr->nama}}</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Sudah mengirimkan jawaban</p>
                                </span>
                            </a>
                            @endforeach
                            </div>
                        </div>
                        @endif
                        {{-- <li><a href="#"><i class="fa fa-bell"></i></a></li> --}}

                    </div>
                </div>

                <div class="col-sm-5">

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" height="33px" width="100px" src="
                            @if(auth()->user()->role == 'mahasiswa')
                                {{auth()->user()->mahasiswa->getFotoProfile()}}
                            @elseif(auth()->user()->role == 'dosen')
                                {{auth()->user()->dosen->getFotoProfile()}}
                            @else 
                                /images/default.png
                            @endif"
                            alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="/myprofile"><i class="fa fa-user"></i> My Profile</a>
                            <a class="nav-link" href="/logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-8">
                <div class="page-header float-left">
                    <div class="page-title">
                        {{-- <h1>Dashboard</h1> --}}
                        @if(auth()->user()->role == 'admin')
                            <h1>Selamat Datang Dihalaman Admin</h1>
                        @elseif(auth()->user()->role == 'dosen')
                            <h1>Selamat Datang Dihalaman Dosen</h1>
                        @else        
                            <h1>Selamat Datang Dihalaman Mahasiswa</h1>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            {{-- <li class="active">Dashboard</li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @yield('container') <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{asset('admin/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/main.js')}}"></script>
    <script src="{{asset('admin/assets/js/dashboard.js')}}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js" integrity="sha256-JIBDRWRB0n67sjMusTy4xZ9L09V8BINF0nd/UUUOi48=" crossorigin="anonymous"></script>
   
</body>

</html>
