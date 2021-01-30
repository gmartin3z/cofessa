@extends('main')

@section('title')
  Crear enlace (enlaces de interés)
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span12 aligncenter">
          <h3 class="title">Crear <strong>enlace</strong></h3>
          <form action="{{ route('inicio.administrar.guardar_enlace', $submenu_enlaces_id) }}" method="post" id="frm_submenu">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span6 control-group"</button>
              <br><br>
              <a class="btn btn-default" href="{{ route('inicio.administrar.enlaces', $submenu_enlaces_id) }}" title="Ir al listado">
                <i class="icon-arrow-left"></i> Ir al listado
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('extra_js_functions')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#frm_submenu').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_submenu .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_submenu .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_submenu :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
