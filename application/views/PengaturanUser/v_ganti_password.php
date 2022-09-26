<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="mt-3" action="<?= site_url()?>Pengaturan_user/proses_password" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 bottom-space">
                            <h6 class="font-weight-medium float-left text-dark margin-left-5">Password Lama</h6>
                                <div class="form-group">
                                    <input class="form-control custom-radius custom-shadow text-14" type="password" name="passold" id="passold" maxlength="20" placeholder="Masukan password Lama">
                                    <span class="fas fa-eye-slash custom-pass float-right" id="tg_pwdold"></span>
                                    <small id="hintpassold" class="badge badge-default form-text text-secondary float-right">*password 8-20 karakter.</small>
                                </div>
                            </div>                              
                            <div class="col-lg-12 bottom-space">
                            <h6 class="font-weight-medium float-left text-dark margin-left-5">Password Baru</h6>
                                <div class="form-group">
                                    <input class="form-control custom-radius custom-shadow text-14" type="password" name="passnew" id="passnew" maxlength="20" placeholder="Masukan password baru">
                                    <span class="fas fa-eye-slash custom-pass float-right" id="tg_pwdnew"></span>
                                    <small id="hintpassnew" class="badge badge-default form-text text-secondary float-right">*password 8-20 karakter.</small>
                                </div>
                            </div>
                            <div class="col-lg-12 bottom-space">
                            <h6 class="font-weight-medium float-left text-dark margin-left-5">Konfirmasi Password Baru</h6>
                                <div class="form-group">
                                    <input class="form-control custom-radius custom-shadow text-14" type="password" name="passconf" id="passconf" maxlength="20" placeholder="Konfirmasi password baru">
                                    <span class="fas fa-eye-slash custom-pass float-right" id="tg_pwdconf"></span>
                                    <small id="hintpassconf" class="badge badge-default form-text text-secondary float-right">*password 8-20 karakter.</small>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-primary custom-radius custom-shadow" id="btnSimpan">Simpan</button>
                                <button type="submit" onclick="goBack()" class="btn btn-block btn-danger custom-radius custom-shadow">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url();?>assets/custom/js/fungsi-ubahPassword.js"></script> 
        