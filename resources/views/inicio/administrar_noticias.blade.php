@extends('main')

@section('title')
  Editar noticias
@stop

@section('header')
  @include('partials.header')
@endsection

@section('extra_css_styles')
  <style type="text/css">
    @media screen and (max-width: 767px) {
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
      }
    }

    .dividir-palabras {
      word-break: break-word;
    }
  </style>
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span12">
          <h4 class="title">Editar noticias</h4>
          <p>
            Aquí puede ver, crear y editar noticias, pero <b>solo se visualizarán
            mínimo 3 y máximo 10 </b> en la página de inicio. No es necesario
            borrar o editar los registros agregados previamente.
          </p>
          @if (count($noticias) > 0)
            <b>Noticias registradas:</b> {{ $noticias->total() }}
            <a class="btn btn-danger btn-mini" href="{{ route('inicio.manage') }}" title="Ir al panel">
              <i class="icon-arrow-left"></i> Ir al panel
            </a>
            <a class="btn btn-success btn-mini" href="{{ route('inicio.administrar.crear_noticia') }}" title="Agregar registro">
              <i class="icon-plus"></i> Crear registro
            </a>
            <br>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Resumen</th>
                    <th>URL</th>
                    <th><center>Opciones</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($noticias as $noticia)
                    <tr>
                      <td>{{ $noticia->noticia_id }}</td>
                      <td>{{ $noticia->titulo }}</td>
                      <td>{{ $noticia->resumen }}</td>
                      <td class="dividir-palabras">{{ $noticia->url }}</td>
                      <td>
                        <center>
                        <a href="{{ route('inicio.administrar.mostrar_noticia', $noticia->noticia_id) }}" title="Mostrar detalles del registro {{ $noticia->noticia_id }}" class="btn btn-mini btn-default">
                          <i class="icon-eye-open"></i>
                        </a>
                        <a href="{{ route('inicio.administrar.editar_noticia', $noticia->noticia_id) }}" title="Editar detalles del registro {{ $noticia->noticia_id }}" class="btn btn-mini btn-warning">
                          <i class="icon-pencil"></i>
                        </a>
                        </center>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <center>
              <div class="pagination">
                {{ $noticias->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay noticias</h3>
            <p class="aligncenter">
              <a href="{{ route('inicio.administrar.crear_noticia') }}">Agregue al menos tres</a>.
            </p>
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
