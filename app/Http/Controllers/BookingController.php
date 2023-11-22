<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\BookingSetting;
use App\Models\BookingSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller {

    public function showSlots() {
        $settings = BookingSetting::firstOrCreate([
                    'user_id' => Auth::id(),
                        ], [
                    'start_time' => '00:00',
                    'end_time' => '23:45',
                    'time_step' => '15',
                    'price_per_slot' => 10.00,
                        ]
        );
        $timeArray = \App\Helpers\GeneralHelper::getTimeSlots($settings->start_time, $settings->end_time, $settings->time_step);
        return view("booking.show-slots", ['timeArray' => $timeArray]);
    }

    public function saveSlots(Request $request) {
        $dates = explode(",", $request->input('dates', []));
        $times = $request->input('slots');
        $setting = BookingSetting::firstWhere('user_id', Auth::id());

        if (count($dates) > 0) {
            $dateStr = "";
            foreach ($dates as $date) {
                $dateStr .= "'" . $date . "',";
            }
            $dateStr = rtrim($dateStr, ",");
            $sql = "DELETE FROM `booking_slots` WHERE `user_id` = " . Auth::id() . " AND `slot_date` IN (" . $dateStr . ")";

            DB::delete($sql);

            foreach ($dates as $date) {
                if (count($times) > 0) {

                    foreach ($times as $time) {
                        $model = new BookingSlot([
                            'user_id' => Auth::id(),
                            'slot_date' => $date,
                            'slot_time' => $time,
                            'price_per_slot' => $setting->price_per_slot,
                        ]);
                        $model->save();
                    }
                }
            }
        }

        return redirect()->route("booking-list-date-slots")->with("Slots saved");
    }

    public function listBooking() {
        $bookings = \App\Models\Booking::whereRaw("user_id = '" . \Illuminate\Support\Facades\Auth::user()->id . "' AND `status` IN (1,2) ORDER BY booking_date DESC, booking_slot ASC")->get();
        return view("booking.list", ['bookings' => $bookings]);
    }

    public function showBookingSettings() {
        $model = BookingSetting::firstOrCreate([
                    'user_id' => Auth::id()
                        ],
        );
        return view("booking.settings", ['model' => $model]);
    }

    public function saveBookingSettings(Request $request) {
        $input = $request->all();
        $model = BookingSetting::firstWhere('user_id', Auth::id());
        $model->start_time = $request->input("start_time");
        $model->end_time = $request->input("end_time");
        $model->price_per_slot = $request->input("price_per_slot");
        $model->time_step = $request->input("time_step");
        $model->save();
        return redirect()->route("booking-show-settings")->with("success", "Settings saved");
    }

    public function listDateSlots() {
        $slotDates = BookingSlot::whereRaw("user_id = " . Auth::id() . " AND slot_date >= '" . date('Y-m-d', strtotime('+1 day')) . "' order by slot_date ASC")->get();

        $array = [];
        if (count($slotDates) > 0) {
            foreach ($slotDates as $sd) {
                $array[$sd->slot_date][] = $sd->slot_time;
            }
        }
        return view("booking.list-date-slots", ['slots' => $array]);
    }

    public function cancelBooking(int $bookingID) {        
        $arr = \App\Models\Booking::cancelBooking($bookingID);
        return $arr;        
    }

}
