<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiModule extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
