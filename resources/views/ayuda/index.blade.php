@extends('main')

@section('title')
  Ayuda
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
            <h2>Ayuda</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span12">
          <h4 class="title">Preguntas <strong>frecuentes</strong></h4>
          <!-- start: Accordion -->
          <div class="accordion" id="accordion2">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  <i class="icon-minus"></i>
                  Pregunta 1
                </a>
              </div>
              <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                  Contenido de la pregunta 1.
                </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  <i class="icon-minus"></i>
                  Pregunta 2
                </a>
              <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
                  Contenido de la pregunta 2.
                </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                  <i class="icon-plus"></i>
                  Pregunta 3
                </a>
              </div>
              <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner">
                  Contenido de la pregunta 3.
                </div>
              </div>
            </div>
          </div>
          <!--end: Accordion -->
          
          <div class="blankline30"></div>
          <div class="solidline"></div>
          <div class="blankline20"></div>

          <h4 class="title">Otras <strong>cuestiones</strong></h4>
          <!-- start: Accordion -->
          <div class="accordion" id="accordion2">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  <i class="icon-minus"></i>
                  Pregunta 1
                </a>
              </div>
              <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                  Contenido de la pregunta 1.
                </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  <i class="icon-minus"></i>
                  Pregunta 2
                </a>
              <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
                  Contenido de la pregunta 2.
                </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                  <i class="icon-plus"></i>
                  Pregunta 3
                </a>
              </div>
              <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner">
                  Contenido de la pregunta 3.
                </div>
              </div>
            </div>
          </div>
          <!--end: Accordion -->
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
