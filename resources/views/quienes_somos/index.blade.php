@extends('main')

@section('title')
  ¿Quiénes somos?
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
            <h2>¿Quiénes somos?</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span12">
          <h4>Un poco de nuestra historia...</h4>
          <p>
            En 1995 inició como Persona Física a nombre del C.P.
            Salvador Antonio Solís Santos, brindando los servicios
            de un Despacho Contable y en el año del 2005 se constituye
            como una Sociedad, incorporándose en el Area de Auditoría
            y Administración la C.P. Martha Paola Jaramillo Morales;
            en el Area Fiscal la C.P. Silvia Karina Velázquez Hernandez
            y el C.P. Saúl Iván Rodríguez Salas y en el área de seguridad social
            la L.A.E. Ana Arely Solís Santos, además de diversos colaboradores;
            resultando la Firma "Consultoría y Outsourcing Fiscal Empresarial
            Solís Santos, S.C." (COFESSA).
          </p>
        </div>
      </div>
      <div class="row">
        <div class="span12">
          <div class="solidline"></div>
        </div>
      </div>
      <div class="row team">
        <div class="span12">
          <h4 class="title">Staff <strong>directivo</strong></h4>
        </div>
        <div class="span12">
          <div class="team-box">
            <div class="icon">
              <i class="icon-circled icon-bgwarning icon-trophy icon-5x"></i>
            </div>
            <div class="roles aligncenter">
              <p class="lead"><strong>C.P., E.F. y M.I Salvador Antonio Solís Santos</strong></p>
              <p>
                Socio - Director
              </p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="team-box">
            <div class="icon">
              <i class="icon-circled icon-bgsuccess icon-legal icon-4x"></i>
            </div>
            <div class="roles aligncenter">
              <p class="lead"><strong>C.P. Silvia Karina Velázquez Hernández</strong></p>
              <p>
                Fiscalista
              </p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="team-box">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-building icon-4x"></i>
            </div>
            <div class="roles aligncenter">
              <p class="lead"><strong>C.P. Martha Paola Jaramillo Morales</strong></p>
              <p>
                Auditoría y administrativo
              </p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="team-box">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-home icon-4x"></i>
            </div>
            <div class="roles aligncenter">
              <p class="lead"><strong>L.A.E. Ana Arely Solís Santos</strong></p>
              <p>
                Seguridad social e INFONAVIT
              </p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="team-box">
            <div class="icon">
              <i class="icon-circled icon-bgsuccess icon-legal icon-4x"></i>
            </div>
            <div class="roles aligncenter">
              <p class="lead"><strong>C.P. Saul Iván Rodríguez Salas</strong></p>
              <p>
                Fiscalista
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="blankline30"></div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
