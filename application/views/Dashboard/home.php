<div class="container-fluid">
    <div class="card-group">
        <div class="card border-right bg-info">
            <div class="card-body">
                <div class="d-flex pr d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-white mb-1 font-weight-medium"><?= $barang ?></h2>
                        </div>
                        <h6 class="text-white font-weight-normal mb-0 w-100 text-truncate">Barang</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white"><i data-feather="box"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body bg-twitter">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-white mb-1 w-100 text-truncate font-weight-medium"><?= $kategori ?></h2>
                        <h6 class="text-white font-weight-normal mb-0 w-100 text-truncate">Kategori
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white"><i data-feather="list"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body bg-success">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-white  mb-1 font-weight-medium"><?php foreach($transaksi as $t){ echo $t->total_transaksi;} ?></h2>
                        </div>
                        <h6 class="text-white  font-weight-normal mb-0 w-100 text-truncate">Transaksi hari ini</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white "><i data-feather="activity"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body bg-orange ">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-white mb-1 font-weight-medium"><?= $barang_terjual->jumlah; ?></h2>
                        <h6 class="text-white  font-weight-normal mb-0 w-100 text-truncate">Barang Terjual Hari ini</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white "><i data-feather="shopping-bag"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="text-info">10 Barang Penjualan Terbanyak Tanggal <b><?= date('d/m/Y', strtotime("-1 day", strtotime(date("d-m-Y")))); ?></b></h4>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table no-wrap v-middle mb-0">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Nama Barang
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-muted px-2">Kategori
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Barang Terjual</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list as $item) { ?>
                                    <tr>
                                        <td><?= $item->nama_barang; ?></td>
                                        <td><?= $item->nama_kategori; ?></td>
                                        <td><?= $item->jumlah; ?></td>
                                        <td>Rp. <?= number_format($item->total, 0 , '' , '.' ) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card border border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="text-info"><b>List Stok Barang Kurang dari 10</b></h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-dark">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Nama Barang</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted px-2">Stok</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted px-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($stok as $s) { ?>
                                    <tr>
                                        <td><?= $s->nama_barang; ?></td>
                                        <td><?= $s->stok; ?></td>
                                        <td>
                                            <?php if ($s->stok >= 7 && $s->stok <= 10){?>
                                            <i class="fa fa-circle text-info font-12" data-toggle="tooltip" data-placement="top" title="Stok Mulai Menipis"></i>
                                            <?php } else if ($s->stok >= 5 && $s->stok <= 6){?>
                                            <i class="fa fa-circle text-warning font-12" data-toggle="tooltip" data-placement="top" title="Stok Sudah Menipis"></i></i>
                                            <?php } else {?>
                                            <i class="fa fa-circle text-danger font-12" data-toggle="tooltip" data-placement="top" title="Stok Sudah Sangat Menipis"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="<?= base_url();?>assets/illustration/stok.svg" alt="" width="400px">
        </div>
    </div>
</div>
<!-- dataTable -->
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>

<!-- ajax -->
<script src="<?php echo base_url(); ?>assets/custom/js/fungsi-dashboard.js"></script>

