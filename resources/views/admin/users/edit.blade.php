@extends('admin.layouts.dashboard')

@section('content')
<style>
  body { background-color: #f8f9fa; }
  .content { margin-left: 240px; padding: 20px; }
  .card { border-radius: 12px; margin-bottom: 25px; border: none; }
  .card-header { background: #fff; border-bottom: 1px solid #dee2e6; font-weight: 600; }
  label { font-weight: 500; }
</style>

<div class="content">
  <div class="topbar d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Edit User</h5>
    <a href="{{ route('admin.profile.view') }}" class="btn btn-sm btn-secondary">
      <i class="fa fa-arrow-left me-1"></i> Back to List
    </a>
  </div>

  {{-- Success Message --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Validation Errors --}}
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- 🧍 Personal Information --}}
    <div class="card shadow-sm">
      <div class="card-header">Personal Information</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
          </div>

          <div class="col-md-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
          </div>

          <div class="col-md-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          </div>

          <div class="col-md-3">
            <label>User Type</label>
            <select name="user_type" class="form-control">
              <option value="agent" {{ $user->user_type == 'agent' ? 'selected' : '' }}>Agent</option>
              <option value="customer" {{ $user->user_type == 'customer' ? 'selected' : '' }}>Customer</option>
              <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    {{-- ☎️ Contact & Account --}}
    <div class="card shadow-sm">
      <div class="card-header">Contact & Account</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <label>Phone</label>
            <div class="input-group">
              <span class="input-group-text">{{ $user->phone_country_code ?? '+00' }}</span>
              <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>
          </div>

          <div class="col-md-3">
            <label>Country Code</label>
            <input type="text" name="country_code" class="form-control" value="{{ old('country_code', $user->country_code) }}">
          </div>

          <div class="col-md-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
              <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    {{-- 🏠 Address Information --}}
    <div class="card shadow-sm">
      <div class="card-header">Address Information</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
          </div>

          <div class="col-md-3">
            <label>State</label>
            <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}">
          </div>

          <div class="col-md-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user->postal_code) }}">
          </div>

          <div class="col-md-3">
            <label>Address</label>
            <textarea name="address1" class="form-control" rows="1">{{ old('address1', $user->address1) }}</textarea>
          </div>
        </div>
      </div>
    </div>

    {{-- 🏢 Agency Details --}}
    <div class="card shadow-sm">
      <div class="card-header">Agency Details</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <label>Agency Name</label>
            <input type="text" name="agency_name" class="form-control" value="{{ old('agency_name', $user->agency_name) }}">
          </div>

          <div class="col-md-3">
            <label>Agency License</label>
            <input type="text" name="agency_license" class="form-control" value="{{ old('agency_license', $user->agency_license) }}">
          </div>

          <div class="col-md-3">
            <label>Agency City</label>
            <input type="text" name="agency_city" class="form-control" value="{{ old('agency_city', $user->agency_city) }}">
          </div>

          <div class="col-md-3">
            <label>Agency Logo</label><br>
            @if($user->agency_logo)
              <img src="{{ asset('storage/' . $user->agency_logo) }}" alt="Logo" width="60" class="mb-2 rounded">
            @endif
            <input type="file" name="agency_logo" class="form-control">
          </div>

          <div class="col-md-12">
            <label>Agency Address</label>
            <textarea name="agency_address" class="form-control" rows="2">{{ old('agency_address', $user->agency_address) }}</textarea>
          </div>
        </div>
      </div>
    </div>

    {{-- 💰 Markup Settings --}}
    <div class="card shadow-sm">
      <div class="card-header">Markup Settings</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <label>Markup Hotels (%)</label>
            <input type="number" name="markup_hotels" class="form-control" value="{{ old('markup_hotels', $user->markup_hotels) }}">
          </div>
          <div class="col-md-3">
            <label>Markup Flights (%)</label>
            <input type="number" name="markup_flights" class="form-control" value="{{ old('markup_flights', $user->markup_flights) }}">
          </div>
          <div class="col-md-3">
            <label>Markup Tours (%)</label>
            <input type="number" name="markup_tours" class="form-control" value="{{ old('markup_tours', $user->markup_tours) }}">
          </div>
          <div class="col-md-3">
            <label>Markup Cars (%)</label>
            <input type="number" name="markup_cars" class="form-control" value="{{ old('markup_cars', $user->markup_cars) }}">
          </div>
        </div>
      </div>
    </div>

    <div class="text-end mt-4">
      <button type="submit" class="btn btn-primary px-4">
        <i class="fa fa-save me-1"></i> Update User
      </button>
    </div>
  </form>
</div>
@endsection
