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



         
 @if(!empty($route))
    <div class="topbar">
        <h5> Selected Route: {{ $route['origin'] }} - {{ $route['destination'] }}</h5>
    </div>

    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Flight Information</h5>
            <a href="{{ route('admin.gfares.create', $route['id']) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus me-1"></i> Add New
            </a>
        </div>
@else
    
@endif
                
               <div class="card-body">
    @if(!empty($flights) && count($flights) > 0)
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dates</th>
                    <th>Times</th>
                    <th>Airline</th>
                    <th>Adult Price</th>
                    <th>Child Price</th>
                    <th>Infant Price</th>
                    <th>Baggage</th>
                    <th>Hand Baggage</th>
                    <th>PNR</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $route)
                    <tr>
                        <td>{{ $route->id }}</td>
                        <td>{{ $route->departure_date }}</td>
                        <td>{{ $route->departure_time }} - {{ $route->arrival_time }}</td>
                        <td>{{ $route->code }} ({{ $route->number }})</td>
                        <td>{{ $route->adult_price }}</td>
                        <td>{{ $route->child_price }}</td>
                        <td>{{ $route->infant_price }}</td>
                        <td>{{ $route->baggaes }}KG</td>
                        <td>{{ $route->handBaggage }}KG</td>
                        <td>{{ $route->PNR}}</td>
                        <td>{{ $route->seats }} Seats</td>
                        <td>{{ $route->status }}</td>
                        <td><a href="{{ route('admin.gfares.edit', $route->id) }}" class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning text-center">
            No flights found for this route.
        </div>
    @endif
</div>
            </div>
        </div>
    </div>
@endsection