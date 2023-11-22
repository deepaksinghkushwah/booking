<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSlot extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'slot_date',
        'slot_time',
        'price_per_slot',
    ];
}
