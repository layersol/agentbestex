<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\airlines;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Routes;
use App\Models\GroupFlight;
use App\Models\Airline;
use App\Models\FlightsBooking;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class BookingManageController extends Controller
{


    public function bookingList()
    {
        $Booking = FlightsBooking::with('User')->get();
        $Booking = json_decode($Booking, true);

        return view('admin.bookings.groupfares.list', compact('Booking'));

    }

    public function PNR($booking_ref_no)
    {


        $flights = FlightsBooking::where('booking_ref_no', $booking_ref_no)->first();

        $flights = json_decode($flights, true);

        // print_r($flights);
        return view('admin.bookings.groupfares.pnr', compact('flights'));
    }


    // Update PNR via AJAX
    public function updatePNR(Request $request)
    {

        $validated = $request->validate([
            'booking_ref_no' => 'required|string|max:255',
            'pnr' => 'nullable|string|max:10',
        ]);

        FlightsBooking::where('booking_ref_no', $validated['booking_ref_no'])
            ->update(['pnr' => $validated['pnr']], ['booking_status' => 'confirmed']);



        return redirect()->route('bookings.list')->with('success', 'User updated successfully.');
    }


    public function index()
    {
        $route = Routes::all();
        $routes = json_decode($route, true);
        return view('admin.routes.list', compact('routes'));

    }
    public function flightlist(int $id)
    {
        $route = Routes::find($id);
        // return view('admin/sellflights/list',compact('route'));
        $flights = \DB::table('groupflights')
            ->join('routes', 'groupflights.route_id', '=', 'routes.id')
            ->select('groupflights.*', 'routes.origin', 'routes.destination')
            ->where('groupflights.route_id', $id)
            ->get()
            ->toArray();



        // print_r($route);

        return view('admin.sellflights.list', compact('flights', 'route'));




    }

    public function create(int $id)
    {
        $route = Routes::find($id);
        $airlines = Airline::all(); // fetch all airlines
        // return view('admin.sellflights.create', compact('$id'));

        return view('admin.sellflights.create', compact('route', 'airlines'));
    }

    public function edit(int $id)
    {

        $flight = GroupFlight::find($id);
        $airlines = Airline::all(); // fetch all airlines
        // return view('admin.sellflights.create', compact('$id'));

        return view('admin.sellflights.create', compact('flight', 'airlines'));
    }




    public function storeOrUpdate(Request $request)
    {

        // Check if flight ID exists to update, otherwise create new
        if ($request->has('id') && $request->id) {
            // Update existing flight
            $flight = GroupFlight::findOrFail($request->id);
            $flight->update($request->only([
                'departure_airport',
                'arrival_airport',
                'departure_date',
                'return_date',
                'departure_time',
                'arrival_time',
                'airline_id',
                'code',
                'number',
                'baggaes',
                'handBaggage',
                'seats',
                'adult_price',
                'child_price',
                'infant_price',
                'currency',
                'status',
                'PNR',
            ]));
            $message = 'Flight updated successfully!';
        } else {
            // Create new flight
            $flight = GroupFlight::create($request->only([
                'route_id',
                'departure_airport',
                'arrival_airport',
                'departure_date',
                'return_date',
                'departure_time',
                'arrival_time',
                'airline_id',
                'code',
                'number',
                'baggaes',
                'handBaggage',
                'seats',
                'adult_price',
                'child_price',
                'infant_price',
                'currency',
                'status',
                'PNR',
            ]));
            $message = 'Flight created successfully!';
        }

        // Redirect to list page with success message
        return redirect()->route('admin.gfares.list', ['id' => $request->route_id])
            ->with('success', $message);
    }


    public function update(Request $request)
    {


        $request->validate([
            'departure_airport' => 'required|string|max:255',
            'arrival_airport' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'airline_id' => 'required|integer|exists:airlines,id',
            'code' => 'required|string|max:10',
            'number' => 'required|string|max:10',
            'baggaes' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'adult_price' => 'required|numeric|min:0',
            'child_price' => 'required|numeric|min:0',
            'infant_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:5',
            'status' => 'required|in:active,inactive',
        ]);

        $flight = GroupFlight::findOrFail($request->id);

        $flight->update($request->only([
            'departure_airport',
            'arrival_airport',
            'departure_date',
            'return_date',
            'departure_time',
            'arrival_time',
            'airline_id',
            'code',
            'number',
            'baggaes',
            'seats',
            'adult_price',
            'child_price',
            'infant_price',
            'currency',
            'status'
        ]));

        // return redirect()->route('admin.gfares.list', ['id' => $request['route_id']])
        //  ->with('success', 'Flight updated successfully!');
    }


    // Cancel Ticket
    public function cancelTicket(Request $request, $bookingRef)
    {
        $booking = FlightsBooking::where('booking_ref_no', $bookingRef)->firstOrFail();

        // Only cancel if not already canceled
        if ($booking->booking_status != 'Canceled') {
            $booking->booking_status = 'Canceled';
            $booking->save();

            return response()->json(['success' => true, 'message' => 'Booking canceled successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Booking already canceled']);
    }

    // Refund Ticket
    public function refundTicket($id)
    {




        $user = Auth::user();
        $ref_no = $id;
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
        $latestBooking = FlightsBooking::where('booking_ref_no', $id)
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
            'trx_id' => $id, // booking reference as trx_id
            'type' => 'credit',
            'date' => Carbon::now(), // current timestamp
            'payment_gateway' => 'Wallet', // optional, adjust as needed
            'amount' => $ticketPrice,
            'currency' => 'INR', // adjust currency as needed
            'description' => 'Ticket Refund for booking ID ' . ($id ?? 'N/A'),
            'attachment' => null, // optional, can be file path or null
            'status' => 'refund', // or 'pending', adjust logic as needed
        ]);

        // ✅ Optional: mark booking as paid
        if ($latestBooking) {
            // ✅ Update booking status using ID
            FlightsBooking::where('booking_ref_no', $id)->update(['payment_status' => 'refunded']);
        }

        return redirect()->route('admin.booking.list');

    }


    // public function viewTicket($id){
    //     $ticket=Ticket::with('passengers')->find($id);

    //     return view('backend/bookings/ticket-view',compact('ticket'));

    // }

    // public function editTicket($id){
    //     $ticket=Ticket::with('passengers')->findorfail($id);
    //     return view('backend/bookings/ticket-edit',compact('ticket'));
    // }

    // public function updatePassengers(Request $request, $id)
    // {
    //     $passengerData = $request->only(['title', 'name', 'surname']);
    //     $ticket=Ticket::find($id);
    //     foreach ($passengerData['title'] as $index => $title) {
    //         $passengerId = $request->input('passenger_ids')[$index];
    //         $ticket->passengers()->where('id', $passengerId)->update([
    //             'title' => $title,
    //             'name' => $passengerData['name'][$index],
    //             'surname' => $passengerData['surname'][$index],
    //         ]);
    //     }

    //     return redirect()->route('/booking-list')->with('success','Passengers data updated');

    // }

    public function cancelbooking($id)
    {
        $user = auth()->user();
        $ticket = Ticket::findOrFail($id);

        if (!($user->hasPermissionTo('manage all bookings') || $ticket->user_id === $user->id)) {
            return redirect()->back()->with('error', 'You are not authorized to  this .');
        }

        // Check if the ticket is already cancelled
        if ($ticket->ticket_status == 'cancelled') {
            return redirect()->route('/booking-list')->with('error', 'Ticket is already cancelled');
        }

        // Update the ticket status to 'cancelled'
        $ticket->ticket_status = 'cancelled';
        $ticket->save();

        return redirect()->route('/booking-list')->with('success', 'Booking cancelled');
    }

    // public function bookingInquiry($id = null)
    // {
    //     // Get the authenticated user ID
    //     $authUserId = Auth::id();

    //     if ($id) {
    //         // Fetch the inquiry by ID with the 'viewedBy' relationship
    //         $inquiries = Inquiry::with('viewedBy')->find($id);

    //         if ($inquiries) {
    //             // Set the status to 'inactive'
    //             $inquiries->status = 'inactive';

    //             // Set the 'view_by' column to the authenticated user's ID
    //             $inquiries->view_by = $authUserId;

    //             // Save the changes
    //             $inquiries->save();
    //         }
    //         $query=$inquiries;
    //         return view('backend/bookings/inquiries/inquiry-single', compact('query'));
    //     } else {
    //         // Fetch all inquiries with the 'viewedBy' relationship
    //         $inquiries = Inquiry::with('viewedBy')->orderBy('created_at')->get();

    //         return view('backend/bookings/inquiries/inquiry-list', compact('inquiries'));
    //     }
    // }

    // public function bookingInquiryUpdate(Request $request,$id){
    //     $request->validate([
    //         'comment' => 'sometimes|string|nullable',

    //     ]);
    //     $inquiry=Inquiry::findOrfail($id);
    //     $inquiry->comment=$request->input('comment');
    //     $inquiry->view_by=Auth::id();
    //     $inquiry->save();
    //     return redirect()->route('booking-inquiry')->with('success','Inquiry Updated Successfully');
    // }

}
