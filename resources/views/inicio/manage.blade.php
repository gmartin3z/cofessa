@extends('main')

@section('title')
  Adminstrar inicio
@stop

@section('header')
  @include('partials.header')
@endsection

@section('extra_css_styles')
  <style type="text/css">
    a.remover-subrayado{
      text-decoration: none;
    }
  </style>
@endsection

@section('content')
  <section id="inner-headline">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span12">
          <div class="inner-heading">
            <h2>Administrar inicio</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span12">
          <p>
          Desde aquí podrá manipular el contenido del panel de inicio.
          </p>
        </div>
      </div>
      <div class="row">
        <div class="span6">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <a href="{{ route('inicio.administrar.noticias') }}" title="Editar noticias" class="remover-subrayado">
                <i class="icon-circled icon-bgsuccess icon-rss-sign icon-5x"></i>
              </a>
            </div>
            <h5>Editar <span class="colored">noticias</span></h5>
          </div>
        </div>
        <div class="span6">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <a href="{{ route('inicio.administrar.servicios') }}" title="Editar servicios" class="remover-subrayado">
                <i class="icon-circled icon-bgdanger icon-bell-alt icon-5x"></i>
              </a>
            </div>
            <h5>Editar <span class="colored">servicios</span></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span4">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <a href="{{ route('inicio.administrar.indicadores') }}" title="Editar indicadores" class="remover-subrayado">
               <i class="icon-circled icon-bgsuccess icon-bar-chart icon-4x"></i>
              </a>
            </div>
            <h5>Editar tabla <span class="colored">indicadores</span></h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyIn">
            <div class="icon">
              <a href="{{ route('inicio.administrar.datos') }}" title="Editar datos" class="remover-subrayado">
               <i class="icon-circled icon-bgdanger icon-exchange icon-4x"></i>
              </a>
            </div>
            <h5>Editar tabla <span class="colored">datos</span></h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <a href="{{ route('inicio.administrar.salarios') }}" title="Editar salarios" class="remover-subrayado">
               <i class="icon-circled icon-bgwarning icon-money icon-4x"></i>
              </a>
            </div>
            <h5>Editar tabla <span class="colored">salarios</span></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span4">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <a href="{{ route('inicio.administrar.actualidades') }}" title="Editar actualidades" class="remover-subrayado">
               <i class="icon-circled icon-bgsuccess icon-calendar icon-4x"></i>
              </a>
            </div>
            <h5>Editar enlaces <span class="colored">actualidades</span></h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyIn">
            <div class="icon">
              <a href="{{ route('inicio.administrar.publicaciones') }}" title="Editar publicaciones" class="remover-subrayado">
                <i class="icon-circled icon-bgdanger icon-link icon-4x"></i>
              </a>
            </div>
            <h5>Editar enlaces <span class="colored">publicaciones</span></h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <a href="{{ route('inicio.administrar.publicaciones-dof') }}" title="Editar publicaciones DOF" class="remover-subrayado">
                <i class="icon-circled icon-bgwarning icon-book icon-4x"></i>
              </a>
            </div>
            <h5>Editar enlaces <span class="colored">publicaciones DOF</span></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span6">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <a href="{{ route('inicio.administrar.seccion_documentos') }}" title="Editar sección documentos y formatos" class="remover-subrayado">
                <i class="icon-circled icon-bgsuccess icon-legal icon-5x"></i>
              </a>
            </div>
            <h5>Editar sección <span class="colored">documentos y formatos</span></h5>
          </div>
        </div>
        <div class="span6">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <a href="{{ route('inicio.administrar.seccion_enlaces') }}" title="Editar sección enlaces de interés" class="remover-subrayado">
                <i class="icon-circled icon-bgdanger icon-bookmark icon-5x"></i>
              </a>
            </div>
            <h5>Editar sección <span class="colored">enlaces de interés</span></h5>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection