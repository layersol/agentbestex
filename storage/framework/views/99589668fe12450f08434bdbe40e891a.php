<?php echo $__env->make('admin.layouts.dashboard-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


        <?php echo $__env->make('admin.layouts.dashboard-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

     
                            <?php echo $__env->yieldContent('content'); ?>
                        
    

<?php echo $__env->make('admin.layouts.dashboard-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\agentbestex\resources\views/admin/layouts/dashboard.blade.php ENDPATH**/ ?>