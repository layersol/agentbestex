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
use App\Models\FlightsAirport;

class RoutesController extends Controller
{
    public function index() {
       $route = Routes::all();
       $routes = json_decode($route, true);
    return view('admin.routes.list', compact('routes'));
       
    }
  
     public function create(){
       
        $airlines = Airline::all(); // fetch all airlines
    // return view('admin.sellflights.create', compact('$id'));

    return view('admin.routes.create', compact('airlines'));
    }

     public function edit(int $id){

        $flight = GroupFlight::find($id);
        $airlines = Airline::all(); // fetch all airlines
    // return view('admin.sellflights.create', compact('$id'));

    return view('admin.routes.create', compact('flight', 'airlines'));
    }
    
    

public function autoairport(Request $request)
{

    $query = $request->get('query', '');

        $airports = FlightsAirport::where('airport', 'like', "%{$query}%")
            ->orWhere('city', 'like', "%{$query}%")
            ->orWhere('country', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'airport', 'city', 'country', 'code']);

        return response()->json($airports);

}

public function airlinessearch(Request $request)
{

    $query = $request->get('query');
    $airlines = Airline::where('name', 'like', "%{$query}%")
                ->orWhere('code', 'like', "%{$query}%")
                ->limit(10)
                ->get(['id', 'name', 'code']);
    return response()->json($airlines);

}




public function storeOrUpdate(Request $request)
    {
       // Validation
$request->validate([
    'departure_code' => 'required|string|max:10',
    'arrival_code' => 'required|string|max:10',
    'status' => 'required|in:0,1',
]);

// Check for duplicate route (ignore current record if updating)
$existingRoute = Routes::where('origin', $request->departure_code)
    ->where('destination', $request->arrival_code);

if ($request->has('id')) {
    $existingRoute->where('id', '!=', $request->id);
}

$existingRoute = $existingRoute->first();

if ($existingRoute) {
    return redirect()->back()->with('error', 'This route already exists!');
}

// If updating existing flight
if ($request->has('id')) {
    $flight = Routes::findOrFail($request->id);
} else {
    $flight = new Routes();
}

// Assign values
$flight->origin = $request->departure_code;
$flight->destination = $request->arrival_code;
$flight->status = $request->status;

// Optional fields
$flight->code = $request->code ?? null;
$flight->distance = $request->distance ?? null;

// Save flight
$flight->save();

return redirect()
    ->back()
    ->with('success', $request->has('id') ? 'Flight updated successfully!' : 'Flight saved successfully!');

    }


  public function sstoreOrUpdate(Request $request)
{


// print_r($request->all());

// exit;

    // Validate request
    // $request->validate([
    //     'route_id' => 'required|integer|exists:routes,id',
    //     'departure_airport' => 'required|string|max:255',
    //     'arrival_airport' => 'required|string|max:255',
    //     'departure_date' => 'required|date',
    //     'return_date' => 'required|date|after_or_equal:departure_date',
    //     'departure_time' => 'required',
    //     'arrival_time' => 'required',
    //     'airline_id' => 'required|integer|exists:airlines,id',
    //     'code' => 'required|string|max:10',
    //     'number' => 'required|string|max:10',
    //     'baggaes' => 'required|numeric|min:0',
    //     'seats' => 'required|integer|min:1',
    //     'adult_price' => 'required|numeric|min:0',
    //     'child_price' => 'required|numeric|min:0',
    //     'infant_price' => 'required|numeric|min:0',
    //     'currency' => 'required|string|max:5',
    //     'status' => 'required|in:active,inactive',
    // ]);

    // Check if flight ID exists to update, otherwise create new
    if ($request->has('id') && $request->id) {
        // Update existing flight
        $flight = GroupFlight::findOrFail($request->id);
        $flight->update($request->only([
            'departure_airport','arrival_airport','departure_date','return_date',
            'departure_time','arrival_time','airline_id','code','number','baggaes',
            'seats','adult_price','child_price','infant_price','currency','status'
        ]));
        $message = 'Flight updated successfully!';
    } else {
        // Create new flight
        $flight = GroupFlight::create($request->only([
            'route_id','departure_airport','arrival_airport','departure_date','return_date',
            'departure_time','arrival_time','airline_id','code','number','baggaes',
            'seats','adult_price','child_price','infant_price','currency','status'
        ]));
        $message = 'Flight created successfully!';
    }

    // Redirect to list page with success message
    return redirect()->route('admin.gfares.list', ['id' => $request->route_id])
                     ->with('success', $message);
}
 

}