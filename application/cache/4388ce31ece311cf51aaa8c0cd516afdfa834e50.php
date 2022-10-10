

<?php $__env->startSection('style'); ?>
    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $barang ?></h3>
                            <p>Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cube"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $kategori ?></h3>
                            <p>Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php foreach($transaksi as $t){ echo $t->total_sales;} ?></h3>
                            <p>Transaksi Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                <?php 
                                        $bt = $barang_terjual->qty;
                                        if(empty($bt)){
                                            echo "0";
                                        }
                                        else{
                                            echo $bt;
                                        }
                                    ?>
                            </h3>
                            <p>Barang Terjual Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">10 Barang Penjualan Terbanyak Tanggal
                                        <b><?= date('d/m/Y', strtotime("-1 day", strtotime(date("d-m-Y")))); ?></b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Barang Terjual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($list as $item) { ?>
                                            <tr>
                                                <td><?= $item->cname; ?></td>
                                                <td><?= $item->qty; ?></td>
                                            </tr>
                                            <?php } ?>
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
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- Main row -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><b>List Stok Product Kurang dari 10</b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($stok as $s) { 
                                                $stock = $s->qty_stock;
                                                $buffer = $s->qty_buffer;
                                                $result_stock = $stock - $buffer;
                                            ?>
                                            <tr>
                                                <td><?= $s->cname; ?></td>
                                                <td><?= $result_stock; ?></td>
                                                <td>
                                                    <?php if ($result_stock >= 7 && $result_stock <= 10){?>
                                                    <i class="fa fa-circle text-success font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Stok <?= $s->cname; ?> Mulai Menipis"></i>
                                                    <?php } else if ($result_stock >= 1 && $result_stock <= 6){?>
                                                    <i class="fa fa-circle text-warning font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Stok <?= $s->cname; ?> Sangat Kurang"></i></i>
                                                    <?php } else {?>
                                                        <i class="fa fa-circle text-danger font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Stok <?= $s->cname; ?> Sudah Habis"></i>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <?php } ?>
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
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.row (main row) -->
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

    
    <script src="<?= base_url() ?>assets/dist/js-custom/fungsi-dashboard.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('App.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/Dashboard/v_dashboard.blade.php ENDPATH**/ ?>