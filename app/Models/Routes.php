<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Routes extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $fillable = [
        'origin',
        'destination',
        'status',
    ];

    public function flights()
    {
        // return $this->hasMany(GroupFlight::class, 'route_id');
        return $this->hasMany(\App\Models\GroupFlight::class, 'route_id'); // 'route_id' is FK in group_flights
    }
}