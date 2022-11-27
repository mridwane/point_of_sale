

<?php $__env->startSection('content'); ?>
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
    
    <!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    
    <script src="<?= base_url(); ?>assets/dist/js-custom/validasi-login.js"></script> 
<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('App.app_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/Auth/v_login.blade.php ENDPATH**/ ?>