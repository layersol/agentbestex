@extends('admin.layouts.dashboard')

@section('content')
    
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
      <div class="row g-3">
        <div class="col-md-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6>Total Users</h6>
              <h3>1,250</h3>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6>Sales</h6>
              <h3>$45,000</h3>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6>Orders</h6>
              <h3>320</h3>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6>Visitors</h6>
              <h3>8,100</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-white">
          <h6 class="mb-0">Recent Orders</h6>
        </div>
        <div class="card-body">
          <table id="example" class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>1</td><td>Ali Khan</td><td>Laptop</td><td>$1200</td><td><span class="badge bg-success">Delivered</span></td></tr>
              <tr><td>2</td><td>Sara Ahmed</td><td>Phone</td><td>$800</td><td><span class="badge bg-warning">Pending</span></td></tr>
              <tr><td>3</td><td>John Doe</td><td>Tablet</td><td>$600</td><td><span class="badge bg-danger">Cancelled</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

