@component('mail::message')
# ¡Tu Reserva Ha Sido Confirmada!

Estamos emocionados de confirmar tu reserva para el **{{ $fecha }}** a las **{{ $hora }}**. ¡Gracias por elegirnos!


### Detalles de tu reserva:
- **Contacto:** {{ $nombre }}
- **Fecha:** {{ $fecha }}
- **Hora:** {{ $hora }}
- **Nº de comensales:** {{ $comensales }}
- **Telefono:** {{ $telefono }}


### Algunos consejos para tu visita:
- Te recomendamos llegar unos minutos antes de tu reserva para acomodarte cómodamente.
- En caso de cualquier cambio o cancelación, por favor infórmanos con al menos 24 horas de anticipación.

Nos encanta poder servirte y estamos seguros de que disfrutarás de tu tiempo con nosotros. Si tienes alguna pregunta o necesitas asistencia adicional antes de tu llegada, no dudes en contactarnos.

Gracias de nuevo por tu preferencia,<br>
**{{ config('app.name') }}**
@endcomponent
