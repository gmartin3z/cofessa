@extends('main')

@section('title')
  Mostrar solicitud {{ $correo->correo_id }}
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span8">
          <article class="single">
            <div class="row">
              <div class="span12">
                <div class="post-image">
                  <div class="post-heading">
                    <h3>
                    <strong>
                      <span class="colored">
                        Mensaje de {{ $correo->nombre }}
                      </span>
                    </strong>
                  </h3>
                  </div>
                </div>
                <p>
                  <b>De:</b> {{ $correo->nombre }}
                  <br>
                  <b>Fecha:</b> {{ $correo->envio }}
                  <br>
                  <b>Motivo:</b> {{ $correo->motivo }}
                </p>
                <p>
                 <b>Mensaje:</b>
                  <br>
                  {{ $correo->mensaje }}
                </p>
                <form action="{{ route('contacto.administrar.borrar_solicitud', $correo->correo_id) }}" method="post" id="frm_borrar_solicitud">
                  {{ csrf_field() }}
                  <a class="btn btn-default" href="{{ route('contacto.manage') }}" title="Ir al listado">
                    <i class="icon-arrow-left"></i> Ir al listado
                  </a>
                  <input name="_method" type="hidden" value="delete">
                  <button type="submit" class="btn btn-danger btn-delete" id="borrar_datos">
                    <span class="btn-txtb">Borrar registro</span>
                  </button>
                </form>
              </div>
            </div>
          </article>
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
