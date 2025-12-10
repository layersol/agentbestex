@extends('admin.layouts.dashboard')

@section('content')
<style>
  body { background-color: #f8f9fa; }

  /* list hover */
  .list-group-item:hover { background-color: #f0f8ff; cursor: pointer; }

  /* Sidebar (kept) */
  .sidebar { position: fixed; height: 100vh; width: 240px; background: #343a40; color: white; padding-top: 1rem; }
  .sidebar a { color: #adb5bd; display: block; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
  .sidebar a.active, .sidebar a:hover { background: #495057; color: #fff; }

  /* Content & topbar */
  .content { margin-left: 240px; padding: 20px; min-height: 100vh; }
  .topbar { background: #fff; padding: 10px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); display:flex; justify-content:space-between; align-items:center; border-radius:8px; }

  /* Card */
  .card { max-width: 700px; margin-top: 30px; border-radius: 12px; }
  .card-header { background-color: #fff !important; border-bottom: 1px solid #dee2e6; }

  /* Autocomplete wrapper/list */
  .autocomplete-wrapper { position: relative; }
  .autocomplete-list { position: absolute; top: 100%; left: 0; right: 0; z-index: 1000; background: #fff; border: 1px solid #dee2e6; border-top: none; border-radius: 0 0 6px 6px; box-shadow: 0 4px 14px rgba(0,0,0,0.06); max-height: 300px; overflow-y: auto; padding: 6px 0; }

  /* unified item layout */
  .auto-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 12px;
    border-radius: 6px;
    color: #212529;
    text-decoration: none;
  }
  .auto-item + .auto-item { margin-top: 6px; }

  /* left - logo/avatar */
  .auto-left {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    flex: 0 0 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: linear-gradient(135deg,#e9eefb,#f7fbff);
    border: 1px solid #eef3ff;
  }
  .auto-left img { width: 100%; height: 100%; object-fit: cover; display:block; }

  /* fallback initials */
  .auto-initials {
    font-weight: 700;
    color: #1b3a8a;
    font-size: 14px;
  }

  /* content */
  .auto-main { flex: 1 1 auto; min-width: 0; }
  .auto-title { font-weight: 600; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .auto-sub { font-size: 12px; color: #6c757d; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

  /* airport code badge on right */
  .auto-code {
    margin-left: 8px;
    font-weight: 700;
    color: #0b5ed7;
    background: rgba(11,94,215,0.08);
    border: 1px solid rgba(11,94,215,0.12);
    padding: 6px 8px;
    border-radius: 6px;
    font-size: 12px;
    flex: 0 0 auto;
  }

  /* visual hover */
  .auto-item:hover { background: #f5f9ff; }

  /* small screens */
  @media (max-width: 992px) {
    .content { margin-left: 0; padding: 15px; }
    .card { max-width: 100%; }
  }

  /* form labels & button */
  .form-group label { font-weight: 500; }
  .btn-primary { padding: 10px 25px; font-size: 15px; border-radius: 6px; }
</style>

<div class="content">
  <div class="topbar">
    <h5 class="mb-0">Group Fares Dashboard</h5>
    <div><i class="fa fa-bell me-3"></i><i class="fa fa-user-circle"></i></div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Flight Information</h5>
    </div>

    <div class="card-body">
      <form id="flightForm" method="POST" action="{{ route('admin.gfares.storeOrUpdate') }}">
        @csrf
        @if(isset($flight)) <input type="hidden" name="id" value="{{ $flight->id }}"> @endif

        <div class="row">
          <div class="col-md-12">

            <!-- Departure -->
            <div class="form-group mb-3 autocomplete-wrapper">
              <label>Departure Airport</label>
              <input type="text" id="departure_airport" class="form-control" placeholder="Enter departure airport or city...">
              <input type="hidden" id="departure_code" name="departure_code">
              <div id="departureList" class="autocomplete-list"></div>
            </div>

            <!-- Arrival -->
            <div class="form-group mb-3 autocomplete-wrapper">
              <label>Arrival Airport</label>
              <input type="text" id="arrival_airport" class="form-control" placeholder="Enter arrival airport or city...">
              <input type="hidden" id="arrival_code" name="arrival_code">
              <div id="arrivalList" class="autocomplete-list"></div>
            </div>

            <!-- Airline (styled autocomplete) -->
            <div class="form-group mb-3 autocomplete-wrapper">
              <label>Airline</label>
              <input type="text" id="airline_name" class="form-control" placeholder="Enter airline name or code...">
              <input type="hidden" id="airline_id" name="airline_id">
              <div id="airlineList" class="autocomplete-list"></div>
            </div>

            <!-- Status -->
            <div class="form-group mb-3">
              <label>Status</label>
              <select class="form-control" name="status" required>
                <option value="">Select Status</option>
                <option value="1" {{ (isset($flight) && $flight->status == 1) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ (isset($flight) && $flight->status == 0) ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>

          </div>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-save me-1"></i> {{ isset($flight) ? 'Update Flight' : 'Save Flight' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {

  // helper to build airline item HTML (shows logo or initials)
  function buildAirlineHTML(item) {
    // item fields expected: id, name, code, logo (optional)
    let logoHtml = '';
    if (item.logo) {
      // show image, fallback handled by onerror to hide
      logoHtml = `<div class="auto-left"><img src="${item.logo}" alt="${item.name}" onerror="this.style.display='none'"></div>`;
    } else {
      // fallback initials (use code or initials from name)
      let initials = (item.code && item.code.length <= 3) ? item.code : (item.name || '').split(' ').map(w => w[0]).slice(0,2).join('').toUpperCase();
      logoHtml = `<div class="auto-left"><div class="auto-initials">${initials}</div></div>`;
    }

    let title = `${item.name || ''}`;
    let subtitle = item.code ? item.code.toUpperCase() : '';

    return `
      <a href="#" class="auto-item auto-airline" data-id="${item.id}" data-code="${item.code}" data-name="${item.name}">
        ${logoHtml}
        <div class="auto-main">
          <div class="auto-title">${title}</div>
          <div class="auto-sub">${subtitle}</div>
        </div>
        <div class="auto-code">${item.code ? item.code.toUpperCase() : ''}</div>
      </a>
    `;
  }

  // helper to build airport item HTML
  function buildAirportHTML(item) {
    // item fields expected: id, airport, city, country, code
    let title = `${item.airport || ''}`;
    let subtitle = `${item.city || ''}${ item.country ? ', ' + item.country : '' }`;
    return `
      <a href="#" class="auto-item auto-airport" data-id="${item.id}" data-code="${item.code}" data-name="${item.airport}">
        <div class="auto-left"><div class="auto-initials">${(item.code||'').toUpperCase()}</div></div>
        <div class="auto-main">
          <div class="auto-title">${title}</div>
          <div class="auto-sub">${subtitle}</div>
        </div>
        <div class="auto-code">${(item.code||'').toUpperCase()}</div>
      </a>
    `;
  }

  // generic AJAX autocomplete
  function setupAutocomplete(inputSelector, listSelector, hiddenSelector, routeUrl, builderFn) {
    $(inputSelector).on('input', function () {
      let q = $(this).val().trim();
      if (q.length < 2) {
        $(listSelector).empty();
        return;
      }

      $.ajax({
        url: routeUrl,
        method: 'GET',
        data: { query: q },
        success: function (res) {
          $(listSelector).empty();
          if (!res || res.length === 0) {
            $(listSelector).append('<div class="list-group-item text-muted">No results found</div>');
            return;
          }
          res.forEach(item => {
            $(listSelector).append(builderFn(item));
          });
        },
        error: function () {
          $(listSelector).empty().append('<div class="list-group-item text-danger">Search failed</div>');
        }
      });
    });

    // click handler
    $(document).on('click', listSelector + ' .auto-item', function (e) {
      e.preventDefault();
      let $el = $(this);
      let name = $el.data('name') || $el.find('.auto-title').text().trim();
      let code = $el.data('code') || '';
      let id = $el.data('id') || '';

      // set display in input and hidden value
      $(inputSelector).val((code ? code.toUpperCase() + ' - ' : '') + name);
      $(hiddenSelector).val(id || code);

      // clear list
      $(listSelector).empty();
    });

    // close list when clicking outside
    $(document).on('click', function(e) {
      if (!$(e.target).closest(inputSelector).length && !$(e.target).closest(listSelector).length) {
        $(listSelector).empty();
      }
    });
  }

  // Initialize autocompletes
  setupAutocomplete('#departure_airport', '#departureList', '#departure_code', "{{ route('airports.search') }}", buildAirportHTML);
  setupAutocomplete('#arrival_airport', '#arrivalList', '#arrival_code', "{{ route('airports.search') }}", buildAirportHTML);
  setupAutocomplete('#airline_name', '#airlineList', '#airline_id', "{{ route('airlines.search') }}", buildAirlineHTML);

});
</script>
@endsection
