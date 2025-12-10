

<?php $__env->startSection('content'); ?>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar">
            <h5>Dashboard</h5>
            <div>
                <i class="fa fa-bell me-3"></i>
                <i class="fa fa-user-circle"></i>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="container-fluid mt-4">
         
 <div class="topbar">
      <h5>Form Example</h5>
    </div>
            <div class="card mt-4 shadow-sm border-0">
                 <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Routes Information</h5>
        <a href="<?php echo e(route('admin.route.create')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus me-1"></i> Add New</a>
      </div>
                
                
                <div class="card-body">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

 
      <tr>
         <td><?php echo e($route['id']); ?></td>
        <td><?php echo e($route['origin']); ?></td>
        <td><?php echo e($route['destination']); ?></td>
       
        <td><?php echo e($route['status']); ?></td>
         <td><?php echo e($route['created_at']); ?></td>
        <td><a href="<?php echo e(route('admin.gfares.list', $route['id'])); ?>" class="btn btn-primary">Edit</a></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\BestexTravel\agentbestex\resources\views/admin/routes/list.blade.php ENDPATH**/ ?>