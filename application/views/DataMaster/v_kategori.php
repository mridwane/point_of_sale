<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title"><?= $title; ?></h4> -->
                    <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#tambah-data">Tambah Data</button>
                    <hr>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-6 relative">
            <img src="<?= base_url();?>assets/illustration/kategori.svg" alt="" width="400px">
        </div>
    </div>
</div>


<!-- Modal tambah data-->
<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel">Tambah Data Kategori
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="card">
                <div class="card-body">                    
                    <form class="mt-4">
                        <h5 class="card-title">Nama Kategori</h5>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="nama" id="nama" maxlength="100" placeholder="Masukan Kode kategori">
                            <small id="hintnama" class="badge badge-default form-text text-secondary float-right">*max 20 karakter.</small>
                        </div>
                        <br>
                        <button type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded" id="btn_save">Simpan Data</button>
                    </form>
                </div>
            </div>            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- javaScript -->
<!-- dataTable -->
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>

<!-- ajax -->
<script src="<?php echo base_url(); ?>assets/custom/js/fungsi-kategori.js"></script>

<!-- end -->
