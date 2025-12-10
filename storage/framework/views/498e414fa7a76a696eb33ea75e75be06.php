<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
<div style="text-align:center; padding:80px;">
    <h1 style="font-size:80px; font-weight:bold; color:#ff4d4d;">404</h1>
    <h3>Page Not Found</h3>
    <p>The page you are looking for does not exist.</p>

    <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mt-3">Go Home</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\wamp64\www\BestexTravel\agentbestex\resources\views/errors_404.blade.php ENDPATH**/ ?>