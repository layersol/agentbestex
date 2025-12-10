<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightsAirport extends Model
{
    use HasFactory;

    protected $table = 'flights_airports';

    protected $fillable = [
        'airport_code',
        'airport_name',
        'city',
        'country',
        'latitude',
        'longitude',
    ];
}