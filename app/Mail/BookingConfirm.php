<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingConfirm extends Mailable
{
    use Queueable, SerializesModels;
    protected $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        $this->from(env("ADMIN_EMAIL"), env("ADMIN_name"))->subject("Booking Confirmed");
        return $this->view('mail.booking-confirm')->with(['booking' => $this->booking, 'user' => \App\Models\User::where("id", $this->booking->user_id)->first()]);
    }
}
