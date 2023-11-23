<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends Controller {

    public function index(Request $request) {
        $input = $request->input("slot");
        $x = explode("|", $input);
        $bookingDate = $x[0];
        $slotTime = $x[1];
        $userID = $request->input("user_id");

        $bookingPossible = \App\Models\Booking::checkBookingSlotAvailable($slotTime, $bookingDate, $userID);
        if ($bookingPossible) {
            // check if user alreay have booking entry without payment for same date and slot and user
            $booking = \App\Models\Booking::whereRaw("`booking_slot`  = '$slotTime' AND booking_date = '$bookingDate' AND user_id = '$userID' AND `status` = 0")->first();
            if (!$booking) {
                $booking = new \App\Models\Booking();
                $booking->booking_slot = $slotTime;
                $booking->booking_date = $bookingDate;
                $booking->user_id = $userID;
                $booking->price_per_slot = \App\Models\Booking::getSlotPrice($slotTime, $bookingDate, $userID);
                $booking->booked_by = auth()->user()->id;
                $booking->razorpay_payment_id = null;
                $booking->razorpay_order_id = null;
                $booking->save();
            }

            $api = new Api(env("RZR_KEY_ID"), env("RZR_KEY_SEC"));

            // find if booking is not already done for time and date and client


            $orderData = [
                'receipt' => "$booking->id",
                'amount' => $booking->price_per_slot * 100, // 2000 rupees in paise
                'currency' => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            $razorpayOrderId = $razorpayOrder['id'];
            $booking->razorpay_order_id = $razorpayOrderId;
            $booking->save();

            $request->session()->put('razorpay_order_id', $razorpayOrderId);

            $displayAmount = $amount = $orderData['amount'];

            $displayCurrency = "INR";

            if ($displayCurrency !== 'INR') {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);

                $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
            }

            $checkout = 'automatic';

            if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
                $checkout = $_GET['checkout'];
            }

            $data = [
                "key" => env("RZR_KEY_ID"),
                "amount" => $amount,
                "name" => "Deepak",
                "description" => "Booking System",
                "image" => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
                "prefill" => [
                    "name" => "Daft Punk",
                    "email" => "customer@merchant.com",
                    "contact" => "9999999999",
                ],
                "notes" => [
                    "address" => "Hello World",
                    "merchant_order_id" => "12312321",
                ],
                "theme" => [
                    "color" => "#F37254"
                ],
                "order_id" => $razorpayOrderId,
                'display_currency' => $displayCurrency
            ];

            if ($displayCurrency !== 'INR') {
                $data['display_currency'] = $displayCurrency;
                $data['display_amount'] = $displayAmount;
            }

            //$json = json_encode($data);
            return view("razorpay.index", ['data' => $data, 'displayCurrency' => $displayCurrency]);
        } else {
            return redirect()->route("appointment.index")->with("error", "Booking slot not available for that date and time");
        }
    }

    public function verify(Request $request) {
        $success = true;

        $error = "Payment Failed";
        $html = "";

        if (empty($_POST['razorpay_payment_id']) === false) {
            $api = new Api(env("RZR_KEY_ID"), env("RZR_KEY_SEC"));

            try {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => $request->session()->get('razorpay_order_id'),
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );

                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }


        if ($success === true) {
            $booking = \App\Models\Booking::whereRaw("razorpay_order_id = '" . $request->session()->get('razorpay_order_id') . "'")->first();
            $booking->razorpay_payment_id = $_POST['razorpay_payment_id'];
            $booking->status = 1;
            $booking->save();
            $request->session()->forget("razorpay_order_id");
            
            
            
            // send email
            $toUser = \App\Models\User::find($booking->booked_by);
            \Illuminate\Support\Facades\Mail::to($toUser->email)->send(new \App\Mail\BookingConfirm($booking));
            
            return redirect()->route("razorpay.success", ['id' => $booking->id]);
        } else {
            $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
            return view("razorpay.verify", ['html' => $html]);
        }
    }

    public function success(Request $request, int $id) {
        $booking = \App\Models\Booking::where("id", $id)->first();
        $user = \App\Models\User::where("id", $booking->user_id)->first();
        return view("razorpay.success", ['booking' => $booking, 'user' => $user]);
    }

    public function cancel(Request $request, int $id) {
        $booking = \App\Models\Booking::where("id", $id)->first();
        $user = \App\Models\User::where("id", $booking->user_id)->first();
        return view("razorpay.cancel", ['booking' => $booking, 'user' => $user]);
    }

}
