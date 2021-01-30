<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Consulta :: Cofessa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Consulta">
    <meta name="author" content="Cofessa">

    <!-- css -->
    <link href="{{ asset('css/arial.css') }}" rel="stylesheet">
  </head>
  <body>
    <h2>Información recibida</h2>
    <b>{{ $nombre }}:</b>
    <br>
    Gracias por ponerse en contacto con nosotros.
    <p>
      El motivo de su mensaje es <b>{{ $motivo }}</b> y su consulta
      fue <b>"{{ $mensaje }}"</b> que fue enviado el
      {{ 
        Date::createFromTimestamp(
          strtotime($envio)
        )->format('D, j M, Y (h:i a)')
      }}.
    </p>
    Esta dirección de correo electrónico <b>solamente sirve para enviar notificaciones
    y no recibe respuestas</b> por lo que si necesita preguntar cualquier otra cuestión
    diferente mande un correo a <b>cofessa@cofessa.com.mx</b>
    y lo atenderemos lo más pronto posible.
    <hr>
    <small>
      Si este mensaje le fue enviado por error solo ignórelo y bórrelo
      y si siguen siendo continuos por favor envíe un correo
      a la dirección <b>cofessa@cofessa.com.mx</b>
      y procederemos a bloquear su dirección.
    </small>
  </body>
</html>
