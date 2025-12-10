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
         
 <div class="topbar">
      <h5>Form Example</h5>
    </div>
            <div class="card mt-4 shadow-sm border-0">
                 <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Routes Information</h5>
        <a href="{{ route('admin.route.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus me-1"></i> Add New</a>
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
                            @foreach($routes as $route)

 
      <tr>
         <td>{{ $route['id'] }}</td>
        <td>{{ $route['origin'] }}</td>
        <td>{{ $route['destination'] }}</td>
       
        <td>{{ $route['status'] }}</td>
         <td>{{ $route['created_at'] }}</td>
        <td><a href="{{ route('admin.gfares.list', $route['id']) }}" class="btn btn-primary">Edit</a></td>
      </tr>
    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection