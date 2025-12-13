<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'shoe_id', // Ganti book_id jadi shoe_id
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoe() // Ganti book() jadi shoe()
    {
        return $this->belongsTo(Shoe::class);
    }
}