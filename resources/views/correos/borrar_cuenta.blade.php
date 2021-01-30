<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Borrar cuenta :: Cofessa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Borrar cuenta">
    <meta name="author" content="Cofessa">

    <!-- css -->
    <link href="{{ asset('css/arial.css') }}" rel="stylesheet">
  </head>
  <body>
    <h2>Saludos</h2>
    Copie y pegue el siguiente enlace en el navegador para borrar cuenta:
    <p>
      <code>
        {{ route('perfil.eliminarUsuario', [$usuario_id, $correo, $tipo_operacion_id, $token]) }}
      </code>
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
