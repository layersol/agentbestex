<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Table name (optional if follows Laravel naming conventions)
    protected $table = 'transactions';

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'trx_id',
        'type',
        'date',
        'payment_gateway',
        'amount',
        'currency',
        'description',
        'attachment',
        'status',
    ];

    // Cast 'date' to datetime automatically
    protected $casts = [
        'date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}