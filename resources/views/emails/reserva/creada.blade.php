@component('mail::message')
# Confirmación de Reserva

Tu reserva para el **{{ $fecha }}** a las **{{ $hora }}** ha sido confirmada exitosamente.

@component('mail::button', ['url' => 'url_de_tu_sitio'])
Ver Reserva
@endcomponent

Gracias por elegirnos,<br>
{{ config('app.name') }}
@endcomponent
