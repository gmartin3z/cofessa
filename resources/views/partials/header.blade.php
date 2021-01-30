@section('header')
  <header>
    <div class="top">
      <div class="container">
        <div class="row">
          <div class="span6">
            <p class="topcontact">
              <i class="icon-phone"></i>
              (844) 410 70 40 de Lun - Vie de 09:00 AM a 06:00 PM
            </p>
          </div>
          <div class="span6">
            <ul class="social-network">
              <li>
                <a href="http://www.facebook.com/cofessa" data-placement="bottom" target="_blank" title="Facebook">
                  <i class="icon-facebook icon-white"></i>
                </a>
              </li>
              <li>
                <a href="http://www.twitter.com/COFESSA" data-placement="bottom" target="_blank" title="Twitter">
                  <i class="icon-twitter icon-white"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row nomargin">
        <div class="span4">
          <div class="logo">
            <a href="{{ route('index') }}"><img src="{{ asset('img/logo.svg') }}" style="width:120px"></a>
          </div>
        </div>
        <div class="span8">
          <div class="navbar navbar-static-top">
            <div class="navigation">
              @if (Auth::check() == false)
                <nav>
                  <ul class="nav topnav">
                    <li>
                      <a href="{{ route('inicio') }}"><i class="icon-home"></i> Inicio</a>
                    </li>
                    <li>
                      <a href="{{ route('empresa') }}">Empresa</a>
                    </li>
                    <li>
                      <a href="{{ route('quienes_somos') }}">¿Quiénes somos?</a>
                    </li>
                    <li>
                      <a href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li>
                      <a href="{{ route('contacto') }}">Contacto</a>
                    </li>
                  </ul>
                </nav>
              @else
                <nav>
                  <ul class="nav topnav">
                    <li class="dropdown">
                      <a href="{{ route('inicio') }}"><i class="icon-home"></i> Inicio</a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('inicio') }}">Ver</a></li>
                        <li><a href="{{ route('inicio.manage') }}">Administrar</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="{{ route('empresa') }}">Empresa</a>
                    </li>
                    <li>
                      <a href="{{ route('quienes_somos') }}">¿Quiénes somos?</a>
                    </li>
                    <li>
                      <a href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li class="dropdown">
                      <a href="{{ route('contacto') }}">Contacto</a>
                      <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('contacto') }}">Ver</a></li>
                        <li><a href="{{ route('contacto.manage') }}">Administrar</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="{{ route('perfil.index') }}"><i class="icon-user"></i> Perfil</a>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a href="{{ route('perfil.index') }}">Ver</a>
                        </li>
                        <li>
                          <a href="{{ route('salir') }}">Salir</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
@endsection
