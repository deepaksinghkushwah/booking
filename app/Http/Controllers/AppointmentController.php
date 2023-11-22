<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller {

    public function index() {
        $list = [];
        $users = \App\Models\User::get();
        foreach($users  as $user){
            if($user->hasRole('Booking')){
                $list[] = $user;
            }
        }
        
        return view("appointment.index",['users' => $list]);
    }
    
    public function showSlots(Request $request){
        $userID = $request->input("id");
        $user = \App\Models\User::where('id', $userID)->first();
        $slotDates = \App\Models\BookingSlot::whereRaw("user_id = ".$userID." AND slot_date >= '".date('Y-m-d', strtotime('+1 day'))."' order by slot_date ASC")->get();
        
        $array = [];
        if(count($slotDates) > 0){
            foreach($slotDates as $sd){
                // select only slots which are not booked by any other user on same date
                $alreadyBooked = \App\Models\Booking::whereRaw("user_id = '".$userID."' AND booking_date = '".$sd->slot_date."' AND booking_slot = '".$sd->slot_time."' AND `status` = 1")->get();
                if(count($alreadyBooked) > 0){
                    // slot alredy booked, continue
                } else {
                    $array[$sd->slot_date][] = $sd->slot_time;
                }
            }
        } 
        return view('appointment.show-slots',['slots' => $array, 'user' => $user]);
    }

}
