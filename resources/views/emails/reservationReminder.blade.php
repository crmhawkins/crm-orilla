<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio de Reserva</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0f2f1; /* Suave color de fondo inspirado en la arena y el mar */
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra más pronunciada para un efecto moderno */
        }
        .header {
            font-size: 24px;
            color: #0275d8; /* Color azul claro, inspirado en el cielo y el mar */
            padding-bottom: 10px;
            border-bottom: 2px solid #b2ebf2; /* Línea decorativa suave */
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #555; /* Texto en un color gris oscuro para mejor legibilidad */
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #999;
            padding-top: 10px;
            border-top: 2px solid #b2ebf2; /* Línea decorativa suave en el pie de página */
        }
        a {
            color: #0275d8;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Recordatorio de tu Reserva 🌴
        </div>
        <div class="content">
            <p>Hola {{ $reserva->nombre }},</p>
            <p>Queremos recordarte sobre tu próxima aventura culinaria con nosotros:</p>
            <p><strong>Lugar:</strong> {{ config('app.name') }}</p>
            <p><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
            <p><strong>Hora:</strong> {{ $reserva->hora }}</p>
            <p><strong>Comensales:</strong> {{ $reserva->comensales }}</p>
            <p>Esperamos verte pronto para ofrecerte una experiencia inolvidable junto al mar. Si tienes alguna pregunta o necesitas realizar algún cambio, no dudes en contactarnos.</p>
            <p>¡Hasta pronto!</p>
        </div>
        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
