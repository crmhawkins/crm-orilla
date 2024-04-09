<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmación de Reserva</title>
<style>
  /* Base */
  body {
    background-color: #EDE1DD;
    color: #333;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    line-height: 1.6;
  }

  /* Contenedor del mensaje */
  .mail-container {
    background-color: #EDE1DD;
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 600px;
  }

  /* Título */
  h1 {
    color: #6C4C2B;
    font-size: 24px;
    margin-bottom: 20px;
  }

  /* Subtítulos */
  h2 {
    color: #6C4C2B;
    font-size: 18px;
    margin-bottom: 10px;
  }

  /* Detalles de la reserva */
  .reservation-details {
    background-color: #EDE1DD;
    border-left: 4px solid #6C4C2B;
    padding: 10px;
    margin-bottom: 20px;
  }

  /* Consejos y sugerencias */
  .tips {
    background-color: #EDE1DD;
    border-left: 4px solid #6C4C2B;
    padding: 10px;
    margin-bottom: 20px;
  }

  /* Botones */
  a.btn {
    background-color: #6C4C2B;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
  }

  /* Texto del pie de página */
  .footer-text {
    font-size: 14px;
    color: #aaa;
  }
</style>
</head>
<body>
<div class="mail-container">
  <h1>Confirmación de Reserva en Chiringuito La Orilla </h1>
  <p>¡Estamos encantados de confirmar tu reserva! Prepárate para una experiencia inolvidable con nosotros el <strong>{{ $fecha }}</strong> a las <strong>{{ $hora }}</strong>. Gracias por elegir el paraíso a pie de playa para tu próxima aventura culinaria.</p>

  <div class="reservation-details">
    <h2>Detalles de Tu Experiencia:</h2>
    <p>- <strong>Contacto:</strong> {{ $nombre }}</p>
    <p>- <strong>Fecha de la Experiencia:</strong> {{ $fecha }}</p>
    <p>- <strong>Hora:</strong> {{ $hora }}</p>
    <p>- <strong>Nº de Comensales:</strong> {{ $comensales }}</p>
    <p>- <strong>Teléfono de Contacto:</strong> {{ $telefono }}</p>
  </div>

  <div class="tips">
    <h2>Preparándote para la Magia:</h2>
    <p>- Te sugerimos llegar un poco antes para sumergirte completamente en la atmósfera relajante de nuestro chiringuito.</p>
    <p>- En caso de cambios o cancelaciones, por favor, avísanos con al menos 24 horas de antelación para ajustar los detalles.</p>
  </div>

  <p>Estamos listos para hacerte vivir momentos inolvidables frente al mar, donde cada bocado es una celebración y cada vista un recuerdo perdurable. Para cualquier pregunta o para preparar algo especial, estamos a tu disposición.</p>

  <p>Con cariño y anticipación,<br>
  <strong>El Equipo de Chiringuito La Orilla</strong></p>
</div>
</body>
</html>
