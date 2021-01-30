@extends('main')

@section('title')
  Crear publicación DOF
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
          <h3 class="title">Crear <strong>publicación DOF</strong></h3>
          <form action="{{ route('inicio.administrar.guardar_publicacion_dof') }}" method="post" id="frm_publicacion_dof">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span6 control-group">
                <label>Descripción (requerido)</label>
                <input type="text" name="detalle_descripcion" value="{{ old('detalle_descripcion') }}" maxlength="40" class="span6">
              </div>
              <div class="span6 control-group">
                <label>URL (requerido)</label>
                <input type="text" name="detalle_url" value="{{ old('detalle_url') }}" maxlength="255" class="span6">
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
              <a class="btn btn-default" href="{{ route('inicio.administrar.publicaciones-dof') }}" title="Ir al listado">
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
      $('#frm_publicacion_dof').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_publicacion_dof .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_publicacion_dof .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_publicacion_dof :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
