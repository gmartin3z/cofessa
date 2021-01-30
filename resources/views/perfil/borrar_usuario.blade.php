@extends('main')

@section('title')
  Perfil - Borrar usuario
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
          <center>
            <h3 class="title">Borrar <strong>usuario</strong></h3>
            <form action="{{ route('perfil.guardarOpEliminarUsuario') }}" method="post" id="frm_perfil">
              {{ csrf_field() }}
              <div class="row controls">
                <div class="span12 control-group">
                  <label>Contraseña</label>
                  <input type="password" name="contra" value="{{ old('contra') }}" maxlength="100" class="span6">
                </div>
                <div class="span12 control-group">
                  <label>Confirmar contraseña</label>
                  <input type="password" name="confirmar_contra" value="{{ old('confirmar_contra') }}" maxlength="100" class="span6">
                </div>
                <div class="span12 form-group">
                  <div class="btn-toolbar">
                    <button type="submit" class="btn btn-danger btn-submit" id="enviar_datos">
                      <span class="btn-txt">Enviar datos</span>
                    </button>
                    <button type="reset" class="btn btn-default">
                      Limpiar todo
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </center>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra_js_functions')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#frm_perfil').on('click', '#enviar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_perfil .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_perfil .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_perfil :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
