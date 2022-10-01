<?php
    $ci =& get_instance(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e($title); ?></title>
        <?php echo $__env->make('App.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="hold-transition <?php echo e($style); ?>-page">
    <div class="flash-data" data-flashdata="<?= $ci->session->flashdata('flash');?>"></div>

    <?php echo $__env->yieldContent('content'); ?>

    
    <?php echo $__env->make('App.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->yieldContent('javascript'); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\point_of_sale\application\views/App/app_auth.blade.php ENDPATH**/ ?>