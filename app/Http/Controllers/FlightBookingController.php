<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class FlightBookingController extends Controller
{
    public function booking(Request $request)
    {
        // ✅ Validate request
        $data = $request->validate([
            'flight' => 'required|string',
            'flight_id' => 'required|integer',
            'adult_count' => 'required|integer',
            'child_count' => 'required|integer',
            'infant_count' => 'required|integer',
            'total_fare' => 'required',
        ]);

        // ✅ Decode JSON flight data
        $flight = json_decode($data['flight'], true);

        // ✅ Initialize numeric passengers array
        $passengers = [];

        // ✅ Adults
        $adultArray = [];
        for ($i = 1; $i <= $data['adult_count']; $i++) {
            $adultArray[] = ['type' => 'adult'];
        }
        $passengers[] = $adultArray;

        // ✅ Children
        $childArray = [];
        for ($i = 1; $i <= $data['child_count']; $i++) {
            $childArray[] = ['type' => 'child'];
        }
        $passengers[] = $childArray;

        // ✅ Infants
        $infantArray = [];
        for ($i = 1; $i <= $data['infant_count']; $i++) {
            $infantArray[] = ['type' => 'infant'];
        }
        $passengers[] = $infantArray;

        // ✅ Combine everything into a single array
        $bookingData = [

            'data' => $data,
            'passengers' => $passengers,

        ];
        return view('GroupFares/customerinfo', compact('bookingData'));
        // return redirect()->route('passenger.details')->with('success', 'Flight booked successfully!');
    }

    public function store(Request $request)
    {


        // If the user is NOT logged in → redirect to login
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please login first');
        }


        $user = Auth::user();

        // echo $user->user_id; // ✅ prints 20230311051923100

        $userData = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'nationality' => $user->nationality,
            'country_code' => $user->country_code,
            'user_id' => $user->user_id,
        ];
        $flight = $request->input('flight', []);
        $originalPrice = str_replace(',', '', $request->input('originalPrice'));
        $titles = $request->input('title', []);
        $firstnames = $request->input('firstname', []);
        $lastnames = $request->input('lastname', []);
        $nationalities = $request->input('nationality', []);
        $dob_days = $request->input('dob_day', []);
        $dob_months = $request->input('dob_month', []);
        $dob_years = $request->input('dob_year', []);
        $passports = $request->input('passport', []);
        $issue_days = $request->input('passport_issuance_day', []);
        $issue_months = $request->input('passport_issuance_month', []);
        $issue_years = $request->input('passport_issuance_year', []);
        $exp_days = $request->input('passport_day_expiry', []);
        $exp_months = $request->input('passport_month_expiry', []);
        $exp_years = $request->input('passport_year_expiry', []);
        $emails = $request->input('email', []);
        $phone = $request->input('phone', []);
        $bookingId = mt_rand(10000000000000, 99999999999999);
        ; // Example — link passengers to a booking


        $passengerArray = [];

        foreach ($firstnames as $i => $firstname) {

            $passengerArray[] = [
                'title' => $titles[$i],
                'first_name' => $firstnames[$i],
                'last_name' => $lastnames[$i],
                'nationality' => $nationalities[$i],
                'dob' => isset($dob_years[$i], $dob_months[$i], $dob_days[$i])
                    ? ($dob_years[$i] . '-' . $dob_months[$i] . '-' . $dob_days[$i])
                    : null,
                'passport' => $passports[$i],
                'passport_issue' => isset($issue_years[$i], $issue_months[$i], $issue_days[$i])
                    ? ($issue_years[$i] . '-' . $issue_months[$i] . '-' . $issue_days[$i])
                    : null,

                'passport_expiry' => isset($exp_years[$i], $exp_months[$i], $exp_days[$i])
                    ? ($exp_years[$i] . '-' . $exp_months[$i] . '-' . $exp_days[$i])
                    : null,

                'email' => $emails[$i],
                'phone' => $phone[$i] ?? null,
            ];
        }
        // Convert array to JSON
        // $guestData = json_encode($passengerArray, JSON_PRETTY_PRINT);

        $route=json_decode($flight);
        $pnr_number=json_decode($flight);


        DB::table('flights_bookings')->insert([
            'booking_ref_no' => $bookingId,
            'module_type' => 'flight-Group-Fares',
            'flight_type' => $flightType ?? null,
            'booking_date' => Carbon::now(),
            'booking_status' => 'pending',
            'pnr' => $pnr_number->PNR ?? null,
            'order_number' => $orderNumber ?? null,
            'booking_additional_notes' => $notes ?? null,

            'price_original' => $originalPrice ?? 0,
            'price_markup' => $markup ?? null,
            'agent_markup_price' => $agentMarkupPrice ?? null,
            'agent_net_profit' => $agentNetProfit ?? null,
            'agent_markup_percent' => $markupPercent ?? null,

            'checkin' => $checkin ?? null,
            'checkout' => $checkout ?? null,
            'booking_nights' => $nights ?? null,
            'adults' => $adults ?? 1,
            'childs' => $children ?? 0,
            'infants' => $infants ?? null,

            'currency_original' => $currency ?? 'INR',
            'currency_markup' => $currency ?? 'INR',
            'payment_date' => time(),

            'cancellation_request' => 0,
            'cancellation_status' => 0,

            'booking_data' => $flight ?? [],
            'booking_response' => json_encode($response ?? []),
            'error_response' => json_encode($error ?? []),

            'payment_status' => 'unpaid',
            'supplier' => $supplier ?? 'GroupFares',
            'transaction_id' => $transactionId ?? null,

            'user_id' => $user->user_id ?? null,
            'user_data' => json_encode($userData ?? []),
            'guest' => json_encode($passengerArray, JSON_PRETTY_PRINT),

            'nationality' => $nationality ?? null,
            'routes' => json_encode($routes ?? []),
            'payment_gateway' => '' ?? null,
        ]);

        $totalseat = $request->input('totalseat');

      

        $flight = DB::table('groupflights')->where('route_id', $route->id)->first();

        if ($route->seats < $totalseat) {
            return back()->with('error', 'Not enough seats available');
        }

        DB::table('groupflights')
            ->where('id', $route->id)
            ->decrement('seats', $totalseat);


        return redirect()->route('flights.tickets', ['id' => $bookingId]);
        
    }
    public function tickets($id)
    {



        // Example: Fetch booking details using $id
        $booking = DB::table('flights_bookings')
            ->where('booking_ref_no', $id)
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found!');
        }

        // Return a view and pass booking data
        return view('GroupFares.pdf_tickets', compact('booking'));
    }
}
