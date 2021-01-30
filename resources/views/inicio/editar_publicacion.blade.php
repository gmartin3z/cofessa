@extends('main')

@section('title')
  Editar publicacion {{ $publicacion->publicacion_id }}
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')      
        <div class="span12 aligncenter">
          <h3 class="title">Editar <strong>publicación</strong></h3>
          <form action="{{ route('inicio.administrar.actualizar_publicacion', $publicacion->publicacion_id) }}" method="post" id="frm_publicacion">
            <input name="_method" type="hidden" value="put">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span6 control-group">
                <label>Descripción (requerido)</label>
                <input type="text" name="detalle_descripcion" value="{{ $publicacion->descripcion or old('detalle_descripcion') }}" maxlength="40" class="span6">
              </div>
              <div class="span6 control-group">
                <label>URL (requerido)</label>
                <input type="text" name="detalle_url" value="{{ $publicacion->url or old('detalle_url') }}" maxlength="255" class="span6">
              </div>
            </div>
            <div class="btn-toolbar">
              <button type="submit" class="btn btn-success btn-submit" id="guardar_datos">
                <span class="btn-txt">Guardar registro</span>
              </button>
              <button type="reset" class="btn btn-danger">
                Limpiar registro
              </button>
              <br><br>
              <a class="btn btn-default" href="{{ route('inicio.administrar.publicaciones') }}" title="Ir al listado">
                <i class="icon-arrow-left"></i> Ir al listado
              </a>
            </div>
          </form>
          <form action="{{ route('inicio.administrar.borrar_publicacion', $publicacion->publicacion_id) }}" method="post" id="frm_borrar_publicacion">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="delete">
            <button type="submit" class="btn btn-danger btn-delete" id="borrar_datos">
              <span class="btn-txtb">Borrar registro</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra_js_functions')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#frm_publicacion').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableFormUpdate();
        }, 0);
      });

      $('#frm_borrar_publicacion').on('click', '#borrar_datos', function (event) {
        setTimeout(function () {
          disableFormDelete();
        }, 0);
      });

      function disableFormUpdate() {
        $('#frm_publicacion .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_publicacion .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_publicacion :input')
          .prop('disabled', true);

        $('#frm_borrar_publicacion :input').prop('disabled', true)
      }

      function disableFormDelete() {
        $('#frm_borrar_publicacion .btn-delete')
          .find('span.btn-txtb').text('Espere...');
        $('#frm_borrar_publicacion .btn-delete')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_borrar_publicacion :input')
          .prop('disabled', true);

        $('#frm_publicacion :input').prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
