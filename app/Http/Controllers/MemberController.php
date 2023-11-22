<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function dashboard(){
        $bookings = \App\Models\Booking::whereRaw("booked_by = '".\Illuminate\Support\Facades\Auth::user()->id."' AND `status` IN (1,2) ORDER BY booking_date DESC, booking_slot ASC")->get();        
        return view('member.dashboard',['bookings' => $bookings]);
    }
}
