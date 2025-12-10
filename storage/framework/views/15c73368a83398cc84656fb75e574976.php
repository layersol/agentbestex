<!-- Mobile Toggle Button -->
<button class="mobile-toggle" id="mobileToggle"><i class="fa fa-bars"></i></button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <h4 class="text-center text-white mb-4">
        <a href=".">
            <img class="img-fluid" src="<?php echo e(asset('assets/img/logo.webp')); ?>" alt="Logo" />
        </a>
    </h4>

    <a href="index.html"><i class="fa fa-home me-2"></i> Dashboard</a>

    <!-- Settings with Submenu -->
    <a href="javascript:void(0)" class="settings-toggle">
        <i class="fa fa-gear me-2"></i> Group Fares
        <i class="fa fa-chevron-right toggle-icon"></i>
    </a>
    <div class="submenu">
        <a href="<?php echo e(route('admin.booking.list')); ?>"><i class="fa fa-circle me-2 small"></i> Booking</a>
        <a href="<?php echo e(route('admin.group')); ?>"><i class="fa fa-circle me-2 small"></i> Routes</a>
        <a href="<?php echo e(route('admin.airline.list')); ?>"><i class="fa fa-circle me-2 small"></i> Airline</a>
        <a href="<?php echo e(route('admin.profile.view')); ?>"><i class="fa fa-circle me-2 small"></i> Users</a>
        <a href="#"><i class="fa fa-circle me-2 small"></i> Roles & Permissions</a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\agentbestex\resources\views/admin/layouts/dashboard-sidebar.blade.php ENDPATH**/ ?>