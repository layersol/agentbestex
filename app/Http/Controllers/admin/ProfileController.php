<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Transaction;
use App\Models\FlightsBooking;
use Illuminate\Validation\ValidationException;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index(Request $request): View
    {
       $users = User::with('transactions')
             ->where('status', true)  // Only active users
             ->get();

     return view('admin.users.list', compact('users'));


    }
    public function edit($id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));

    }

    /**
     * Update the user's profile information.
     */


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Handle logo upload if provided
        if ($request->hasFile('agency_logo')) {
            $path = $request->file('agency_logo')->store('agency_logos', 'public');
            $request->merge(['agency_logo' => $path]);
        }

        // Update all fields directly from request
        $user->update($request->all());

        return redirect()->route('admin.profile.view')->with('success', 'User updated successfully.');
    }

    


    /**
     * Add balance to a user (AJAX)
     */
    public function addBalance(Request $request)
    {
         $request->validate([
        'user_id' => 'required|exists:users,id',
        'amount'  => 'required|numeric|min:0.01',
    ]);

    // Find the user
    $user = User::findOrFail($request->user_id);
    $amount = $request->amount;

    // Add balance
    $user->balance += $amount;
    $user->save();

   Transaction::create([
   'user_id' => $user->id,
    'trx_id' => 'TRX'.time().rand(1000,9999),
    'type' => 'credit',
    'date' => now(),
    'payment_gateway' => 'admin_balance',
    'amount' => $amount,
    'currency' => 'INR',
    'description' => 'Balance added by admin',
    'status' => 'completed', // or pending / failed
]);
    return response()->json(['success' => true]);
    }

    public function change()
    {
        return view('backend/update-password-form');
    }


public function payNow(Request $request)
{

        $user = Auth::user();
        $ref_no=$request->all();
    // ✅ Fetch user's latest transaction (current balance)
   // Sum all credits and debits for the user
$totalCredit = Transaction::where('user_id', $user->id)
    ->where('type', 'credit')
    ->sum('amount');
$totalDebit = Transaction::where('user_id', $user->id)
    ->where('type', 'debit')
    ->sum('amount');
// Calculate current balance
$currentBalance = $totalCredit - $totalDebit;
    // ✅ Fetch user's latest booking (ticket price)
    $latestBooking = FlightsBooking::where('booking_ref_no', $ref_no['booking_ref_no'])
    ->first();
    $ticketPrice = $latestBooking->price_original ?? 0;
    // // // ✅ Calculate remaining balance
    $remaining = $currentBalance - $ticketPrice;
    // // ✅ If insufficient funds

   
    if ($remaining < 0) {
        return redirect()->back()->with('error', 'Insufficient balance. Please add funds.');
    }

    
    // ✅ Update user's balance (store remaining in transactions)
    Transaction::create([
        'user_id' => $user->id,
        'trx_id' => $ref_no['booking_ref_no'], // booking reference as trx_id
        'type' => 'debit',
        'date' => Carbon::now(), // current timestamp
        'payment_gateway' => 'Wallet', // optional, adjust as needed
        'amount' => $ticketPrice,
        'currency' => 'INR', // adjust currency as needed
        'description' => 'Ticket purchase for booking ID ' . ($ref_no['booking_ref_no'] ?? 'N/A'),
        'attachment' => null, // optional, can be file path or null
        'status' => 'completed', // or 'pending', adjust logic as needed
    ]);

    // ✅ Optional: mark booking as paid
    if ($latestBooking) {
       // ✅ Update booking status using ID
    FlightsBooking::where('booking_ref_no', $ref_no['booking_ref_no'])->update(['payment_status' => 'paid']);
    }

   return redirect()->route('flights.tickets', ['id' => $ref_no['booking_ref_no']]);

}

}
