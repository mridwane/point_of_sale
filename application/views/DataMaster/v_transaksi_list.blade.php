@extends('App.app')

@section('style')

<!-- datatables -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $sub_title; ?></h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tableListTransaksi" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Cetak</th>
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

@endsection

@section('javascript')
    {{-- datatables --}}
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

    {{-- custom js --}}
    <script src="<?= base_url(); ?>assets/dist/js-custom/fungsi-DataTransaksi.js"></script>
    <script src="<?= base_url(); ?>assets/dist/autoNumeric/autoNumeric.js"></script>
@endsection