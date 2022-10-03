<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengadaan | Login Suplier</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/AdminLTE-master/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('adminlte/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/AdminLTE-master/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    @if(\Session::has('berhasil'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('berhasil') }}
    </div>
    @endif

    @if(\Session::has('gagal'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('gagal') }}
    </div>
    @endif

    <!-- Cek error lebih dari 0 atau tidak -->
    @if(count($errors->all()) > 0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors as $error)

            <li>{{$error}}</li>

            @endforeach
        </ul>
    </div>

    @endif
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Pengadaan</b>APP</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Masuk Sebagai Suplier</p>

                <form action="/masukSuplier" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <!-- <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label> -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('adminlte/AdminLTE-master/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/AdminLTE-master/dist/js/adminlte.min.js')}}"></script>
</body>

</html>