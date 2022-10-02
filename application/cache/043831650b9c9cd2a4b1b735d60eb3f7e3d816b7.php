

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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <h1 class="text-dark float-left">Total</h1>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                <h1 class="text-dark float-right font-weight-bold" id="total">Rp. 0</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-lg-7 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <!-- <h6 class="card-title">Masukan Kode Barang</h6> -->
                        <div class="form-group">
                            <select class="form-control anggota" name="anggota" id="anggota">
                                <option value="" selected disabled>Pilih Tipe Pelanggan</option>
                                <option value="anggota">Anggota</option>
                                <option value="non-anggota">Non Anggota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="noAnggota" class="form-control" type="text" placeholder="Masukan Nomer Anggota..." hidden>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Anggota</label>
                                    <input type="text" class="form-control" value="Ridwan" disabled="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Wilayah</label>
                                    <input type="text" class="form-control" value="Pandeglang" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- <h6 class="card-title">Masukan Kode Barang</h6> -->
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="kd_barang"
                                id="kd_barang" maxlength="255" placeholder="Masukan Kode Barang Kemudian Tekan Enter">
                            <small id="hintkd_barang"
                                class="badge badge-default form-text text-secondary float-right">*masukan kode barang
                                kemudian tekan enter.</small>
                        </div>
                        <button type="button" class="btn btn-primary btn-rounded float-left" id="kosong">Kosongkan Kode
                            Barang</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-sm-6">
                <form action="<?= site_url()?>Transaksi/cetak_struk" method="post" target="_blank">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-dark">
                                <div class="col-4">
                                    <h5>Subtotal :</h5>
                                </div>
                                <div class="col-8">
                                    <div class="form-group" id="subtotal">

                                    </div>
                                </div>
                            </div>
                            <div class="row text-dark">
                                <div class="col-4">
                                    <h5>Diskon :</h5>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control custom-radius custom-shadow text-14"
                                            data-a-sign="Rp. " data-a-sep="." id="diskon" name="diskon" value="Rp.0"
                                            maxlength="25" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-dark">
                                <div class="col-4">
                                    <h5>Tunai :</h5>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control custom-radius custom-shadow text-14"
                                            data-a-sign="Rp. " data-a-sep="." name="bayar" id="bayar" maxlength="25">
                                    </div>
                                </div>
                            </div>
                            <div class="row text-dark">
                                <div class="col-4">
                                    <h5>Kembali :</h5>
                                </div>
                                <div class="col-8">
                                    <!-- <h4 class="float-right" id="kembalian" name="kembalian">Rp. 0</h4> -->
                                    <div class="form-group">
                                        <input type="text" class="form-control custom-radius custom-shadow text-14"
                                            id="kembalian" name="kembali" maxlength="25" readonly value="Rp. 0">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row text-dark">
                                <div class="col-12">
                                    <button type="button" class="btn btn-danger btn-rounded" id="batal">Batal</button>
                                    <input type="submit" class="btn btn-success btn-rounded" id="cetak" value="Cetak"
                                        disabled='disabled'>
                                    <button type="button" class="btn btn-primary btn-rounded" id="selesai"
                                        disabled='disabled'>Selesai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Barang</h4>
                        <br>
                        <div class="table-responsive">
                            <table id="listBarang" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
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
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
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

    
    <script src="<?= base_url(); ?>assets/dist/js-custom/fungsi-transaksi.js"></script>
    <script src="<?= base_url(); ?>assets/dist/autoNumeric/autoNumeric.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/Transaksi/v_transaksi.blade.php ENDPATH**/ ?>