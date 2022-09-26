<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/illustration/1x1-icon.png">
    <title>Riddesain - <?= $title; ?></title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/custom/css/custom-css.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(<?php echo base_url(); ?>assets/assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row text-center">
                <div class="col-lg-6 col-md-5 modal-bg-img" style="background-image: url(<?php echo base_url(); ?>assets/illustration/register.png);">
                </div>
                <div class="col-lg-6 col-md-7 bg-white">
                    <div class="p-3">
                        <img src="<?= base_url(); ?>assets/illustration/icon.png" alt="wrapkit">
                        <h2 class="mt-3 text-center">Daftar</h2>
                        <form class="mt-3" action="<?php echo site_url()?>Auth/proses_register" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="font-weight-medium float-left text-dark margin-left-5">Nama</h6>
                                    <div class="form-group">
                                        <input class="form-control custom-radius custom-shadow text-14" name="nama" id="nama" type="text" maxlength="50" placeholder="Masukan nama">
                                        <small id="hintnama" class="badge badge-default form-text text-secondary float-right">*nama max 50 karakter</small>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <h6 class="font-weight-medium float-left text-dark margin-left-5">Username</h6>
                                    <div class="form-group">
                                        <input class="form-control custom-radius custom-shadow text-lowercase text-14" name="username" id="username" type="text" maxlength="20" placeholder="Masukan username">
                                        <small id="hintusername" class="badge badge-default form-text text-secondary float-right">*username 8-20 karakter</small>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <h6 class="font-weight-medium float-left text-dark margin-left-5 ">Akses</h6>
                                    <div class="form-group">
                                        <select class="custom-select mr-sm-2 custom-radius custom-shadow text-14 text-dark" name="akses" id="akses">
                                            <option selected>Pilih</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Kasir</option>
                                        </select>
                                        <small id="hintakses" class="badge badge-default form-text text-secondary float-right">*pilih akses</small>
                                    </div>
                                </div>                                
                                <div class="col-lg-12 bottom-space">
                                <h6 class="font-weight-medium float-left text-dark margin-left-5">Password</h6>
                                    <div class="form-group">
                                        <input class="form-control custom-radius custom-shadow text-14" type="password" name="pass1" id="pass1" maxlength="20" placeholder="Masukan password">
                                        <span class="fas fa-eye-slash custom-pass float-right" id="tg_pwd1"></span>
                                        <small id="hintpass1" class="badge badge-default form-text text-secondary float-right">*password 8-20 karakter</small>  
                                                                         
                                    </div>
                                </div>
                                <div class="col-lg-12 bottom-space">
                                <h6 class="font-weight-medium float-left text-dark margin-left-5">Password Konfirmasi</h6>
                                    <div class="form-group">
                                        <input class="form-control custom-radius custom-shadow text-14" type="password" name="pass2" id="pass2" maxlength="20" placeholder="Masukan ulang password">
                                        <span class="fas fa-eye-slash custom-pass float-right" id="tg_pwd2"></span>
                                        <small id="hintpass2" class="badge badge-default form-text text-secondary float-right">*masukan kembali password anda.</small>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-primary custom-radius custom-shadow" id="btnDaftar">Register</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Sudah Punya Akun? <a href="<?php echo site_url()?>" class="text-danger">Masuk</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->    
    <script src="<?php echo base_url(); ?>assets/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/js/validasi-register.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="<?php echo base_url(); ?>assets/assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>