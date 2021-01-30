@extends('main')

@section('title')
  Perfil - Recuperar usuario
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
            <h3 class="title">Recuperar <strong>usuario</strong></h3>
            <form action="{{ route('perfil.recuperarUsuario') }}" method="post" id="frm_perfil">
              {{ csrf_field() }}
              <div class="row controls">
                <input type="hidden" name="usuario_id" value="{{ $usuario_id }}" id="usuario_id">
                <input type="hidden" name="tipo_operacion_id" value="{{ $tipo_operacion_id }}" id="tipo_operacion_id">
                <input type="hidden" name="token_operacion" value="{{ $token_operacion }}" id="token_operacion">
                <div class="span12 control-group">
                  <label>Correo</label>
                  <input type="text" name="correo" value="{{ old('correo') }}" maxlength="100" class="span6">
                </div>
                <div class="span12 control-group">
                  <label>Nueva contraseña</label>
                  <input type="password" name="contra" value="{{ old('contra') }}" maxlength="100" class="span6">
                </div>
                <div class="span12 control-group">
                  <label>Confirmar contraseña</label>
                  <input type="password" name="confirmar_contra" value="{{ old('confirmar_contra') }}" maxlength="100" class="span6">
                </div>
                <div class="span12 form-group">
                  <div class="btn-toolbar">
                    <button type="submit" class="btn btn-success btn-submit" id="enviar_datos">
                      <span class="btn-txt">Enviar datos</span>
                    </button>
                    <button type="reset" class="btn btn-danger">
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
