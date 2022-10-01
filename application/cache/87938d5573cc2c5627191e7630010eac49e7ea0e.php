

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
                        <div class="card card-primary shadow-none">
                            <div class="card-header">
                                <h3 class="card-title">Pilih Tanggal</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="form-group">
                                    <input type="date" id="tanggal" name="tanggal" class="form-control">
                                    <small>pilih tanggal untuk menampilkan data penjualan dalam satu hari.</small>
                                </div>
                                <button class="btn btn-rounded btn-info float-right" id="tampil">Tampilkan</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $title; ?></h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tablePenjualan" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">

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

    
    <script src="<?= base_url(); ?>assets/dist/js-custom/fungsi-Datapenjualan.js"></script>
    <script src="<?= base_url(); ?>assets/dist/autoNumeric/autoNumeric.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('App.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/DataMaster/v_penjualan.blade.php ENDPATH**/ ?>