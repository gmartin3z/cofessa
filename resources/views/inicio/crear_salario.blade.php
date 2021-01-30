@extends('main')

@section('title')
  Crear salario
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
          <h3 class="title">Crear <strong>salario</strong></h3>
          <form action="{{ route('inicio.administrar.guardar_salario') }}" method="post" id="frm_salario">
            {{ csrf_field() }}
            <div class="row controls">
              <div class="span4 control-group">
                <label>Vigencia (requerido, formato año-mes-día)</label>
                <input type="text" name="detalle_vigencia" value="{{ old('detalle_vigencia') }}" maxlength="20" class="span4">
              </div>
              <div class="span4 control-group">
                <label>Valor a (requerido)</label>
                <input type="text" name="detalle_valor_a" value="{{ old('detalle_valor_a') }}" maxlength="20" class="span4">
              </div>
              <div class="span4 control-group">
                <label>Valor b (requerido)</label>
                <input type="text" name="detalle_valor_b" value="{{ old('detalle_valor_b') }}" maxlength="20" class="span4">
              </div>
            </div>
            <div class="btn-toolbar">
              <button type="submit" class="btn btn-success btn-submit" id="guardar_datos">
                <span class="btn-txt">Guardar registro</span>
              </button>
              <button type="reset" class="btn btn-danger">
                Limpiar registro
              </button>
              <br><br>
              <a class="btn btn-default" href="{{ route('inicio.administrar.salarios') }}" title="Ir al listado">
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
      $('#frm_salario').on('click', '#guardar_datos', function (event) {
        setTimeout(function () {
          disableButton();
        }, 0);
      });

      function disableButton() {
        $('#frm_salario .btn-submit')
          .find('span.btn-txt').text('Espere...');
        $('#frm_salario .btn-submit')
          .append('<i class="icon-rotate-right icon-spin icon-white"></i>');
        $('#frm_salario :input')
          .prop('disabled', true);
      }
    });
  </script>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
