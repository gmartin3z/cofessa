@extends('main')

@section('title')
  Perfil
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="inner-headline">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="inner-heading">
            <h2>Perfil</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <div class="container">
      <div class="row team">
        @include('partials.alerts')
        <div class="span12">
          <h4 class="title">Información del <strong>usuario</strong></h4>
        </div>
        <div class="span12">
          <div class="team-box">
            <div class="icon">
              <i class="icon-circled icon-bgprimary icon-user icon-5x"></i>
            </div>
            <div class="roles aligncenter">
              <p class="lead"><strong>{{ Auth::user()->alias }}</strong></p>
              <p>{{ Auth::user()->correo }}</p>
              <br>
              Registrado desde
              <strong>
              {{
                Date::createFromTimestamp(
                  strtotime(Auth::user()->fecha_creacion)
                )->format('D, j M, Y (h:i a)')
              }}
              </strong>
              <br>
              @if (!empty(Auth::user()->fecha_activacion))
                Activado desde
                <strong>
                {{
                  Date::createFromTimeStamp(
                    strtotime(Auth::user()->fecha_activacion)
                  )->diffForHumans()
                }}
                </strong>
              @else
                <strong>NO ACTIVADO</strong>
                 &raquo; <a href="{{ route('perfil.guardarOpConfirmarCorreo') }}">Activar</a>
              @endif
              <br>
              @if (!empty(Auth::user()->fecha_modificacion))
                Última modificación
                <strong>
                {{
                  Date::createFromTimeStamp(
                    strtotime(Auth::user()->fecha_modificacion)
                  )->diffForHumans()
                }}
                </strong>
              @else
                <strong>NO MODIFICADO</strong>
              @endif
              <br>
              <br>
              <p>
                <a class="btn btn-secondary btn-mini" href="{{ route('perfil.editarAlias') }}" title="Editar alias">
                  <i class="icon-pencil"></i> Editar alias
                </a>
                <a class="btn btn-success btn-mini" href="{{ route('perfil.editarCorreo') }}" title="Editar correo">
                  <i class="icon-envelope"></i> Editar correo
                </a>
                <a class="btn btn-warning btn-mini" href="{{ route('perfil.editarContrasenia') }}" title="Editar contraseña">
                  <i class="icon-key"></i> Editar contraseña
                </a>
                <a class="btn btn-danger btn-mini" href="{{ route('perfil.borrarUsuario') }}" title="Borrar usuario">
                  <i class="icon-remove"></i> Borrar usuario
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
