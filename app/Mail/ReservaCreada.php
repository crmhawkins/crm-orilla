<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservaCreada extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->markdown('emails.reserva.creada')
                    ->with([
                        'fecha' => $this->reserva->fecha,
                        'hora' => $this->reserva->hora,
                        'nombre' => $this->reserva->nombre,
                        'comensales' => $this->reserva->comensales,
                        'telefono' => $this->reserva->telefono,
                        // Incluir otros datos relevantes que quieras mostrar en el email
                    ]);
    }
}
