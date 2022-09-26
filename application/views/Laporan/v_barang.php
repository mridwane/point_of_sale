<?php
    $b = date('m');
    switch ($b) {
        case "01":
            $bulan = "Januari";
            break;
        case "02":
            $bulan = "Februari";
            break;
        case "03":
            $bulan = "Maret";
            break;
        case "04":
            $bulan = "April";
            break;
        case "05":
            $bulan = "Mei";
            break;
        case "06":
            $bulan = "Juni";
            break;
        case "07":
            $bulan = "Juli";
            break;
        case "08":
            $bulan = "Agustus";
            break;
        case "09":
            $bulan = "September";
            break;
        case "10":
            $bulan = "Oktober";
            break;
        case "11":
            $bulan = "November";
            break;
        default:
            $bulan = "Desember";
            }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-primary">Cetak Laporan Barang Bulan <b><?= $bulan?></b></h4>
                    <small>Pilih Bulan, untuk menampilkan data yang akan di buat laporan.</small>
                    <hr>
                    <form action="<?= site_url()?>Laporan/cetak_laporan_barang" method="post" target="_blank">
                        <button class="btn btn-rounded btn-success float-right " id="cetak">Cetak</button>
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

<!-- <script src="<?php echo base_url(); ?>assets/custom/js/fungsi-laporan_perbulan.js"></script> -->
<script src="<?php echo base_url(); ?>assets/autoNumeric/autoNumeric.js"></script>

<!-- <script>
    $(document).ready(function(){
        
    });
</script> -->

<!-- end -->
