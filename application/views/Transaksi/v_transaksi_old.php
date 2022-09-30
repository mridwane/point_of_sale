<div class="container-fluid">
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
            </div>
        </div>

        <div class="col-lg-7 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <!-- <h6 class="card-title">Masukan Kode Barang</h6> -->
                    <div class="form-group">
                        <input type="text" class="form-control custom-radius custom-shadow text-14" name="kd_barang" id="kd_barang" maxlength="255" placeholder="Masukan Kode Barang Kemudian Tekan Enter">
                        <small id="hintkd_barang" class="badge badge-default form-text text-secondary float-right">*masukan kode barang kemudian tekan enter.</small>
                    </div>
                    <button type="button" class="btn btn-primary btn-rounded float-left" id="kosong">Kosongkan Kode Barang</button>
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
                                <input type="text" class="form-control custom-radius custom-shadow text-14" data-a-sign="Rp. "  data-a-sep="." id="diskon" name="diskon" value="Rp.0" maxlength="25">
                            </div>
                        </div>
                    </div>
                    <div class="row text-dark">
                        <div class="col-4">
                            <h5>Tunai :</h5>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" class="form-control custom-radius custom-shadow text-14" data-a-sign="Rp. "  data-a-sep="." name="bayar" id="bayar" maxlength="25">
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
                                <input type="text" class="form-control custom-radius custom-shadow text-14" id="kembalian" name="kembali" maxlength="25" readonly value="Rp. 0">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row text-dark">
                        <div class="col-12">
                            <button type="button" class="btn btn-danger btn-rounded" id="batal">Batal</button>
                            <input type="submit" class="btn btn-success btn-rounded" id="cetak" value="Cetak" disabled='disabled'>
                            <button type="button" class="btn btn-primary btn-rounded" id="selesai" disabled='disabled'>Selesai</button>
                        </div>   
                        <!-- <div class="col-4">
                            
                        </div>  
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-rounded" id="selesai">Selesai Transaksi</button>
                        </div>  -->
                    </div>
                </div>
            </div>
            </form>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Barang</h4>
                    <hr>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered no-wrap">
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
</div>



<!-- javaScript -->
<!-- dataTable -->
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>assets/autoNumeric/autoNumeric.js"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/fungsi-transaksi.js"></script>



