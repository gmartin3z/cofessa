@extends('main')

@section('title')
  Servicios
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
            <h2>Servicios</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span12">
          <h4 class="title">Lo que hacemos</h4>
          <p>
          Los servicios que actualmente ofrecemos
          están encaminados a una asesoría integral
          en el campo de la Contaduría Pública.
          </p>
        </div>
      </div>
      <div class="row">
        <div class="span4">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <i class="icon-circled icon-bgsuccess icon-ok icon-4x"></i>
            </div>
            <h5>
              Contabilidad <br>
              <span class="colored">General</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyIn">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-hospital icon-4x"></i>
            </div>
            <h5>
              Asesoría de Seguridad Social
              e <span class="colored">INFONAVIT</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <i class="icon-circled icon-bgwarning icon-calendar icon-4x"></i>
            </div>
            <h5>
              Planeación Fiscal <br>
              <span class="colored">Integral</span>
            </h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span4">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <i class="icon-circled icon-bgsuccess icon-building icon-4x"></i>
            </div>
            <h5>
              Planeación Financiera, Control Interno
              e <span class="colored">Inventarios</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyIn">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-money icon-4x"></i>
            </div>
            <h5>
              Planeación, Control de Inversiones 
              y <span class="colored">Presupuestos</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <i class="icon-circled icon-bgwarning icon-exchange icon-4x"></i>
            </div>
            <h5>
              Pronósticos de efectivos <br>
              y <br> <span class="colored">Flujogramas</span>
            </h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span4">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <i class="icon-circled icon-bgsuccess icon-arrow-down icon-4x"></i>
            </div>
            <h5>
              Cálculo y Asesoría sobre 
              <span class="colored">Impuestos</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyIn">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-briefcase icon-4x"></i>
            </div>
            <h5>
              Servicio de <br>
              <span class="colored">Auditorías</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <i class="icon-circled icon-bgwarning icon-globe icon-4x"></i>
            </div>
            <h5>
              Comercio Exterior
              <span class="colored">General</span>
            </h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span4">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <i class="icon-circled icon-bgsuccess icon-credit-card icon-4x"></i>
            </div>
            <h5>
              Administración y Outsourcing
              de <span class="colored">Nóminas</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyIn">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-group icon-4x"></i>
            </div>
            <h5>
              Outsourcing de
              <br><span class="colored">Personal</span>
            </h5>
          </div>
        </div>
        <div class="span4">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <i class="icon-circled icon-bgwarning icon-folder-open icon-4x"></i>
            </div>
            <h5>
              Depuración de <br>
              <span class="colored">Cuentas</span>
            </h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="span12">
          <div class="cta-box">
            <div class="row">
              <div class="span8">
                <div class="cta-text">
                  <h2>
                    Si necesita más información o cotizar 
                    <span>contáctenos</span> y con gusto 
                    le atenderemos
                  </h2>
                </div>
              </div>
              <div class="span4">
                <div class="cta-btn" style="white-space: nowrap;">
                  <a href="{{ route('contacto') }}" class="btn btn-theme">
                    Contactar <i class="icon-angle-right"></i>
                  </a>
                </div>
              </div>
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
