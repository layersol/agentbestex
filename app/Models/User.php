<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
   use Notifiable;

    protected $fillable = [
       'first_name', 'last_name', 'email', 'phone_country_code', 'phone', 'email_code', 
    'password', 'status', 'country_code', 'address1', 'address2', 'company_name',
    'company_phone', 'company_email', 'company_commission', 'note', 'currency_id',
    'balance', 'user_type', 'state', 'city', 'postal_code', 'agency_name',
    'agency_license', 'agency_logo', 'markup_hotels', 'markup_flights',
    'markup_tours', 'markup_cars', 'agency_address', 'agency_city'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Automatically hash password when setting
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
     public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Computed balance from transactions
    public function getCurrentBalanceAttribute()
    {
        return $this->transactions()
                    ->where('status', 'completed')
                    ->where('type', 'credit')
                    ->sum('amount') 
               - $this->transactions()
                    ->where('status', 'completed')
                    ->where('type', 'debit')
                    ->sum('amount');
    }
}