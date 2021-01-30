@extends('main')

@section('title')
  Editar sección {{ $menu_documento->descripcion }} (documentos y formatos)
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
          <h3 class="title">Editar sección <strong>{{ $menu_documento->descripcion }}</strong></h3>
          <form action="{{ route('inicio.administrar.actualizar_seccion_documentos', $menu_documento->menu_id) }}" method="post" id="frm_menu_documentos">
            <input name="_method" type="hidden" value="put">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span12 control-group">
                <label>Descripción (requerido)</label>
                <input type="text" name="detalle_descripcion" value="{{ $menu_documento->descripcion or old('detalle_descripcion') }}" maxlength="40" class="span6">
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
              <a class="btn btn-default" href="{{ route('inicio.administrar.seccion_documentos') }}" title="Ir al listado"> <i class="icon-arrow-left"></i> Ir al listado</a>
            </div>
          </form>
          <form action="{{ route('inicio.administrar.borrar_seccion_documentos', $menu_documento->menu_id) }}" method="post" id="frm_borrar_menu_documentos">
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
      $('#frm_menu_documentos').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableFormUpdate();
        }, 0);
      });

      $('#frm_borrar_menu_documentos').on('click', '#borrar_datos', function (event) {
        setTimeout(function () {
          disableFormDelete();
        }, 0);
      });

      function disableFormUpdate() {
        $('#frm_menu_documentos .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_menu_documentos .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_menu_documentos :input')
          .prop('disabled', true);

        $('#frm_borrar_menu_documentos :input').prop('disabled', true);
      }

      function disableFormDelete() {
        $('#frm_borrar_menu_documentos .btn-delete')
          .find('span.btn-txtb').text('Espere...');
        $('#frm_borrar_menu_documentos .btn-delete')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_borrar_menu_documentos :input')
          .prop('disabled', true);

        $('#frm_menu_documentos :input').prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
