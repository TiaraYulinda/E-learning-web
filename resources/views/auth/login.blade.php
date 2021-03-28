<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Learning | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/login"><b>E-learning</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
        @if (session('status'))
        <div class="alert alert-danger">
            {{session('status')}}
        </div>
        @endif
        <form action="/postlogin" method="post">
            @csrf
            <div class="input-group mb-3">
            <input type="text" class="form-control @error('txtusername') is-invalid @enderror" value="{{old('txtusername')}}" placeholder="Username" name="txtusername">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('txtusername')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            </div>

            <div class="input-group mb-3">
            <input type="password"  name="txtpassword" class="form-control @error('txtpassword') is-invalid @enderror"  value="{{old('txtpassword')}}" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('txtpassword')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            </div>
            <button type="submit" class="btn btn-info btn-flat btn-block m-b-30 m-t-30">Sign in</button>
        </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>

</body>
</html>
