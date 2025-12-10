<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
class PaymentTransactionsController extends Controller
{
   public function index(request $request)
   {


    $user = Auth::user();

    if (!$user) {
        // Handle user not found or inactive
        abort(404, 'User not found or inactive.');
    }

    // Calculate current balance
    $totalCredit = Transaction::where('user_id', $user->id)
        ->where('type', 'credit')
        ->sum('amount');

    $totalDebit = Transaction::where('user_id', $user->id)
        ->where('type', 'debit')
        ->sum('amount');

    $currentBalance = $totalCredit - $totalDebit;

    // Get ticket price and reference from request safely
    $ticketPrice = $request->input('ticketprice', 0);
    $bookingRef = $request->input('booking_ref_no', null);

    // Prepare array to pass to view
    $UserBalance = [
        'balance' => $currentBalance,
        'ticket_Price' => $ticketPrice,
        'ticket_ref' => $bookingRef,
    ];

    

    return view('admin.users.wallet', compact('UserBalance'));


   }
}
