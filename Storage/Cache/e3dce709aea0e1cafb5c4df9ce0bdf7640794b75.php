
<?php $__env->startSection("title"); ?>
    Home
    <?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <form action="/" method="post">
        <?php echo e(csrf()); ?>

        <button>test</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/index.blade.php ENDPATH**/ ?>