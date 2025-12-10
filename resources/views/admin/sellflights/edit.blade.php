@extends('admin.layouts.dashboard')

@section('content')
<style>
  body { background-color: #f8f9fa; }
  .sidebar { position: fixed; height: 100vh; width: 240px; background: #343a40; color: white; padding-top: 1rem; }
  .sidebar a { color: #adb5bd; display: block; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
  .sidebar a.active, .sidebar a:hover { background: #495057; color: #fff; }
  .content { margin-left: 240px; padding: 20px; }
  .topbar { background: #fff; padding: 10px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
  .form-group { margin-bottom: 1rem; }
</style>

<div class="content">
  <div class="topbar">
    <h5>Group Fares Dashboard</h5>
    <div>
      <i class="fa fa-bell me-3"></i>
      <i class="fa fa-user-circle"></i>
    </div>
  </div>

  <div class="card mt-4 shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Flight Information</h5>
    </div>

    <div class="card-body">
      <form id="flightForm" method="POST" action="{{route('admin.gfares.storeOrUpdate') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $flight->id }}"> {{-- hidden field for flight ID --}}

        <div class="row">
          <!-- Column 1 -->
          <div class="col-md-3">
            
            <div class="form-group">
              <label>Departure Airport</label>
              <input type="text" name="departure_airport" class="form-control" value="{{ $flight->departure_airport }}" readonly>
            </div>
            <div class="form-group">
              <label>Arrival Airport</label>
              <input type="text" name="arrival_airport" class="form-control" value="{{ $flight->arrival_airport }}" readonly>
            </div>
            <div class="form-group">
              <label>Departure Date</label>
              <input type="date" name="departure_date" class="form-control" value="{{ $flight->departure_date }}" required>
            </div>
            <div class="form-group">
              <label>Return Date</label>
              <input type="date" name="return_date" class="form-control" value="{{ $flight->return_date }}" required>
            </div>
          </div>

          <!-- Column 2 -->
          <div class="col-md-3">
            <div class="form-group">
              <label>Departure Time</label>
              <input type="time" name="departure_time" class="form-control" value="{{ $flight->departure_time }}" required>
            </div>
            <div class="form-group">
              <label>Arrival Time</label>
              <input type="time" name="arrival_time" class="form-control" value="{{ $flight->arrival_time }}" required>
            </div>
            <div class="form-group">
              <label>Airline ID</label>
              <input type="text" name="airline_id" class="form-control" value="{{ $flight->airline_id }}" required>
            </div>
            <div class="form-group">
              <label>Flight Code</label>
              <input type="text" name="code" class="form-control" value="{{ $flight->code }}" required>
            </div>
          </div>

          <!-- Column 3 -->
          <div class="col-md-3">
            <div class="form-group">
              <label>Flight Number</label>
              <input type="text" name="number" class="form-control" value="{{ $flight->number }}" required>
            </div>
            <div class="form-group">
              <label>Baggage (KG)</label>
              <input type="number" name="baggaes" class="form-control" value="{{ $flight->baggaes }}" required>
            </div>
            <div class="form-group">
              <label>Seats</label>
              <input type="number" name="seats" class="form-control" value="{{ $flight->seats }}" required>
            </div>
            <div class="form-group">
              <label>Currency</label>
              <input type="text" name="currency" class="form-control" value="{{ $flight->currency }}" required>
            </div>
          </div>

          <!-- Column 4 -->
          <div class="col-md-3">
            <div class="form-group">
              <label>Adult Price</label>
              <input type="number" name="adult_price" class="form-control" value="{{ $flight->adult_price }}" required>
            </div>
            <div class="form-group">
              <label>Child Price</label>
              <input type="number" name="child_price" class="form-control" value="{{ $flight->child_price }}" required>
            </div>
            <div class="form-group">
              <label>Infant Price</label>
              <input type="number" name="infant_price" class="form-control" value="{{ $flight->infant_price }}" required>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="active" {{ $flight->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $flight->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Update Flight</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
