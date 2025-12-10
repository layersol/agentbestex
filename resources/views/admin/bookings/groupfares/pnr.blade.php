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
    <h5 class="mb-0">Update PNR</h5>
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





  <form action="{{ route('admin.booking.updatePnr') }}" method="POST">
    @csrf
    {{-- 🧍 Personal Information --}}
    <div class="card shadow-sm">
      <div class="card-header">PNR Information</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <label>booking Reference number</label>
            <input type="text" name="booking_ref_no" class="form-control" value="{{ old('booking_ref_no', $flights['booking_ref_no']) }}" readonly>
          </div>

         

          <div class="col-md-3">
            <label>PNR</label>
            <input type="text" name="pnr" class="form-control" value="{{ old('pnr', $flights['pnr']) }}" required>
          </div>

         
        </div>
      </div>
    </div>

  
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-primary px-4">
        <i class="fa fa-save me-1"></i> Update PNR
      </button>
    </div>
  </form>
</div>
@endsection
