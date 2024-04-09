<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio de Reserva</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://laorillachiringuito.com/wp-content/uploads/2024/03/chiringuito-la-orilla-decoracion.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
        }
        html {
            height: 100%;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semitransparente para mejorar la legibilidad */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            color: #6C4C2B; /* Manteniendo el esquema de colores del primer documento */
            padding-bottom: 10px;
            border-bottom: 2px solid #EDE1DD; /* Ajuste de color para la línea decorativa */
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333; /* Ajuste para mejorar la legibilidad sobre el fondo claro */
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #aaa;
            padding-top: 10px;
            border-top: 2px solid #EDE1DD; /* Ajuste de color para la línea decorativa */
        }
        a.btn {
            background-color: #6C4C2B; /* Botones estilizados como en el primer documento */
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
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
