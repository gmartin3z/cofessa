@extends('main')

@section('title')
  Ingresar
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
            <h3 class="title"><strong>Ingresar</strong></h3>
            <form action="{{ route('ingresar.realizar_login') }}" method="post" id="frm_ingresar">
              {{ csrf_field() }}
              <div class="row controls">
                <div class="span12 control-group">
                  <label>Correo</label>
                  <input type="text" class="span4" name="correo" value="{{ old('correo') }}" maxlength="100">
                </div>
                <div class="span12 control-group">
                  <label>Contraseña</label>
                  <input type="password" class="span4" name="contra" maxlength="150">
                </div>
                <div class="span12 form-group">
                  <label>Captcha</label>
                  <input type="text" class="span2" name="detalle_captcha" maxlength="6">
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
                  <div class="form-inline">
                    <br>
                    <label class="checkbox">
                      <input type="checkbox" name="recordar"> Recordar sesión
                    </label>
                  </div>
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
      $('#frm_ingresar').on('click', '#enviar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_ingresar .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_ingresar .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_ingresar :input')
          .prop('disabled', true);
      }

      $('#recargar_captcha').on('click', function () {
        var captcha = $('img.captcha-img');
        var config = captcha.data('refresh-config');
        var captcha_url = '{{ url("generar-captcha") }}';

        $('#frm_ingresar :input').prop('disabled', true);
        $('#frm_ingresar .btn-reload').find('i').addClass('icon-spin');

        $.ajax({
          method: 'get',
          url: captcha_url,
        }).done(function (response) {
          captcha.prop('src', response);
          // necesario para evitar envío formulario
          // antes de cargar nuevo captcha
          setTimeout(function () {
            $('#frm_ingresar :input').prop('disabled', false);
            $('#frm_ingresar .btn-reload').find('i').removeClass('icon-spin');
          }, 2000);
        });
      });
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
