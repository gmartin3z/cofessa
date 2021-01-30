@extends('main')

@section('title')
  Crear servicio
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
          <h3 class="title">Crear <strong>servicio</strong></h3>
          <form action="{{ route('inicio.administrar.guardar_servicio') }}" method="post" enctype="multipart/form-data" id="frm_servicio">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span4 control-group">
                <label>Resumen (requerido)</label>
                <input type="text" name="detalle_resumen" value="{{ old('detalle_resumen') }}" maxlength="80" class="span4">
              </div>
              <div class="span4 control-group">
                <label>URL (requerido)</label>
                <input type="text" name="detalle_url" value="{{ old('detalle_url') }}" maxlength="255" class="span4">
              </div>
              <div class="span4 control-group">
                <label for="avatar">Elegir imagen (requerido)</label>
                <input type="file" name="detalle_imagen" accept="image/png, image/jpeg, image/bmp," id="cambiar_imagen">
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
              <a class="btn btn-default" href="{{ route('inicio.administrar.servicios') }}" title="Ir al listado">
                <i class="icon-arrow-left"></i> Ir al listado
              </a>
            </div>
          </form>
          <div class="row-fluid">
            <div class="span6 offset3">
              <center>
                <img id="img_servicio"
                src="{{ url('uploads/placeholder_image.png') }}"
                title="Nuevo servicio">
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra_js_functions')
  <script type="text/javascript">
    $(document).ready(function () {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#img_servicio').attr('src', e.target.result);
      }
       
      function readURL(input) {
        if (input.files && input.files[0]) {
          reader.readAsDataURL(input.files[0]);
        }
      }

      $('#cambiar_imagen').change(function() {
        readURL(this);
      });

      $('#frm_servicio').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_servicio .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_servicio .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_servicio :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
