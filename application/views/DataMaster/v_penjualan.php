<!-- <link rel="stylesheet" href="<?= base_url();?>assets\assets\extra-libs\datatables.net-bs4\css\buttons.dataTables.min.css"> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pilih Tanggal </h4>
                    <div class="form-group">
                        <input id="tanggal" name="tanggal" class="datepicker form-control">
                        <small>pilih tanggal untuk menampilkan data penjualan dalam satu hari.</small>
                    </div>
                    <button class="btn btn-rounded btn-info float-right" id="tampil">Tampilkan</button>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <img src="<?= base_url();?>assets/illustration/penjualan.svg" alt="" width="250px">
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $title; ?></h4>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered no-wrap">
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
                </div>
            </div>
        </div>
    </div>
</div>


<!-- javaScript -->
<!-- dataTable -->
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/buttons.print.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/custom/js/fungsi-Datapenjualan.js"></script>
<script src="<?php echo base_url(); ?>assets/autoNumeric/autoNumeric.js"></script>

<!-- <script>
    $(document).ready(function(){
        
    });
</script> -->

<!-- end -->
