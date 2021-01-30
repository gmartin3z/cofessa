@extends('main')

@section('title')
  Editar servicio {{ $servicio->servicio_id }}
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
          <h3 class="title">Editar <strong>servicio</strong></h3>
          <form action="{{ route('inicio.administrar.actualizar_servicio', $servicio->servicio_id) }}" method="post" enctype="multipart/form-data" id="frm_servicio">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="put">
            <div class="row controls">
              <div class="span4 control-group">
                <label>Resumen (requerido)</label>
                <input type="text" name="detalle_resumen" value="{{ $servicio->resumen or old('detalle_resumen') }}" maxlength="80" class="span4">
              </div>
              <div class="span4 control-group">
                <label>URL (requerido)</label>
                <input type="text" name="detalle_url" value="{{ $servicio->url or old('detalle_url') }}" maxlength="255" class="span4">
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
          <form action="{{ route('inicio.administrar.borrar_servicio', $servicio->servicio_id) }}" method="post" id="frm_borrar_servicio">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="delete">
            <button type="submit" class="btn btn-danger btn-delete" id="borrar_datos">
              <span class="btn-txtb">Borrar registro</span>
            </button>
          </form>
          <div class="row-fluid">
            <div class="span6 offset3">
              <center>
                <img id="img_servicio"
                  src="{{ url('uploads/imgs_servicios/'.$servicio->imagen) }}"
                  title="{{ $servicio->url }}">
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
            disableFormUpdate();
          }, 0);
        });

        $('#frm_borrar_servicio').on('click', '#borrar_datos', function (event) {
          setTimeout(function () {
            disableFormDelete();
          }, 0);
        });

        function disableFormUpdate() {
          $('#frm_servicio .btn-submit')
            .find('span.btn-txt').text('Espere...');
          $('#frm_servicio .btn-submit')
            .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
          $('#frm_servicio :input')
            .prop('disabled', true);

          $('#frm_borrar_servicio :input').prop('disabled', true);
        }

        function disableFormDelete() {
          $('#frm_borrar_servicio .btn-delete')
            .find('span.btn-txtb').text('Espere...');
          $('#frm_borrar_servicio .btn-delete')
            .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
          $('#frm_borrar_servicio :input').prop('disabled', true);

          $('#frm_servicio :input').prop('disabled', true);
        }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
