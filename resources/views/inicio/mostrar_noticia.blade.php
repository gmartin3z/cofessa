@extends('main')

@section('title')
  Mostrar noticia {{ $noticia->noticia_id }}
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')      
        <div class="span8">
          <article class="single">
            <div class="row">
              <div class="span12">
                <div class="post-image">
                  <div class="post-heading">
                    <h3>
                    <strong>
                      <span class="colored">
                        {{ $noticia->titulo }}
                      </span>
                    </strong>
                    </h3>
                  </div>
                  <div class="row-fluid">
                    <div class="span6 offset3">
                      <center>
                        <img id="img_noticia"
                          src="{{ url('uploads/imgs_noticias/'.$noticia->imagen) }}"
                          alt="{{ $noticia->titulo }}">
                      </center>
                    </div>
                  </div>
                </div>
                <p>
                  {{ $noticia->resumen }}... leer más en 
                  <strong><a href="{{ $noticia->url }}">{{ $noticia->url }}</a></strong>
                </p>
                <P>
                  <a class="btn btn-default" href="{{ route('inicio.administrar.noticias') }}" title="Ir al listado">
                    <i class="icon-arrow-left"></i> Ir al listado
                  </a>
                </P>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
