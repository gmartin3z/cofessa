@extends('main')

@section('title')
  Contacto
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="inner-headline">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span12">
          <div class="inner-heading">
            <h2>Contacto</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <iframe 
      src="http://maps.google.com.mx/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=perez+trevi%C3%B1o+%231664+urdi%C3%B1ola+&amp;aq=&amp;sll=23.625269,-102.540613&amp;sspn=22.50562,43.286133&amp;ie=UTF8&amp;hq=&amp;hnear=General+M.+P%C3%A9rez+Trevi%C3%B1o+1664,+Urdinola,+Saltillo,+Coahuila+de+Zaragoza&amp;t=m&amp;ll=25.417811,-100.983281&amp;spn=0.00533,0.007789&amp;z=17&amp;iwloc=A&amp;output=embed" 
      width="100%"
      height="380"
      frameborder="0"
      style="border:0"
      allowfullscreen>
    </iframe>
    <div class="container">
      <div class="row">
        <div class="span8">
          <h4>Cualquier inquietud que tenga puede enviarla en el siguiente formulario</h4>
          <form action="{{ route('contacto.guardar_solicitud') }}" method="post" role="form" class="contactForm" id="frm_contacto">
            {{ csrf_field() }}
            <div class="row">
              <div class="span4 form-group field">
                <input type="text" name="detalle_nombre" value="{{ old('detalle_nombre') }}" placeholder="Nombre">
              </div>
              <div class="span4 form-group">
                <input type="email" name="detalle_correo" value="{{ old('detalle_correo') }}" placeholder="Correo">
              </div>
              <div class="span8 form-group">
                <input type="text" name="detalle_motivo" value="{{ old('detalle_motivo') }}" placeholder="Motivo">
              </div>
              <div class="span8 form-group">
                <div class="aligncenter">
                  <i>*** Si lo considera necesario, agrege su número telefónico en el campo mensaje ***</i>
                </div>
                <textarea name="detalle_mensaje" rows="5" placeholder="Mensaje">{{ old('detalle_mensaje') }}</textarea>
              </div>
              <div class="span8 form-group">
                <input type="text" class="span2" name="detalle_captcha" placeholder="Captcha">
              </div>
              <div class="span8 form-group">
                <div class="aligncenter">
                  <img src="{{ captcha_src('inverse') }}"
                    alt="captcha"
                    class="captcha-img"
                    data-refresh-config="default">
                  <button type="button" class="btn btn-info btn-reload" id="recargar_captcha">
                    <i class="icon-rotate-right icon-white"></i>
                  </button>
                </div>
              </div>
              <div class="span8 form-group">
                <div class="text-center">
                  <button type="submit" class="btn btn-success btn-submit btn-medium margintop10" id="guardar_datos">
                    <span class="btn-txt">Enviar datos</span>
                  </button>
                  <button type="reset" class="btn btn-danger btn-medium margintop10">
                    Limpiar todo
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="span4">
          <div class="clearfix"></div>
          <aside class="right-sidebar">
            <div class="widget">
              <h5 class="widgetheading">Información de contacto<span></span></h5>
              <ul class="contact-info">
                <li>
                  <label>Dirección:</label>
                  Calle Gral. Manuel Pérez Treviño 1664<br>
                  Fracc. Urdiñola, C.P. 25020<br>
                  Saltillo, Coahuila, México.
                </li>
                <li>
                  <label>Atención:</label>
                  Lun-Vie de 09:00 AM a 06:00 PM
                </li>
                <li>
                  <label>Redes sociales:</label>
                  facebook.com/cofessa<br>
                  twitter.com/COFESSA
                </li>
              </ul>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra_js_functions')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#frm_contacto').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_contacto .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_contacto .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_contacto :input')
          .prop('disabled', true);
      }

      $('#recargar_captcha').on('click', function () {
        var captcha = $('img.captcha-img');
        var config = captcha.data('refresh-config');
        var captcha_url = '{{ url("generar-captcha") }}';

        $('#frm_contacto :input').prop('disabled', true);
        $('#frm_contacto .btn-reload').find('i').addClass('icon-spin');

        $.ajax({
          method: 'get',
          url: captcha_url,
        }).done(function (response) {
          captcha.prop('src', response);
          // necesario para evitar envío formulario
          // antes de cargar nuevo captcha
          setTimeout(function () {
            $('#frm_contacto :input').prop('disabled', false);
            $('#frm_contacto .btn-reload').find('i').removeClass('icon-spin');
          }, 2000);
        });
      });
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection