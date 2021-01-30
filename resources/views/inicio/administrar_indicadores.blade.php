@extends('main')

@section('title')
  Editar tabla indicadores
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
  </style>
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span12">
          <h4 class="title">Editar tabla indicadores</h4>
          <p>
            Aquí puede ver, crear y editar indicadores, pero <b>solo se visualizarán
            hasta los últimos 10 registrados</b> en la página de inicio. No es necesario
            borrar o editar los registros agregados previamente.
          </p>
          @if (count($indicadores) > 0)
            <b>Indicadores registrados:</b> {{ $indicadores->total() }}
            <a class="btn btn-danger btn-mini" href="{{ route('inicio.manage') }}" title="Ir al panel">
              <i class="icon-arrow-left"></i> Ir al panel
            </a>
            <a class="btn btn-success btn-mini" href="{{ route('inicio.administrar.crear_indicador') }}" title="Agregar registro">
              <i class="icon-plus"></i> Crear registro
            </a>
            <br>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Valor</th>
                    <th><center>Opciones</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($indicadores as $indicador)
                    <tr>
                      <td>{{ $indicador->indicador_id }}</td>
                      <td>{{ $indicador->descripcion }}</td>
                      <td>{{ $indicador->valor }}</td>
                      <td>
                        <center>
                        <a href="{{ route('inicio.administrar.editar_indicador', $indicador->indicador_id) }}" title="Editar detalles del registro {{ $indicador->indicador_id }}" class="btn btn-mini btn-warning">
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
                {{ $indicadores->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay indicadores</h3>
            <p class="aligncenter">
              <a href="{{ route('inicio.administrar.crear_indicador') }}">Agregue al menos uno</a>.
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
