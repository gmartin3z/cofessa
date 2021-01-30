@extends('main')

@section('title')
  Administrar contacto
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span12">
          <h4 class="title">Solicitudes</h4>
          <p>
            Estas son las solicitudes enviadas, ordenadas
            de las más recientes a las más pasadas.
          </p>
          @if (count($correos) > 0)
            <b>Solicitudes recibidas:</b> {{ $correos->total() }}
            <br>
            <table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Motivo</th>
                  <th>Envío</th>
                  <th>
                    <center>
                      Opciones
                    </center>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($correos as $correo)
                  <tr>
                    <td>{{ $correo->correo_id }}</td>
                    <td>{{ $correo->nombre }}</td>
                    <td>{{ $correo->correo }}</td>
                    <td>{{ $correo->motivo }}</td>
                    <td>{{ $correo->envio }}</td>
                    <td>
                      <center>
                        <a href="{{ route('contacto.administrar.mostrar_solicitud', $correo->correo_id) }}" title="Mostrar detalles del registro {{ $correo->correo_id }}" class="btn btn-mini btn-default">
                          <i class="icon-eye-open"></i>
                        </a>
                      </center>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <center>
              <div class="pagination">
                {{ $correos->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay solicitudes</h3>
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra_js_functions')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#frm_borrar_solicitud').on('click', '#borrar_datos', function (event) {
        setTimeout(function () {
          disableFormDelete();
        }, 0);
      });

      function disableFormDelete() {
        $('#frm_borrar_solicitud .btn-delete')
          .find('span.btn-txtb').text('Espere...');
        $('#frm_borrar_solicitud .btn-delete')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_borrar_solicitud :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
