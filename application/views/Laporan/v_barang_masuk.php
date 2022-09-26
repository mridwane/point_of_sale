<!-- <link rel="stylesheet" href="<?= base_url();?>assets\assets\extra-libs\datatables.net-bs4\css\buttons.dataTables.min.css"> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-lg-center text-sm-center">Cetak Laporan Barang Masuk</h4>
                    <small>Isi tanggal mulai dan akhir, untuk menampilkan data yang akan di buat laporan.</small>
                    <hr>
                    <form action="<?= site_url()?>Laporan/cetak_barang_masuk" method="post" target="_blank">
                        <div class="form-group">
                            <input id="tanggal_mulai" name="tanggal_mulai" class="datepicker form-control">
                        </div>
                        <h6 class="card-title">s/d</h6>
                        <div class="form-group">
                            <input id="tanggal_akhir" name="tanggal_akhir" class="datepicker form-control">
                        </div>
                        <button class="btn btn-rounded btn-success float-right" id="Cetak">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <img src="<?= base_url();?>assets/illustration/laporan.svg" alt="" width="500px">
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

<script src="<?php echo base_url(); ?>assets/custom/js/fungsi-laporan_barang_masuk.js"></script>
<script src="<?php echo base_url(); ?>assets/autoNumeric/autoNumeric.js"></script>

<!-- <script>
    $(document).ready(function(){
        
    });
</script> -->

<!-- end -->
