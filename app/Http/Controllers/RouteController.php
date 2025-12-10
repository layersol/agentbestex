<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
use App\Models\Routes;
use App\Models\GroupFlight;
use App\Models\FlightsAirport;
use App\Models\Airline;

class RouteController extends Controller
{
    public function index()
    {
        
        $Routes = Routes::where('status', 'yes')->get();
        return view('welcome', compact('Routes'));
    }

     public function routes_view($id)
    {
       
    
$result = GroupFlight::where('route_id', $id)
    ->where('status', 'yes')
    ->get() // ✅ Get a collection, not an array
    ->map(function ($flight) {
        $departure = DB::table('flights_airports')->where('code', $flight->departure_airport)->first();
        $arrival   = DB::table('flights_airports')->where('code', $flight->arrival_airport)->first();
        $airline   = DB::table('flights_airlines')->where('id', $flight->airline_id)->first();

        $flight->departure_airport_name = $departure->airport ?? strtoupper($flight->departure_airport);
        $flight->arrival_airport_name   = $arrival->airport ?? strtoupper($flight->arrival_airport);

        $flight->departure_city = $departure->city ?? strtoupper($flight->departure_airport);
        $flight->arrival_city   = $arrival->city ?? strtoupper($flight->arrival_airport);

        $flight->airline_name           = $airline->name ?? "No Name";
        $flight->airline_code           = $airline->code ?? "No Code";

        return $flight;
    });


$result=$result->toArray();
    return view('GroupFares/view_flights', compact('result'));
    }


  public function create(int $id){
       
        $FlightsAirport = FlightsAirport::all(); // fetch all airlines
        $airlines = Airline::all(); // fetch all airlines
    // return view('admin.sellflights.create', compact('$id'));

    return view('admin.routes.create', compact('FlightsAirport', 'airlines'));
    }

     public function edit(int $id){

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
