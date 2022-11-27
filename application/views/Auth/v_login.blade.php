@extends('App.app_auth')

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url(); ?>assets_auth/assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box row text-center">
        <div class="col-lg-6 col-md-5 modal-bg-img" style="background-image: url(<?= base_url(); ?>assets_auth/illustration/login.png);">
        </div>
        <div class="col-lg-6 col-md-7 bg-white">
            <div class="p-3">
                <img src="<?= base_url(); ?>assets_auth/illustration/icon.png" alt="wrapkit">
                <h2 class="mt-3 text-center">Login</h2>
                <form class="mt-3" action="<?= site_url()?>auth/proses_login" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                        <h6 class="font-weight-medium float-left text-dark margin-left-5">Username</h6>
                            <div class="form-group">
                                <input class="form-control custom-radius custom-shadow text-lowercase text-14" name="username" id="username" type="text" maxlength="20" placeholder="Masukan username">
                                <small id="hintusername" class="badge badge-default form-text text-secondary float-right"></small>
                            </div>
                        </div>                               
                        <div class="col-lg-12 bottom-space">
                        <h6 class="font-weight-medium float-left text-dark margin-left-5">Password</h6>
                            <div class="form-group">
                                <input class="form-control custom-radius custom-shadow text-14" type="password" name="password" id="pass1" maxlength="20" placeholder="Masukan password">
                                <span class="fas fa-eye-slash custom-pass float-right" id="tg_pwd1"></span>
                                <small id="hintpass1" class="badge badge-default form-text text-secondary float-right">*</small>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary custom-radius custom-shadow" id="btnLogin">Login</button>
                        </div>
                        <div class="col-lg-12 text-center mt-5">Belum Punya Akun? <a href="<?= site_url()?>Auth/register" class="text-danger">Daftar</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    {{-- <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url(); ?>assets/index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Selamat datang</p>

                <form action="<?= site_url()?>auth/proses_login" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" id="username" type="text" maxlength="20" placeholder="Masukan username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>                                           
                    </div>
                    <small id="hintusername" class="badge badge-default form-text text-secondary float-right"></small>
                    <br>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" type="password" name="password" id="pass1" maxlength="20" placeholder="Masukan password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>                        
                    </div>
                    <small id="hintpass1" class="badge badge-default form-text text-secondary float-right">*</small>
                    <br>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btnLogin">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div> --}}
    <!-- /.login-box -->
@endsection

@section('javascript')
    {{-- custom js --}}
    <script src="<?= base_url(); ?>assets/dist/js-custom/validasi-login.js"></script> 
@endsection
    