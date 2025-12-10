<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wallet Summary</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #e6ebf1);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wallet-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            width: 370px;
            background-color: #fff;
        }

        .wallet-card:hover {
            transform: translateY(-5px);
        }

        .wallet-header {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white;
            padding: 25px 20px;
        }

        .wallet-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .wallet-body {
            padding: 25px 20px;
        }

        .wallet-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .wallet-item i {
            color: #6c757d;
            margin-right: 8px;
        }

        .wallet-item span.amount {
            font-weight: 600;
        }

        .wallet-footer {
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .btn-add {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            border: none;
            color: #fff;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #00a38b, #86b72f);
        }
    </style>
</head>

<body>

<div class="wallet-card">
    <div class="wallet-header text-center">
        <h4><i class="fa-solid fa-wallet me-2"></i> My Wallet</h4>
    </div>

    <div class="wallet-body">
        <!-- Current Balance -->
        <div class="wallet-item">
            <div><i class="fa-solid fa-money-bill-wave"></i> Current Balance</div>
            <span class="amount text-success">
                @if(isset($UserBalance['balance']))
                    INR {{ number_format($UserBalance['balance'], 2) }}
                @else
                    INR 0.00
                @endif
            </span>
        </div>

        <!-- Ticket Price -->
        <div class="wallet-item">
            <div><i class="fa-solid fa-ticket"></i> Ticket Price</div>
            <span class="amount text-primary">
                @if(isset($UserBalance['ticket_Price']))
                    INR {{ number_format($UserBalance['ticket_Price'], 2) }}
                @else
                    INR 0.00
                @endif
            </span>
        </div>

        <!-- Remaining Balance -->
        <div class="wallet-item mb-3">
            <div><i class="fa-solid fa-scale-balanced"></i> Remaining Balance</div>
            <span class="amount text-warning">
                @php
                    $currentBalance = $UserBalance['balance'] ?? 0;
                    $ticketPrice = $UserBalance['ticket_Price'] ?? 0;
                    $remaining = $currentBalance - $ticketPrice;
                @endphp

                @if($remaining >= 0)
                    INR {{ number_format($remaining, 2) }}
                @else
                    <span class="text-danger fw-bold">Insufficient Balance</span>
                @endif
            </span>
        </div>
    </div>

    <div class="wallet-footer text-center">
        <form id="payForm" action="{{ route('wallet.payNow') }}" method="POST">
            @csrf
            <input type="hidden" id="remaining_balance" value="{{ $remaining }}">
            <input type="hidden" name="booking_ref_no" value="{{ $UserBalance['ticket_ref'] ?? '' }}">
            <button type="submit" id="payNowBtn" class="btn btn-add w-100 py-2">
                <i class="fa fa-plus-circle me-2"></i> Pay Now
            </button>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    var remaining = parseFloat($('#remaining_balance').val());
    var payBtn = $('#payNowBtn');

    // Disable the button if remaining balance is less than 0
    if(remaining < 0){
        payBtn.prop('disabled', true);
        payBtn.text('Insufficient Balance');
        payBtn.addClass('btn-secondary').removeClass('btn-add');
    }

    // Extra safeguard: prevent submission if balance insufficient
    $('#payForm').on('submit', function(e){
        if(remaining < 0){
            e.preventDefault();
            alert('Insufficient balance. Please add funds to your wallet before proceeding.');
        }
    });
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
