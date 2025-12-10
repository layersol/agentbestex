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

class AirlineController extends Controller
{
     public function index()
    {
        $airlines = Airline::all();
        return view('admin.airlines.list', compact('airlines'));
    }
public function updateCode(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:airlines,id',
            'code' => 'required|string|max:10'
        ]);

        $airline = Airline::find($request->id);
        $airline->code = $request->code;
        $airline->save();

        return response()->json(['success' => true]);
    }

}