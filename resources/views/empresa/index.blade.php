@extends('main')

@section('title')
  Empresa
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
            <h2>Empresa</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <i class="icon-circled icon-bgwarning icon-info-sign icon-4x"></i>
            </div>
            <h5>Información <span class="colored">principal</span></h5>
            <p>
              Esta firma está encaminada a ofrecer servicios integrales de Contaduría Pública,
              brindando servicio a diversos giros en el área Comercial, Industrial,
              Maquila, Social y de Servicios.
            </p>
          </div>
        </div>
        <div class="span6">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <i class="icon-circled icon-bgdark icon-flag-checkered icon-4x"></i>
            </div>
            <h5>Nuestra <span class="colored">misión</span></h5>
            <p>
              Proporcionar servicios de alta calidad y confidencialidad con tecnología
              de punta en la Contaduría Pública, basados en el profesionalismo, la ética,
              la honestidad y seriedad en beneficio de las entidades públicas y privadas.
            </p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="span6">
          <div class="service-box aligncenter flyLeft">
            <div class="icon">
              <i class="icon-circled icon-bginfo icon-eye-open icon-4x"></i>
            </div>
            <h5>Nuestra <span class="colored">visión</span></h5>
            <p>
              Ser una firma que aporta a empresas públicas y privadas un valor agregado
              a través de un servicio integral en el campo de la Contaduría Pública,
              existiendo a su vez retroalimentación para un crecimiento conjunto.
            </p>
          </div>
        </div>
        <div class="span6">
          <div class="service-box aligncenter flyRight">
            <div class="icon">
              <i class="icon-circled icon-bgdanger icon-bullseye icon-4x"></i>
            </div>
            <h5>Nuestro <span class="colored">Objetivo</span></h5>
            <p>
              A través de la información oportuna, actualizada y confiable nuestros clientes
              pueden aplicar la mejor toma de decisiones en forma eficaz para su propio
              beneficio económico.
            </p>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection