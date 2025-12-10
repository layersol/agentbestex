<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Route;
use App\Models\Airline; // 👈 adjust this to your actual airline model name

class GroupFlight extends Model
{
    use HasFactory;

     protected $table = 'groupflights'; // exact table name in your database

    // If you want mass assignment
    protected $fillable = [
     'route_id','departure_airport','arrival_airport','departure_date','return_date',
    'departure_time','arrival_time','airline_id','code','number','baggaes','handBaggage','PNR','seats',
    'adult_price','child_price','infant_price','currency','status'
    ];

    // Optional: define relationship with Route
  

    // 🔗 Relationships
    public function route()
    {
        return $this->belongsTo(Routes::class, 'route_id');
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }
}
