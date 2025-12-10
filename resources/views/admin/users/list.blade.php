@extends('admin.layouts.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="content">
    <div class="topbar d-flex justify-content-between align-items-center mb-3">
        <h5>Dashboard</h5>
        <div>
            <i class="fa fa-bell me-3"></i>
            <i class="fa fa-user-circle"></i>
        </div>
    </div>

    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users Information</h5>
            <a href="{{ route('admin.route.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus me-1"></i> Add New
            </a>
        </div>

        <div class="card-body">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
                        <th>Balance</th>
                        <th>Agency</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_country_code }} {{ $user->phone }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>
                                
                                <button class="btn btn-sm btn-info add-balance-btn" 
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->first_name }} {{ $user->last_name }}"
                                        data-current="{{ $user->current_balance }}">
                                   {{ number_format($user->current_balance, 2) }}
                                </button>
                            </td>
                            <td>{{ $user->agency_name }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <!-- <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Balance Modal -->
<div class="modal fade" id="addBalanceModal" tabindex="-1" aria-labelledby="addBalanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addBalanceForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addBalanceModalLabel">Add Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <input type="text" id="user_name" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Balance</label>
                        <input type="text" id="current_balance" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount to Add</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Balance</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function() {
    $('.add-balance-btn').on('click', function() {
        $('#user_id').val($(this).data('id'));
        $('#user_name').val($(this).data('name'));
        $('#current_balance').val($(this).data('current'));
        $('#amount').val('');
        $('#addBalanceModal').modal('show');
    });

    $('#addBalanceForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("admin.transactions.addBalance") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success){
                    alert('Balance added successfully!');
                    $('#addBalanceModal').modal('hide');
                    location.reload(); // refresh to update displayed balance
                } else {
                    alert('Error: ' + (response.message || 'Unknown error'));
                }
            },
            error: function() {
                alert('Something went wrong!');
            }
        });
    });
});


</script>
@endsection
