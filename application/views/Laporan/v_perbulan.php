<!-- <link rel="stylesheet" href="<?= base_url();?>assets\assets\extra-libs\datatables.net-bs4\css\buttons.dataTables.min.css"> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-lg-center text-sm-center">Cetak Laporan Per-Satu Bulan</h4>
                    <small>Pilih Bulan, untuk menampilkan data yang akan di buat laporan.</small>
                    <hr>
                    <form action="<?= site_url()?>Laporan/cetak_perbulan" method="post" target="_blank">
                        <select class="form-control custom-select text-secondary mr-sm-2" id="bulan" name="bulan">
                            <option value="0">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <br>
                        <br>
                        <button class="btn btn-rounded btn-success float-right" id="cetak">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <img src="<?= base_url();?>assets/illustration/perbulan.svg" alt="" width="500px">
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

<script src="<?php echo base_url(); ?>assets/custom/js/fungsi-laporan_perbulan.js"></script>
<script src="<?php echo base_url(); ?>assets/autoNumeric/autoNumeric.js"></script>

<!-- <script>
    $(document).ready(function(){
        
    });
</script> -->

<!-- end -->
