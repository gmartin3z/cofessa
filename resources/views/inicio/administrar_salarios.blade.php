@extends('main')

@section('title')
  Editar tabla salarios
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
          <h4 class="title">Editar tabla salarios</h4>
          <p>
            Aquí puede ver, crear y editar salarios, pero <b>solo se visualizarán
            hasta los últimos 10 registrados</b> en la página de inicio. No es necesario
            borrar o editar los registros agregados previamente.
          </p>
          @if (count($salarios) > 0)
            <b>Salarios registrados:</b> {{ $salarios->total() }}
            <a class="btn btn-danger btn-mini" href="{{ route('inicio.manage') }}" title="Ir al panel">
              <i class="icon-arrow-left"></i> Ir al panel
            </a>
            <a class="btn btn-success btn-mini" href="{{ route('inicio.administrar.crear_salario') }}" title="Agregar registro">
              <i class="icon-plus"></i> Crear registro
            </a>
            <br>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Vigencia</th>
                    <th>Valor a</th>
                    <th>Valor b</th>
                    <th><center>Opciones</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($salarios as $salario)
                    <tr>
                      <td>{{ $salario->salario_id }}</td>
                      <td>{{ $salario->vigencia }}</td>
                      <td>{{ $salario->valor_a }}</td>
                      <td>{{ $salario->valor_b }}</td>
                      <td>
                      <center>
                        <a href="{{ route('inicio.administrar.editar_salario', $salario->salario_id) }}" title="Editar detalles del registro {{ $salario->salario_id }}" class="btn btn-mini btn-warning">
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
                {{ $salarios->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay salarios</h3>
            <p class="aligncenter">
              <a href="{{ route('inicio.administrar.crear_salario') }}">Agregue al menos uno</a>.
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
