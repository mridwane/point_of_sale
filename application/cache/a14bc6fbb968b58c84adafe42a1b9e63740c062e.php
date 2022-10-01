

<?php $__env->startSection('content'); ?>
        <div class="login-box">
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
    </div>
    <!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    
    <script src="<?= base_url(); ?>assets/dist/js-custom/validasi-login.js"></script> 
<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('App.app_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/Auth/v_login.blade.php ENDPATH**/ ?>