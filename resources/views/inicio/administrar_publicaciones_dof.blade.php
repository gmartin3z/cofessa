@extends('main')

@section('title')
  Editar enlaces publicaciones DOF
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
          <h4 class="title">Editar enlaces publicaciones DOF</h4>
          <p>
            Aquí puede ver, crear y editar los enlaces de publicaciones DOF, pero <b>solo se visualizarán
            hasta los últimos 10 registradas</b> en la página de inicio. No es necesario
            borrar o editar los registros agregados previamente.
          </p>
          @if (count($publicaciones_dof) > 0)
            <b>URLS registradas:</b> {{ $publicaciones_dof->total() }}
            <a class="btn btn-danger btn-mini" href="{{ route('inicio.manage') }}" title="Ir al panel">
              <i class="icon-arrow-left"></i> Ir al panel
            </a>
            <a class="btn btn-success btn-mini" href="{{ route('inicio.administrar.crear_publicacion_dof') }}" title="Agregar registro">
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
                  @foreach ($publicaciones_dof as $publicacion_dof)
                    <tr>
                      <td>{{ $publicacion_dof->publicacion_dof_id }}</td>
                      <td>{{ $publicacion_dof->descripcion }}</td>
                      <td class="dividir-palabras">{{ $publicacion_dof->url }}</td>
                      <td>
                      <center>
                        <a href="{{ route('inicio.administrar.editar_publicacion_dof', $publicacion_dof->publicacion_dof_id) }}" title="Editar detalles del registro {{ $publicacion_dof->publicacion_dof_id }}" class="btn btn-mini btn-warning">
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
                {{ $publicaciones_dof->render() }}
              </div>
            </center>
          @else
            <div class="aligncenter">
              <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
            </div>
            <div class="blankline30"></div>
            <h3 class="aligncenter">No hay publicaciones DOF</h3>
            <p class="aligncenter">
              <a href="{{ route('inicio.administrar.crear_publicacion_dof') }}">Agregue al menos uno</a>.
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
