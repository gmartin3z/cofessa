@section('footer')
  <footer>
    <div class="container">
      <div class="row">
        <div class="span4">
          <div class="widget">
            <h5 class="widgetheading">Navegaci&oacute;n</h5>
            <ul class="link-list">
              <li><a href="{{ route('inicio') }}">Inicio</a></li>
              <li><a href="{{ route('empresa') }}">Empresa</a></li>
              <li><a href="{{ route('quienes_somos') }}">¿Quiénes somos?</a></li>
              <li><a href="{{ route('servicios') }}">Servicios</a></li>
              <li><a href="{{ route('contacto') }}">Contacto</a></li>
            </ul>
          </div>
        </div>
        <div class="span4">
          <div class="widget">
            <h5 class="widgetheading">Dirección</h5>
            <address>
            <strong>COFESSA S.C.</strong><br>
            Calle Gral. Manuel Pérez Treviño 1664<br>
            Fracc. Urdiñola, C.P. 25020<br>
            Saltillo, Coahuila, México.
            </address>
          </div>
        </div>
        <div class="span4">
          <div class="widget">
            <h5 class="widgetheading">Contacto</h5>
            <p>
              <i class="icon-phone"></i> (844) 410 70 40<br>
              <i class="icon-time"></i> Lun-Vie de 09:00 AM a 06:00 PM
            </p>
            <p>
              <a href="http://www.facebook.com/cofessa" data-placement="bottom" target="_blank" title="Facebook">
                <i class="icon-facebook icon-white"></i> Facebook
              </a>
              <br>
              <a href="http://www.twitter.com/COFESSA" data-placement="bottom" target="_blank" title="Twitter">
                <i class="icon-twitter icon-white"></i> Twitter
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div id="sub-footer">
      <div class="container">
        <div class="row">
          <div class="span6">
            <div class="copyright">
              <p>
                <span>
                  Cofessa &copy; 2012 - {{ date('Y') }}. Derechos reservados.
                </span>
              </p>
              <p>
                <span>
                  Diseño hecho por <a href="https://bootstrapmade.com/">BootstrapMade</a>
                  y desarrollado por Bitbank</a>.
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
@endsection
