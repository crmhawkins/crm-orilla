<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .header {
            font-size: 20px;
            color: #333333;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
            color: #666666;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Recordatorio de su Reserva
        </div>
        <div class="content">
            <p>Hola {{ $reserva->nombre }},</p>
            <p>Queremos recordarte sobre tu próxima reserva:</p>
            <p><strong>Lugar:</strong> {{ $reserva->lugar }}</p>
            <p><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
            <p><strong>Hora:</strong> {{ $reserva->hora }}</p>
            <p><strong>Comensales:</strong> {{ $reserva->comensales }}</p>
            <p>Esperamos verte pronto y que disfrutes de tu experiencia con nosotros.</p>
        </div>
        <div class="footer">
            © {{ date('Y') }} {{ $reserva->lugar }}. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
