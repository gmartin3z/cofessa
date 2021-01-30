@extends('main')

@section('title')
  Editar sección enlaces de interés
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
          <h4 class="title">Editar sección enlaces de interés</h4>
          <p>
            Aquí puede ver, crear y editar elementos de la sección enlaces de interés, pero 
            <b>solo se visualizarán hasta los últimos 10 registrados</b> en la página de inicio.
            No es necesario borrar o editar los datos agregados previamente.
          </p>
          @if (count($menu_enlaces) > 0)
            <b>Total de secciones:</b> {{ $menu_enlaces->total() }}
            <a class="btn btn-danger btn-mini" href="{{ route('inicio.manage') }}" title="Ir al panel">
              <i class="icon-arrow-left"></i> Ir al panel
            </a>
            <a class="btn btn-success btn-mini" href="{{ route('inicio.administrar.crear_seccion_enlaces') }}" title="Agregar registro">
              <i class="icon-plus"></i> Crear registro
            </a>
            <br>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th><center>Opciones</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($menu_enlaces as $menu_enlace)
                    <tr>
                      <td>{{ $menu_enlace->menu_id }}</td>
                      <td>{{ $menu_enlace->descripcion }}</td>
                      <td>
                      <center>
                        <a href="{{ route('inicio.administrar.editar_seccion_enlaces', $menu_enlace->menu_id) }}" title="Editar detalles del registro {{ $menu_enlace->menu_id }}" class="btn btn-mini btn-warning">
                          <i class="icon-pencil"></i>
                        </a>
                        <a href="{{ route('inicio.administrar.enlaces', $menu_enlace->menu_id) }}" title="Agregar enlace {{ $menu_enlace->menu_id }}" class="btn btn-mini btn-default">
                          Agregar enlaces
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
                {{ $menu_enlaces->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay elementos</h3>
            <p class="aligncenter">
              <a href="{{ route('inicio.administrar.crear_seccion_enlaces') }}">Agregue al menos uno</a>
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
