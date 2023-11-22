<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Razorpay\Api\Api;
class Booking extends Model {

    use HasFactory;

    public $fillable = ['user_id', 'booking_date', 'booking_slot', 'price'];

    /**
     * Check if booking slot available for booking
     * @param type $slotTime
     * @param type $bookingDate
     * @param type $userID
     * @return boolean
     */
    public static function checkBookingSlotAvailable($slotTime, $bookingDate, $userID) {
        $booking = \App\Models\Booking::whereRaw("`booking_slot`  = '$slotTime' AND booking_date = '$bookingDate' AND user_id = '$userID' AND `status` = 1")->first();
        if ($booking) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get booking slot price for user and date
     * @param type $slotTime
     * @param type $bookingDate
     * @param type $userID
     * @return type
     */
    public static function getSlotPrice($slotTime, $bookingDate, $userID) {
        $price = 0.00;
        $booking = \App\Models\BookingSlot::whereRaw("slot_time  = '$slotTime' AND slot_date = '$bookingDate' AND user_id = '$userID'")->first();
        if ($booking) {
            $price = $booking->price_per_slot;
        }
        return $price;
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bookedBy() {
        return $this->hasOne(User::class, 'id', 'booked_by');
    }

    public static function cancelBooking(int $bookingID) {
        $booking = Booking::where('id', $bookingID)->first();
        if (!$booking) {
            return json_encode(['msg' => 'Booking with id #' . $bookingID . ' not found!!!', 'ok' => 1]);
        } else {
            $booking->status = 2; // cancel
            $booking->save();
            $api = new Api(env("RZR_KEY_ID"), env("RZR_KEY_SEC"));
            $api->payment
                    ->fetch($booking->razorpay_payment_id)
                    ->refund([
                        "amount" => $booking->price_per_slot * 100,
                        "speed" => "normal",
                        "notes" => [
                            "comment" => "Booking id #" . $booking->id . " cancelled. Refund initiated.",
                        ],
                        "receipt" => $booking->id
            ]);

            \Illuminate\Support\Facades\Mail::to($booking->user->email)->send(new \App\Mail\BookingCancel($booking));
            \Illuminate\Support\Facades\Mail::to($booking->bookedBy->email)->send(new \App\Mail\BookingCancel($booking));
            return json_encode(['msg' => 'Booking with id #' . $bookingID . ' is cancelled. Amount will be refunded soon.', 'ok' => 1]);
        }
    }

}
