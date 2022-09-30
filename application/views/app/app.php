<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>    
    <?php $this->load->view('app/style'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- flash data -->
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash');?>"></div>

        <!-- Navbar -->
        <?php $this->load->view('app/navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view('app/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $body; ?>
        <!-- /.content-wrapper -->
        <?php $this->load->view('app/footer'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- script -->
    <?php $this->load->view('app/script'); ?>   
</body>

</html>
