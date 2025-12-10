@extends('admin.layouts.dashboard')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="content">
    <div class="topbar">
        <h5>Dashboard</h5>
        <div>
            <i class="fa fa-bell me-3"></i>
            <i class="fa fa-user-circle"></i>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="card mt-4 shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Booking Requests</h5>
               
            </div>

            <div class="card-body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Booking Date</th>
                            <th>Modules</th>
                            <th>Traveller</th>
                            <th>Email</th>
                            <th>Booking Status</th>
                            <th>Payment Status</th>
                            <th>Total</th>
                            <th>PNR</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Booking as $Bookings)
                        <?php $users = json_decode($Bookings['user_data']); ?>
                        <tr>
                            <td>{{ $Bookings['booking_ref_no'] }}</td>
                            <td>{{ $Bookings['booking_date'] }}</td>
                            <td>{{ $Bookings['supplier'] }}</td>
                            <td>{{ $users->first_name.' '.$users->last_name }}</td>
                            <td>{{ $users->email }}</td>
                            <td>{{ $Bookings['booking_status'] }}</td>
                            <td>{{ $Bookings['payment_status'] }}</td>
                            <td>{{ $Bookings['price_original'] }}</td>
                            <td>

                              <a href="{{ $Bookings['pnr'] === null ? route('admin.booking.Pnr', $Bookings['booking_ref_no']) : '#' }}"
   class="btn btn-success btn-sm 
          {{ $Bookings['payment_status'] === 'refunded' || $Bookings['pnr'] !== null ? 'disabled' : '' }}"
   {{ $Bookings['payment_status'] === 'refunded' || $Bookings['pnr'] !== null ? 'aria-disabled="true" tabindex=-1' : '' }}>
   {{ $Bookings['pnr'] ?? 'Set PNR' }}
</a>

                                
                            </td>
                            <td>
                                <a href="{{ route('flights.tickets', $Bookings['booking_ref_no']) }}" class="btn btn-primary btn-sm">View Ticket</a>
                                <button class="btn btn-danger btn-sm cancel-ticket-btn"
            data-id="{{ $Bookings['booking_ref_no'] }}">
       Cancel Ticket
    </button>
                               
                                <a href="{{ route('admin.booking.refund', $Bookings['booking_ref_no']) }}" 
   class="btn btn-success btn-sm {{ $Bookings['payment_status'] === 'refunded' ? 'disabled' : '' }}"
   {{ $Bookings['payment_status'] === 'refunded' ? 'aria-disabled="true" tabindex=-1' : '' }}>
   Refund
</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- PNR Modal -->
<div class="modal fade" id="pnrModal" tabindex="-1" aria-labelledby="pnrModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="pnrForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pnrModalLabel">Update PNR</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="booking_id" name="id">
          <label class="form-label">PNR</label>
          <input type="text" class="form-control" id="pnr_input" name="pnr" required>
          <small class="text-success d-none" id="pnr-saved-msg">Saved!</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save PNR</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')

<script>
$(document).ready(function(){

    // OPEN MODAL
    $(document).on('click', '.update-pnr-btn', function() {
        let modalEl = document.getElementById('pnrModal');
        let modal = bootstrap.Modal.getOrCreateInstance(modalEl);

        $('#booking_id').val($(this).data('id'));
        $('#pnr_input').val($(this).data('pnr') ?? '');
        $('#pnr-saved-msg').addClass('d-none');

        modal.show();
    });

    // SUBMIT FORM
    $('#pnrForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '{{ route("admin.booking.updatePnr") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if(response.success){
                    let id = $('#booking_id').val();
                    let pnr = $('#pnr_input').val();

                    $('.update-pnr-btn[data-id="'+id+'"]').text(pnr).data('pnr', pnr);

                    $('#pnr-saved-msg').removeClass('d-none');

                    setTimeout(() => {
                        let modalEl = document.getElementById('pnrModal');
                        let modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();
                    }, 700);
                }
            },
            error: function(err){
                alert('Error saving PNR!');
            }
        });
    });


// Cancel Ticket
$(document).on('click', '.cancel-ticket-btn', function(){
    let bookingRef = $(this).data('id');
    if(!confirm('Are you sure you want to cancel this ticket?')) return;

    $.ajax({
        url: '{{ route("admin.booking.updatePnr") }}+ bookingRef +' ,
        type: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(res){
            if(res.success){
                alert(res.message);
                location.reload(); // refresh to update status
            } else {
                alert(res.message);
            }
        },
        error: function(err){
            alert('Error canceling ticket!');
        }
    });
});


});
</script>
@endsection
