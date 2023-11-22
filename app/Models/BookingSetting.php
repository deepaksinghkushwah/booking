<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSetting extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'price_per_slot',
        'start_time',
        'end_time',
        'time_step'
    ];
}
