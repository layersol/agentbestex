 <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mobileToggle = document.getElementById('mobileToggle');
    const toggle = document.querySelector('.settings-toggle');
    const submenu = document.querySelector('.submenu');

    // Mobile sidebar toggle
    mobileToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Submenu toggle
    toggle.addEventListener('click', function() {
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        toggle.classList.toggle('active');
    });

    // Highlight menu item based on current URL
    const currentPath = window.location.pathname;
    const links = document.querySelectorAll('.sidebar a');

    links.forEach(link => {
        const linkPath = link.getAttribute('href');

        if (linkPath === currentPath || currentPath.includes(linkPath)) {
            if (link.closest('.submenu')) {
                link.classList.add('active-sub');
                link.closest('.submenu').style.display = 'block';
                toggle.classList.add('active');
            } else {
                link.classList.add('active');
            }
        }

        // Click highlight for dynamic navigation
        link.addEventListener('click', function() {
            links.forEach(l => l.classList.remove('active', 'active-sub'));
            if (this.closest('.submenu')) {
                this.classList.add('active-sub');
                toggle.classList.add('active');
                submenu.style.display = 'block';
            } else {
                this.classList.add('active');
            }
        });
    });
});


  </script>
</body>
</html><?php /**PATH C:\wamp64\www\BestexTravel\agentbestex\resources\views/admin/layouts/dashboard-footer.blade.php ENDPATH**/ ?>