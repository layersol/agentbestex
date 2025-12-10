<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard To manage whole inventory</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }

   /* Sidebar default */
/* Sidebar default */
.sidebar {
    width: 250px;
    height: 100vh;
    background: #1c1c1c;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    transition: all 0.3s ease;
    z-index: 1000;
}

.sidebar a {
    display: block;
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 5px;
}

.sidebar a.active,
.sidebar a.active-sub {
    background-color: #007bff;
    color: #fff;
}

.submenu {
    display: none;
    padding-left: 15px;
}

.submenu a {
    padding: 8px 15px;
    font-size: 0.9rem;
}

/* Toggle icon rotation */
.settings-toggle.active .toggle-icon {
    transform: rotate(90deg);
    transition: transform 0.3s ease;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .sidebar {
        left: -260px;
    }

    .sidebar.active {
        left: 0;
    }

    .mobile-toggle {
        position: fixed;
        top: 15px;
        left: 15px;
        background: #1c1c1c;
        border: none;
        color: #fff;
        font-size: 1.5rem;
        padding: 10px 15px;
        border-radius: 5px;
        z-index: 1100;
        cursor: pointer;
    }
}

    .content {
      margin-left: 240px;
      padding: 20px;
    }

    .topbar {
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .toggle-icon {
      float: right;
      transition: transform 0.3s ease;
    }

    .rotate {
      transform: rotate(90deg);
    }
  </style>
</head>
<body><?php /**PATH C:\wamp64\www\BestexTravel\agentbestex\resources\views/admin/layouts/dashboard-header.blade.php ENDPATH**/ ?>