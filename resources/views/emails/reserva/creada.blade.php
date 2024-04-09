<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmación de Reserva</title>
<style>
  /* Base */
  body {
    background-color: #FFF3E0; /* Un color cálido que recuerda a la arena bajo el sol */
    color: #333;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    line-height: 1.6;
  }

  /* Contenedor del mensaje */
  .mail-container {
    background-color: #ffffff;
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 600px;
  }

  /* Título */
  h1 {
    color: #FF9800; /* Un naranja vivo, como un atardecer veraniego */
    font-size: 24px;
    margin-bottom: 20px;
  }

  /* Subtítulos */
  h2 {
    color: #FF9800; /* Coincide con el título para mantener la coherencia */
    font-size: 18px;
    margin-bottom: 10px;
  }

  /* Detalles de la reserva */
  .reservation-details, .tips {
    background-color: #FFF3E0; /* Armoniza con el fondo para un look suave */
    border-left: 4px solid #FF9800; /* Elemento decorativo que añade un toque de color */
    padding: 10px;
    margin-bottom: 20px;
  }

  /* Botones */
  a.btn {
    background-color: #FF9800; /* Invita al clic con un color alegre y llamativo */
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
  <h1>Confirmación de Reserva 🌞 Chiringuito La Orilla</h1>
  <p>¡Estamos encantados de confirmar tu reserva! Prepárate para sumergirte en la vibrante energía del verano con nosotros el <strong>{{ $fecha }}</strong> a las <strong>{{ $hora }}</strong>. Gracias por elegir nuestro rincón de paraíso para tu próxima experiencia culinaria.</p>

  <div class="reservation-details">
    <h2>Detalles de Tu Experiencia Soleada:</h2>
    <p>- <strong>Contacto:</strong> {{ $nombre }}</p>
    <p>- <strong>Fecha de la Experiencia:</strong> {{ $fecha }}</p>
    <p>- <strong>Hora:</strong> {{ $hora }}</p>
    <p>- <strong>Nº de Comensales:</strong> {{ $comensales }}</p>
    <p>- <strong>Teléfono de Contacto:</strong> {{ $telefono }}</p>
  </div>

  <div class="tips">
    <h2>Consejos para Maximizar tu Disfrute:</h2>
    <p>- Llega un poco antes para capturar el perfecto selfie con el atardecer como tu telón de fondo.</p>
    <p>- Si tus planes cambian, avísanos con 24 horas de antelación. Queremos asegurarnos de que todo esté perfecto para ti.</p>
  </div>

  <p>Te esperamos para compartir la magia del verano, con sabores que encantan y vistas que enamoran. Cualquier pregunta o solicitud especial, estamos aquí para ti.</p>

  <p>Con anticipación y los mejores deseos de verano,<br>
  <strong>El Equipo de Chiringuito La Orilla</strong></p>
</div>
</body>
</html>
