@extends('main')

@section('title')
  Editar enlaces {{ $menu_documento->menu_descripcion }} (sección documentos y formatos)
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
          <h4>Detalles de la sección {{ $menu_documento->menu_descripcion }}</h4>
          <p>
            Aquí puede ver, crear y editar enlaces para la sección {{ $menu_documento->menu_descripcion }},
            pero <b>solo se visualizarán hasta un máximo de 15 registrados</b> en la página de inicio.
            No es necesario borrar o editar los elementos agregados previamente.
          </p>
          @if (count($submenu_documentos)> 0 && $menu_documento->submenu_id != null)
            <b>Enlaces registrados:</b> {{ $submenu_documentos->total() }}
            <a class="btn btn-danger btn-mini" href="{{ route('inicio.administrar.seccion_documentos') }}" title="Regresar">
              <i class="icon-arrow-left"></i> Regresar
            </a>
            <a class="btn btn-success btn-mini" href="{{ route('inicio.administrar.crear_enlace_documentos', $menu_documento->menu_id) }}" title="Agregar registro">
             <i class="icon-plus"></i>
            </a>
            <br>
            <table class="table table-condensed table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Descripción</th>
                  <th>URL</th>
                  <th><center>Opciones</center></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($submenu_documentos as $submenu_documento)
                  <tr>
                    <td>{{ $submenu_documento->submenu_id }}</td>
                    <td>{{ $submenu_documento->submenu_descripcion }}</td>
                    <td class="dividir-palabras">{{ $submenu_documento->url }}</td>
                    <td>
                    <center>
                      <a href="{{ route('inicio.administrar.editar_enlace_documentos', [$submenu_documento->menu_id, $submenu_documento->submenu_id]) }}" title="Editar detalles del registro {{ $submenu_documento->submenu_id }}" class="btn btn-mini btn-warning">
                        <i class="icon-pencil"></i>
                      </a>
                    </center>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <center>
              <div class="pagination">
                {{ $submenu_documentos->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay enlaces</h3>
            <p class="aligncenter">
              <a href="{{ route('inicio.administrar.crear_enlace_documentos', $menu_documento->menu_id) }}">Agregue al menos uno</a>
              <br>
              <a href="{{ route('inicio.administrar.seccion_documentos') }}">o regresar</a>
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
