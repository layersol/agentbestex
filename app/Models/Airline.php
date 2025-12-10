<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    // Optional: If your table name is not plural ("airlines"), uncomment the line below
    protected $table = 'flights_airlines';

    protected $fillable = [
        'name',      // Airline full name, e.g. Qatar Airways
        'code',      // IATA/ICAO code, e.g. QR or QTR
        'country',   // Country of origin
     
        'status',    // active/inactive
    ];
}
