@extends('main')

@section('title')
  401 - No autorizado
@stop

@section('header')
  @include('partials.header')
@endsection

@section('content')
  <section id="inner-headline">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="inner-heading">
            <h2>No autorizado</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="content">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="aligncenter">
            <i class="icon-circled icon-bgdanger icon-remove icon-5x"></i>
          </div>
          <div class="blankline30"></div>
          <h3 class="aligncenter"><b>Error</b></h3>
          <p class="aligncenter">
            Vaya al inicio y reintente nuevamente.
          </p>
          <p class="aligncenter">
            <a href="{{ route('inicio') }}">Ir al inicio &raquo;</a>
          </p>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
