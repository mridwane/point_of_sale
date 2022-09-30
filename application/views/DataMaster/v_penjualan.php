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
