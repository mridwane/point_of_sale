

<?php $__env->startSection('style'); ?>
    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#tambah-data">Tambah Data</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableBarang" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Katergori</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<!-- Modal tambah data-->
<div id="tambah-data" class="modal fade" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel">Tambah Data Barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form>
                        <h6 class="card-title">Kode Barang</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="kd_barang"
                                id="kd_barang" maxlength="50" placeholder="Masukan Kode Barang">
                            <small id="hintkd_barang"
                                class="badge badge-default form-text text-secondary float-right">*max 50
                                karakter.</small>
                        </div>
                        <h6 class="card-title">Nama Barang</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="nama"
                                id="nama" maxlength="25" placeholder="Masukan Nama Barang">
                            <small id="hintnama" class="badge badge-default form-text text-secondary float-right">*max
                                25 karakter.</small>
                        </div>
                        <h6 class="card-title">Kategori</h6>
                        <div class="form-group">
                            <select class="custom-select mr-sm-2 text-secondary custom-radius" id="kategori"
                                name="kategori">
                                <option>Pilih Kategori</option>
                                <?php foreach($kategori as $row):?>
                                <option value="<?php echo $row->kd_kategori;?>"><?php echo $row->nama_kategori;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                            <small id="hintkategori"
                                class="badge badge-default form-text text-secondary float-right">*pilih kategori</small>
                        </div>
                        <h6 class="card-title">Harga Beli</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14"
                                data-a-sign="Rp. " data-a-sep="." name="harga_beli" id="harga_beli" maxlength="20"
                                placeholder="Masukan Harga Beli">
                            <small id="hintharga_beli"
                                class="badge badge-default form-text text-secondary float-right">*max 20
                                karakter.</small>
                        </div>
                        <h6 class="card-title">Harga Jual</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14"
                                data-a-sign="Rp. " data-a-sep="." name="harga_jual" id="harga_jual" maxlength="20"
                                placeholder="Masukan Harga Jual">
                            <small id="hintharga_jual"
                                class="badge badge-default form-text text-secondary float-right">*max 20
                                karakter.</small>
                        </div>
                        <h6 class="card-title">Stok</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="stok"
                                id="stok" maxlength="5" placeholder="Masukan Stok">
                            <small id="hintstok" class="badge badge-default form-text text-secondary float-right">*max 5
                                karakter.</small>
                        </div>
                        <br>
                        <button type="button" class="btn btn-outline-secondary btn-rounded"
                            data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded" id="btn_save">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit data-->
<div id="modal-edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <h4 class="modal-title" id="warning-header-modalLabel">Edit Data Barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="mt-4">
                        <h6 class="card-title">Kode Barang</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14"
                                name="kd_barangEdit" id="kd_barangEdit" maxlength="50"
                                placeholder="Masukan Kode Barang">
                            <small id="hintkd_barangEdit"
                                class="badge badge-default form-text text-muted float-right">*max 50 karakter.</small>
                        </div>
                        <h6 class="card-title">Nama Barang</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="namaEdit"
                                id="namaEdit" maxlength="25" placeholder="Masukan Nama Barang">
                            <small id="hintnamaEdit" class="badge badge-default form-text text-muted float-right">*max
                                25 karakter.</small>
                        </div>
                        <h6 class="card-title">Kategori</h6>
                        <div class="form-group">
                            <select class="custom-select mr-sm-2 text-secondary custom-radius" id="kategoriEdit"
                                name="kategoriEdit">
                                <option>Pilih Kategori</option>
                                <?php foreach($kategori as $row):?>
                                <option value="<?php echo $row->kd_kategori;?>"><?php echo $row->nama_kategori;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                            <small id="hintkategoriEdit"
                                class="badge badge-default form-text text-muted float-right">*pilih kategori</small>
                        </div>
                        <h6 class="card-title">Harga Beli</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14"
                                data-a-sign="Rp. " data-a-sep="." name="harga_beliEdit" id="harga_beliEdit"
                                maxlength="20" placeholder="Masukan Harga Beli">
                            <small id="hintharga_beliEdit"
                                class="badge badge-default form-text text-muted float-right">*max 20 karakter.</small>
                        </div>
                        <h6 class="card-title">Harga Jual</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14"
                                data-a-sign="Rp. " data-a-sep="." name="harga_jualEdit" id="harga_jualEdit"
                                maxlength="20" placeholder="Masukan Harga Jual">
                            <small id="hintharga_jualEdit"
                                class="badge badge-default form-text text-muted float-right">*max 20 karakter.</small>
                        </div>
                        <br>
                        <button type="button" class="btn btn-outline-secondary btn-rounded"
                            data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded" id="btn_update">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit data-->
<div id="modal-add-stok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Tambah Stok Barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="mt-4">
                        <h6 class="card-title">Kode Barang</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14"
                                name="kd_barang_add" id="kd_barang_add" maxlength="50" placeholder="Masukan Kode Barang"
                                readonly>
                            <small id="hintkd_barangAdd"
                                class="badge badge-default form-text text-muted float-right">*max 50 karakter.</small>
                        </div>
                        <h6 class="card-title">Nama Barang</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="nama_add"
                                id="nama_add" maxlength="25" placeholder="Masukan Nama Barang" readonly>
                            <small id="hintnamaAdd" class="badge badge-default form-text text-muted float-right">*max 25
                                karakter.</small>
                        </div>
                        <h6 class="card-title">Stok</h6>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="stok_add"
                                id="stok_add" maxlength="4" placeholder="Masukan Jumlah Stok">
                            <small id="hintstok_add" class="badge badge-default form-text text-muted float-right">*max 4
                                karakter.</small>
                        </div>
                        <br>
                        <button type="button" class="btn btn-outline-secondary btn-rounded"
                            data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded" id="btn_add_stok">Tambah Stok</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    
    <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    
    <script src="<?= base_url(); ?>assets/dist/js-custom/fungsi-barang.js"></script>
    <script src="<?= base_url(); ?>assets/dist/autoNumeric/autoNumeric.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/DataMaster/v_barang.blade.php ENDPATH**/ ?>