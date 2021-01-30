@extends('main')

@section('title')
  418 - Soy una tetera
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
            <h2>Soy una tetera</h2>
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
            <span class="icon-stack icon-5x">
              <i class="icon-coffee icon-flip-horizontal"></i>
              <i class="icon-ban-circle icon-stack-base icon-danger"></i>
            </span>
          </div>
          <div class="blankline30"></div>
          <h3 class="aligncenter"><b>Error</b></h3>
          <p class="aligncenter">
            No sirvo café.
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
