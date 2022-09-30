<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal"
                                    data-target="#tambah-data">Tambah Data</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tableKategori" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
    </div><!-- /.container-fluid -->
</section>

<!-- Modal tambah data-->
<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel">Tambah Data Kategori
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="mt-4">
                        <h5 class="card-title">Nama Kategori</h5>
                        <div class="form-group">
                            <input type="text" class="form-control custom-radius custom-shadow text-14" name="nama"
                                id="nama" maxlength="100" placeholder="Masukan Kode kategori">
                            <small id="hintnama" class="badge badge-default form-text text-secondary float-right">*max
                                20 karakter.</small>
                        </div>
                        <br>
                        <button type="button" class="btn btn-outline-secondary btn-rounded"
                            data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded" id="btn_save">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
