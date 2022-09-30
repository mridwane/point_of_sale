<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <?php $this->load->view('app/style'); ?>
    </head>
    <body class="hold-transition <?= $style ?>-page">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash');?>"></div>

    <?= $body ?>

    <?php $this->load->view('app/script'); ?>
    </body>
</html>
