

<?php $__env->startSection('content'); ?>

<div class="content">
    <!-- Topbar -->
    <div class="topbar">
        <h5>Dashboard</h5>
        <div>
            <i class="fa fa-bell me-3"></i>
            <i class="fa fa-user-circle"></i>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="topbar">
            <h5>Form Example</h5>
        </div>

        <div class="card mt-4 shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Routes Information</h5>
                <a href="<?php echo e(route('admin.route.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus me-1"></i> Add New
                </a>
            </div>

            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Airline Name</th>
                            <th>Airline Code</th>
                            <th>IATA Code</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($airline->id); ?></td>
                                <td><?php echo e($airline->name); ?></td>
                                <td>
                                    <input type="text" 
                                           value="<?php echo e($airline->code); ?>" 
                                           class="form-control airline-code" 
                                           data-id="<?php echo e($airline->id); ?>">
                                </td>
                                <td><?php echo e($airline->iata); ?></td>
                                <td><?php echo e($airline->status); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Toast container -->
    <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1055"></div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#example').DataTable({
        responsive: true,
        pageLength: 20,
        lengthMenu: [10, 20, 50, 100],
        columnDefs: [
            { orderable: false, targets: 2 } // Disable sorting for Airline Code
        ]
    });

    // Function to create a dynamic toast
    function showToast(message, isSuccess = true) {
        const toastId = 'toast-' + Date.now();
        const bgClass = isSuccess ? 'bg-success' : 'bg-danger';

        const toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>`;

        $('#toastContainer').append(toastHtml);
        const toastEl = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();

        // Remove toast from DOM after hidden
        toastEl.addEventListener('hidden.bs.toast', function () {
            $(toastEl).remove();
        });
    }

    // Delegated event binding for blur + Enter key
    $('#example tbody').on('blur keypress', '.airline-code', function(e) {
        if (e.type === 'blur' || (e.type === 'keypress' && e.which === 13)) {
            e.preventDefault();
            const $input = $(this);
            const airline_id = $input.data('id');
            const code = $input.val();

            $.ajax({
                url: "<?php echo e(route('admin.airline.updateCode')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: airline_id,
                    code: code
                },
                success: function(response) {
                    if(response.success){
                        showToast('Airline code updated successfully!', true);
                    } else {
                        showToast('Update failed! Please try again.', false);
                    }
                },
                error: function(xhr){
                    const errors = xhr.responseJSON?.errors;
                    if(errors && errors.code){
                        showToast(errors.code[0], false);
                    } else {
                        showToast('Something went wrong! Please try again.', false);
                    }
                }
            });
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\BestexTravel\agentbestex\resources\views/admin/airlines/list.blade.php ENDPATH**/ ?>