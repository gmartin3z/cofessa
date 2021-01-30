@extends('main')

@section('title')
  Perfil - Reestablecer usuario
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
            <h3 class="title">Reestablecer <strong>usuario</strong></h3>
            <form action="{{ route('perfil.guardarOpRecuperarUsuario') }}" method="post" id="frm_perfil">
              {{ csrf_field() }}
              <div class="row controls">
                <div class="span12 control-group">
                  <label>Correo</label>
                  <input type="text" name="correo" value="{{ old('correo') }}" maxlength="100" class="span6">
                </div>
                <div class="span12 form-group">
                  <label>Captcha</label>
                  <input type="text" class="span2" name="detalle_captcha">
                </div>
                <div class="span12 form-group">
                  <img src="{{ captcha_src('inverse') }}"
                    alt="captcha"
                    class="captcha-img"
                    data-refresh-config="default">
                  <button type="button" class="btn btn-info btn-reload" id="recargar_captcha">
                    <i class="icon-rotate-right icon-white"></i>
                  </button>
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

      $('#recargar_captcha').on('click', function () {
        var captcha = $('img.captcha-img');
        var config = captcha.data('refresh-config');
        var captcha_url = '{{ url("generar-captcha") }}';

        $('#frm_perfil :input').prop('disabled', true);
        $('#frm_perfil .btn-reload').find('i').addClass('icon-spin');

        $.ajax({
          method: 'get',
          url: captcha_url,
        }).done(function (response) {
          captcha.prop('src', response);
          // necesario para evitar envío formulario
          // antes de cargar nuevo captcha
          setTimeout(function () {
            $('#frm_perfil :input').prop('disabled', false);
            $('#frm_perfil .btn-reload').find('i').removeClass('icon-spin');
          }, 2000);
        });
      });
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
