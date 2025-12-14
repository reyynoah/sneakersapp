<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_name', 
        'customer_email', 
        'customer_phone', 
        'customer_address', 
        'total_price', 
        'status'
    ];
}