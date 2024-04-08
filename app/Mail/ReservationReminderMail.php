<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Reserva;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->view('emails.reservationReminder')
                ->with([
                    'reserva' => $this->reserva,
                ]);
    }
}
