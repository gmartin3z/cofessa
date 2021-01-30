@extends('main')

@section('title')
  Editar dato {{ $dato->dato_id }}
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
          <h3 class="title">Editar <strong>dato</strong></h3>
          <form action="{{ route('inicio.administrar.actualizar_dato', $dato->dato_id) }}" method="post" id="frm_dato">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="put">
            <div class="row controls">
              <div class="span4 control-group">
                <label>Descripción (requerido)</label>
                <input type="text" name="detalle_descripcion" value="{{ $dato->descripcion or old('detalle_descripcion') }}" maxlength="40" class="span4">
              </div>
              <div class="span4 control-group">
                <label>Valor (requerido)</label>
                <input type="text" name="detalle_valor" value="{{ $dato->valor or old('detalle_valor') }}" maxlength="100" class="span4">
              </div>
              <div class="span4 control-group">
                <label>Publicación (requerido, formato año-mes-día)</label>
                <input type="text" name="detalle_publicacion" value="{{ $dato->publicacion or old('detalle_publicacion') }}" maxlength="100" class="span4">
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
              <a class="btn btn-default" href="{{ route('inicio.administrar.indicadores') }}" title="Ir al listado">
                <i class="icon-arrow-left"></i> Ir al listado
              </a>
            </div>
          </form>
          <form action="{{ route('inicio.administrar.borrar_dato', $dato->dato_id) }}" method="post" id="frm_borrar_dato">
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
      $('#frm_dato').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableFormUpdate();
        }, 0);
      });

      $('#frm_borrar_dato').on('click', '#borrar_datos', function (event) {
        setTimeout(function () {
          disableFormDelete();
        }, 0);
      });

      function disableFormUpdate() {
        $('#frm_dato .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_dato .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_dato :input')
          .prop('disabled', true);

        $('#frm_borrar_dato :input').prop('disabled', true);
      }

      function disableFormDelete() {
        $('#frm_borrar_dato .btn-delete')
          .find('span.btn-txtb').text('Espere...');
        $('#frm_borrar_dato .btn-delete')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_borrar_dato :input')
          .prop('disabled', true);

        $('#frm_dato :input').prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
