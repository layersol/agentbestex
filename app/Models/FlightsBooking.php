<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightsBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        
        'booking_ref_no',
       
       
        'booking_status',
        'pnr',
    ];
public $timestamps = false; // default is true, so optional
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function flight()
    // {
    //     return $this->belongsTo(Flight::class);
    // }
}