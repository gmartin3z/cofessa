@extends('main')

@section('title')
  Crear sección documentos y formatos
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
          <h3 class="title">Crear sección <strong>documentos y formatos</strong></h3>
          <form action="{{ route('inicio.administrar.guardar_seccion_documentos') }}" method="post" id="frm_menu_documentos">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span12 control-group">
                <label>Descripción (requerido)</label>
                <input type="text" name="detalle_descripcion" value="{{ old('detalle_descripcion') }}" maxlength="40" class="span6">
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
              <a class="btn btn-default" href="{{ route('inicio.administrar.seccion_documentos') }}" title="Ir al listado">
                <i class="icon-arrow-left"></i> Ir al listado
              </a>
            </div>
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
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_menu_documentos .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_menu_documentos .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_menu_documentos :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
