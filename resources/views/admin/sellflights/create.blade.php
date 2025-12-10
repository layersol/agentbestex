@extends('admin.layouts.dashboard')

@section('content')
  <style>
    body {
      background-color: #f8f9fa;
    }

    .sidebar {
      position: fixed;
      height: 100vh;
      width: 240px;
      background: #343a40;
      color: white;
      padding-top: 1rem;
    }

    .sidebar a {
      color: #adb5bd;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background: #495057;
      color: #fff;
    }

    .content {
      margin-left: 240px;
      padding: 20px;
    }

    .topbar {
      background: #fff;
      padding: 10px 20px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .form-group {
      margin-bottom: 1rem;
    }
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
        <h5 class="mb-0">Flight Information : {{ $flight->departure_airport ?? $route['origin'] }} -
          {{ $flight->arrival_airport ?? $route['destination'] }}</h5>

      </div>

      <div class="card-body">
        <form id="flightForm" method="POST" action="{{ route('admin.gfares.storeOrUpdate') }}">
          @csrf

          {{-- Hidden input for flight ID (edit mode) --}}
          @if(isset($flight))
            <input type="hidden" name="id" value="{{ $flight->id }}">
          @endif

          {{-- Hidden input for route_id --}}
          <input type="hidden" name="route_id" value="{{ $flight->route_id ?? $route['id'] }}">
          <input type="hidden" class="form-control" name="departure_airport"
            value="{{ $flight->departure_airport ?? $route['origin'] }}" readonly>
 <input type="hidden" class="form-control" name="arrival_airport"
                           value="{{ $flight->arrival_airport ?? $route['destination'] }}" readonly>
            <div class="row">
            <!-- Column 1 -->
            <div class="col-md-3">
             
              <div class="form-group">
                <label>Departure Date</label>
                <input type="date" class="form-control" name="departure_date"
                  value="{{ $flight->departure_date ?? old('departure_date') }}" required>
                   <input type="hidden" class="form-control" name="return_date"
                  value="{{ $flight->return_date ?? old('return_date') }}">
              </div>
              <div class="form-group">
                <label>Departure Time</label>
                <input type="time" class="form-control" name="departure_time"
                  value="{{ $flight->departure_time ?? old('departure_time') }}" required>
              </div>
              <div class="form-group">
                <label>Arrival Time</label>
                <input type="time" class="form-control" name="arrival_time"
                  value="{{ $flight->arrival_time ?? old('arrival_time') }}" required>
              </div>
              <div class="form-group">
                <label>Airline</label>
                <select class="form-control select2" name="airline_id" id="airlineSelect" required>
                  <option value="">Select Airline</option>
                  @foreach($airlines as $airline)
                    <option value="{{ $airline->id }}" data-code="{{ $airline->code }}" {{ (isset($flight) && $flight->airline_id == $airline->id) || old('airline_id') == $airline->id ? 'selected' : '' }}>
                      {{ $airline->name }}
                    </option>
                  @endforeach
                </select>
              </div>

            </div>

            <!-- Column 2 -->
            <div class="col-md-3">
            
              <div class="form-group">
                <label>Flight Code</label>
                <input type="text" class="form-control" name="code" id="flightCode"
                  value="{{ $flight->code ?? old('code') }}" placeholder="Flight Code" required>
              </div>
                     <div class="form-group">
                <label>Flight Number</label>
                <input type="text" class="form-control" name="number" value="{{ $flight->number ?? old('number') }}"
                  placeholder="Flight Number" required>
              </div>
              <div class="form-group">
                <label>Baggage (KG)</label>
                <input type="number" class="form-control" name="baggaes" value="{{ $flight->baggaes ?? old('baggaes') }}"
                  placeholder="Baggage" required>
              </div>

              <div class="form-group">
                <label>Hand Baggage</label>
                <input type="number" class="form-control" name="handBaggage" value="{{ $flight->handBaggage ?? old('handBaggage') }}"
                  placeholder="Hand Baggage" required>
              </div>

             
            </div>

            <!-- Column 3 -->
            <div class="col-md-3">
       
              <div class="form-group">
                <label>Currency</label>
                <input type="text" class="form-control" name="currency" value="{{ $flight->currency ?? old('currency') }}"
                  placeholder="Currency (e.g. USD)" required>
              </div>

                <div class="form-group">
                <label>Adult Price</label>
                <input type="number" class="form-control" name="adult_price"
                  value="{{ $flight->adult_price ?? old('adult_price') }}" placeholder="Adult Price" required>
              </div>
              <div class="form-group">
                <label>Child Price</label>
                <input type="number" class="form-control" name="child_price"
                  value="{{ $flight->child_price ?? old('child_price') }}" placeholder="Child Price" required>
              </div>
              <div class="form-group">
                <label>Infant Price</label>
                <input type="number" class="form-control" name="infant_price"
                  value="{{ $flight->infant_price ?? old('infant_price') }}" placeholder="Infant Price" required>
              </div>

            </div>

            <!-- Column 4 -->
            <div class="col-md-3">
            

               <div class="form-group">
                <label>Seats</label>
                <input type="number" class="form-control" name="seats" value="{{ $flight->seats ?? old('seats') }}"
                  placeholder="Seats" required>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                  <option value="">Select Status</option>
                  <option value="1" {{ (isset($flight) && $flight->status == 'YES') ? 'selected' : '' }}>YES</option>
                  <option value="0" {{ (isset($flight) && $flight->status == 'NO') ? 'selected' : '' }}>NO</option>
                </select>
              </div>

             

              <div class="form-group">
    <label>PNR (Do you have a PNR?)</label>
    <select class="form-control" name="" id="pnrStatus" required>
        <option value="">Select Status</option>
        <option value="YES" >YES</option>
        <option value="NO">NO</option>
    </select>
</div>

<div class="form-group" id="pnrBox" style="display: none;">
    <label>Enter PNR</label>
    <input type="text" class="form-control" name="PNR" value="{{ $flight->PNR ?? old('PNR') }}">
</div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="row mt-3">
            <div class="col-md-12 text-end">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-save me-1"></i> {{ isset($flight) ? 'Update Flight' : 'Save Flight' }}
              </button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>


  <!-- jQuery (required) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>

    document.getElementById('pnrStatus').addEventListener('change', function () {
    let box = document.getElementById('pnrBox');
    let input = box.querySelector('input');

    if (this.value === 'YES') {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
        input.value = ""; // clear value
    }
});


    $(document).ready(function () {
      $('#airlineSelect').on('change', function () {
        var code = $(this).find(':selected').data('code'); // get airline code
        $('#flightCode').val(code); // fill the flight code input
      });

      // Optional: trigger change on page load for edit mode
      $('#airlineSelect').trigger('change');
    });


    $(document).ready(function () {
      $('.select2').select2({
        placeholder: "Select Airline",
        allowClear: true
      });
    });
  </script>
@endsection