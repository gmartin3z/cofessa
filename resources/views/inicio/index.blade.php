@extends('main')

@section('title')
  Inicio
@stop

@section('header')
  @include('partials.header')
@endsection

@section('extra_css_styles')
  <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
  <link href="{{ asset('css/camera.css') }}" rel="stylesheet">
@endsection

@section('extra_css_styles')
  <style type="text/css">
    @media screen and (max-width: 600px) {
      .ocultar-elemento {
        visibility: hidden;
        clear: both;
        float: left;
        margin: 10px auto 5px 20px;
        width: 28%;
        display: none;
      }
    }
  </style>
@endsection

@section('content')
  @if (count($noticias) >= 3)
    <div class="camera_wrap" id="camera-slide">
      @foreach ($noticias as $noticia)
        <div data-src="{{ url('uploads/imgs_noticias/greyscale/'.$noticia->imagen ) }}">
          <div class="camera_caption fadeFromLeft">
            <div class="container">
              <div class="row">
                <div class="span6 ocultar-elemento">
                  <img src="{{ url('uploads/imgs_noticias/'.$noticia->imagen ) }}"
                  title="{{ $noticia->titulo }}">
                </div>
                <div class="span6">
                  <h2 class="animated fadeInDown">
                    <strong>
                      <a href="{{ $noticia->url }}" style="text-decoration: none;" target="_blank">
                        <span class="colored">
                          {{ $noticia->titulo }}
                        </span>
                      </a>
                    </strong>
                  </h2>
                  <p class="animated fadeInUp" style="font-size: 18px; color: #000000;">
                    <strong>{{ $noticia->resumen }}</strong>
                  </p>
                  <a href="{{ $noticia->url }}" class="btn btn-success animated fadeInUp ocultar_elemento" target="_blank">
                    <i class="icon-link"></i> Leer más
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article class="single">
              <div class="row">
                <div class="span12">
                  <div class="aligncenter">
                    <i class="icon-circled icon-bgwarning icon-warning-sign icon-5x"></i>
                  </div>
                  <div class="blankline30"></div>
                  <h3 class="aligncenter">
                    <b>No hay noticias</b>
                  </h3>
                  <p class="aligncenter">
                    Agregue al menos tres
                  </p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>
  @endif

  <section id="content">
    <div class="container">
      <div class="row">
        @include('partials.alerts')
        <div class="span8">
          <article>
            <div class="row">
              <div class="span8">
                <div class="post-slider">
                  <div class="post-heading">
                    <h3><a href="#">Servicios principales</a></h3>
                  </div>
                  <div class="clear"></div>
                  <div class="flexslider">
                    @if (count($servicios) >= 1)
                      <ul class="slides">
                        @foreach ($servicios as $servicio)
                          <li>
                            <a href="{{ $servicio->url }}" target="_blank">
                              <img border="0"
                                src="{{ url('uploads/imgs_servicios/'.$servicio->imagen) }}"
                                title="{{ $servicio->resumen }}"
                                width="100"
                                height="100">
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    @else
                      <div class="aligncenter">
                        <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                      </div>
                      <div class="blankline30"></div>
                      <h3 class="aligncenter">
                        <b>No hay servicios</b>
                      </h3>
                      <p class="aligncenter">
                        Agregue al menos tres
                      </p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </article>
          <div class="span8">
            <h4>Documentos y formatos</h4>
            @if (count($menu_documentos) >= 1)
              <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                  @foreach ($menu_documentos as $menu_documento)
                    @if ($menu_documento->menu_id == 1)
                      <li class="active">
                        <a href="#menu_docs_{{ $menu_documento->menu_id }}" data-toggle="tab">
                          {{ $menu_documento->descripcion }}
                        </a>
                      </li>
                    @else
                      <li>
                        <a href="#menu_docs_{{ $menu_documento->menu_id }}" data-toggle="tab">
                          {{ $menu_documento->descripcion }}
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
                <div class="tab-content">
                  @foreach ($menu_documentos as $menu_documento)
                    @if ($menu_documento->menu_id == 1)
                      <div class="tab-pane active" id="menu_docs_{{ $menu_documento->menu_id }}">
                        <ul>
                          @if (!$menu_documento->submenu_documento->isEmpty())
                            @foreach ($menu_documento->submenu_documento as $submenu_documento)
                              <li>
                                <a href="{{ $submenu_documento->url }}" target="_blank">
                                  {{ $submenu_documento->descripcion }}
                                </a>
                              </li>
                            @endforeach
                          @else
                            <li>No hay enlaces agregados</li>
                          @endif
                        </ul>
                      </div>
                    @else
                      <div class="tab-pane" id="menu_docs_{{ $menu_documento->menu_id }}">
                        <ul>
                          @if (!$menu_documento->submenu_documento->isEmpty())
                            @foreach ($menu_documento->submenu_documento as $submenu_documento)
                              <li>
                                <a href="{{ $submenu_documento->url }}" target="_blank">
                                  {{ $submenu_documento->descripcion }}
                                </a>
                              </li>
                            @endforeach
                          @else
                            <li>No hay enlaces agregados</li>
                          @endif
                        </ul>
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>
            @else
              <div class="aligncenter">
                <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
              </div>
              <div class="blankline30"></div>
              <h3 class="aligncenter"><b>No hay enlaces</b></h3>
              <p class="aligncenter">
                Agregue al menos uno
              </p>
            @endif
          </div>
          <div class="span8">
            <h4>Enlaces de interés</h4>
            @if (count($menu_enlaces) >= 1)
              <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                  @foreach ($menu_enlaces as $menu_enlace)
                    @if ($menu_enlace->menu_id == 1)
                      <li class="active">
                        <a href="#menu_enlaces_{{ $menu_enlace->menu_id }}" data-toggle="tab">
                          {{ $menu_enlace->descripcion }}
                        </a>
                      </li>
                    @else
                      <li>
                        <a href="#menu_enlaces_{{ $menu_enlace->menu_id }}" data-toggle="tab">
                          {{ $menu_enlace->descripcion }}
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
                <div class="tab-content">
                  @foreach ($menu_enlaces as $menu_enlace)
                    @if ($menu_enlace->menu_id == 1)
                      <div class="tab-pane active" id="menu_enlaces_{{ $menu_enlace->menu_id }}">
                        <ul>
                          @if (!$menu_enlace->submenu_enlace->isEmpty())
                            @foreach ($menu_enlace->submenu_enlace as $submenu_enlace)
                              <li>
                                <a href="{{ $submenu_enlace->url }}" target="_blank">
                                  {{ $submenu_enlace->descripcion }}
                                </a>
                              </li>
                            @endforeach
                          @else
                            <li>No hay enlaces agregados</li>
                          @endif
                        </ul>
                      </div>
                    @else
                      <div class="tab-pane" id="menu_enlaces_{{ $menu_enlace->menu_id }}">
                        <ul>
                          @if (!$menu_enlace->submenu_enlace->isEmpty())
                            @foreach ($menu_enlace->submenu_enlace as $submenu_enlace)
                              <li>
                                <a href="{{ $submenu_enlace->url }}" target="_blank">
                                  {{ $submenu_enlace->descripcion }}
                                </a>
                              </li>
                            @endforeach
                          @else
                            <li>No hay enlaces agregados</li>
                          @endif
                        </ul>
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>
            @else
              <div class="aligncenter">
                <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
              </div>
              <div class="blankline30"></div>
              <h3 class="aligncenter"><b>No hay enlaces</b></h3>
              <p class="aligncenter">
                Agregue al menos uno
              </p>
            @endif
          </div>
        </div>
        <div class="span4">
          <aside class="right-sidebar">
            <div class="widget">
              <h5 class="widgetheading">Correos electrónicos</h5>
              <ul class="cat">
                <li>
                  <i class="icon-angle-right"></i>
                  <a href="https://outlook.live.com/owa/" target="_blank">Outlook</a>
                </li>
                <li>
                  <i class="icon-angle-right"></i>
                  <a href="https://login.yahoo.com/?.intl=mx&.src=ym" target="_blank">Yahoo!</a>
                </li>
                <li>
                  <i class="icon-angle-right"></i>
                  <a href="https://www.google.com/gmail/about/#" target="_blank">Gmail</a>
                </li>
              </ul>
            </div>
            <div class="widget">
              <div class="tabs">
                <ul class="nav nav-tabs">
                  <li class="active" style="font-size: 11px;">
                    <a href="#tbl_indicadores" data-toggle="tab">Indicadores</a>
                  </li>
                  <li style="font-size: 11px;">
                    <a href="#tbl_datos" data-toggle="tab">Datos</a>
                  </li>
                  <li style="font-size: 11px;">
                    <a href="#tbl_salarios" data-toggle="tab">Salarios</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tbl_indicadores">
                    @if (count($indicadores) >= 1)
                      <div style="overflow-x:auto; font-size: 11px;">
                        <table class="table table-condensed table-striped table-hover">
                          <tbody>
                            @foreach ($indicadores as $indicador)
                            <tr>
                              <td style="font-size: 11px;">{{ $indicador->descripcion }}</td>
                              <td style="font-size: 11px;">{{ $indicador->valor }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    @else
                      <div class="aligncenter">
                        <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                      </div>
                      <div class="blankline30"></div>
                      <h3 class="aligncenter"><b>No hay indicadores</b></h3>
                      <p class="aligncenter">
                        Agregue al menos uno
                      </p>
                    @endif
                  </div>
                  <div class="tab-pane" id="tbl_datos">
                    @if (count($datos) >= 1)
                      <div style="overflow-x:auto; font-size: 11px;">
                        <table class="table table-condensed table-striped table-hover">
                          <thead>
                            <tr>
                              <th style="font-size: 11px;">Datos</th>
                              <th style="font-size: 11px;">Valor</th>
                              <th style="font-size: 11px;">Publicado</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($datos as $dato)
                            <tr>
                              <td style="font-size: 11px;">{{ $dato->descripcion }}</td>
                              <td style="font-size: 11px; white-space: nowrap;">{{ $dato->valor }}</td>
                              <td style="font-size: 11px; white-space: nowrap;">{{ $dato->publicacion }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    @else
                      <div class="aligncenter">
                        <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                      </div>
                      <div class="blankline30"></div>
                      <h3 class="aligncenter"><b>No hay datos</b></h3>
                      <p class="aligncenter">
                        Agregue al menos uno
                      </p>
                    @endif
                  </div>
                  <div class="tab-pane" id="tbl_salarios">
                    @if (count($salarios) >= 1)
                      <div style="overflow-x:auto; font-size: 11px;">
                        <table class="table table-condensed table-striped table-hover">
                          <thead>
                            <tr>
                              <th style="font-size: 11px;">Vigencia</th>
                              <th style="font-size: 11px;">Mínimo a</th>
                              <th style="font-size: 11px;">Mínimo b</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($salarios as $salario)
                            <tr>
                              <td style="font-size: 11px; white-space: nowrap;">{{ $salario->vigencia }}</td>
                              <td style="font-size: 11px; white-space: nowrap;">{{ $salario->valor_a }}</td>
                              <td style="font-size: 11px; white-space: nowrap;">{{ $salario->valor_b }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    @else
                      <div class="aligncenter">
                        <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                      </div>
                      <div class="blankline30"></div>
                      <h3 class="aligncenter"><b>No hay salarios</b></h3>
                      <p class="aligncenter">
                        Agregue al menos uno
                      </p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="widget">
              <h5 class="widgetheading">Actualidades</h5>
              <ul class="cat">
                @if (count($actualidades) >= 1)
                  @foreach ($actualidades as $actualidad)
                    <li>
                      <i class="icon-angle-right"></i>
                      <a href="{{ $actualidad->url }}" target="_blank">
                        {{ $actualidad->descripcion }}
                      </a>
                    </li>
                  @endforeach
                @else
                  <div class="aligncenter">
                    <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                  </div>
                  <div class="blankline30"></div>
                  <h3 class="aligncenter"><b>No hay actualidades</b></h3>
                  <p class="aligncenter">
                    Agregue al menos uno
                  </p>
                @endif
              </ul>
            </div>
            <div class="widget">
              <h5 class="widgetheading">Publicaciones</h5>
              <ul class="cat">
                @if (count($publicaciones) >= 1)
                  @foreach ($publicaciones as $publicacion)
                    <li>
                      <i class="icon-angle-right"></i>
                      <a href="{{ $publicacion->url }}" target="_blank">
                        {{ $publicacion->descripcion }}
                      </a>
                    </li>
                  @endforeach 
                @else
                  <div class="aligncenter">
                    <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                  </div>
                  <div class="blankline30"></div>
                  <h3 class="aligncenter"><b>No hay publicaciones</b></h3>
                  <p class="aligncenter">
                    Agregue al menos una
                  </p>
                @endif
              </ul>
            </div>
            <div class="widget">
              <h5 class="widgetheading">Publicaciones DOF</h5>
              <ul class="cat">
                @if (count($publicaciones_dof) >= 1)
                  @foreach ($publicaciones_dof as $publicacion_dof)
                    <li>
                      <i class="icon-angle-right"></i>
                      <a href="{{ $publicacion_dof->url }}" target="_blank">
                        {{ $publicacion_dof->descripcion }}
                      </a>
                    </li>
                  @endforeach
                @else
                  <div class="aligncenter">
                    <i class="icon-circled icon-bgwarning icon-warning-sign icon-4x"></i>
                  </div>
                  <div class="blankline30"></div>
                  <h3 class="aligncenter"><b>No hay publicaciones DOF</b></h3>
                  <p class="aligncenter">
                    Agregue al menos una
                  </p>
                @endif
              </ul>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="span12">
          <h4>Bancos</h4>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="https://www.afirme.com.mx/Portal/Portal.do" target="_blank">AFIRME</a></li>
              <li><a href="https://www.banamex.com.mx/" target="_blank">Citibanamex</a></li>
              <li><a href="https://www.banregio.com/" target="_blank">BANREGIO</a></li>
            </ul>
          </div>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="https://www.hsbc.com.mx/" target="_blank">HSBC</a></li>
              <li><a href="https://www.santander.com.mx/index.html" target="_blank">Santander</a></li>
              <li><a href="https://www.banorte.com/wps/portal/banorte" target="_blank">Banorte</a></li>
            </ul>
          </div>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="https://www.scotiabank.com.mx/" target="_blank">Scotiabank</a></li>
              <li><a href="https://www.bbva.mx/" target="_blank">BBVA Bancomer</a></li>
              <li><a href="https://www.bancoinbursa.com/login/useraccess.asp" target="_blank">INBURSA</a></li>
            </ul>
          </div>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="https://www.bb.com.mx/" target="_blank">Banco del Bajío</a></li>
              <li><a href="https://www.gob.mx/banjercito" target="_blank">Banjercito</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="span12">
          <h4>Otros enlaces</h4>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="https://www.sat.gob.mx/home" target="_blank">SAT</a></li>
              <li><a href="http://www.imss.gob.mx/" target="_blank">IMSS</a></li>
              <li><a href="https://portalmx.infonavit.org.mx/" target="_blank">INFONAVIT</a></li>
              <li><a href="https://www.gob.mx/sre" target="_blank">SRE</a></li>
              <li><a href="https://www.bmv.com.mx/" target="_blank">Bolsa Mexicana de Valores</a></li>
              <li><a href="https://www.gob.mx/stps" target="_blank">STPS</a></li>
            </ul>
          </div>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="https://www.banxico.org.mx/" target="_blank">BANXICO</a></li>
              <li><a href="https://www.inegi.org.mx/" target="_blank">INEGI</a></li>
              <li><a href="https://www.gob.mx/cnbv" target="_blank">CNBV</a></li>
              <li><a href="https://www.nafin.com/" target="_blank">Nacional Financiera</a></li>
              <li><a href="http://www.shcp.gob.mx/" target="_blank">SHCP</a></li>
              <li><a href="http://www.segob.gob.mx/" target="_blank">SEGOB</a></li>
            </ul>
          </div>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="http://imcp.org.mx/" target="_blank">IMCP</a></li>
              <li><a href="https://coahuila.gob.mx/" target="_blank">Gobierno de Coahuila</a></li>
              <li><a href="https://www.gob.mx/se" target="_blank">Secretaría de Economía</a></li>
              <li><a href="http://omawww.sat.gob.mx/aduanasPortal/Paginas/index.html#!/" target="_blank">Aduanas.gob.mx</a></li>
              <li><a href="https://www.gob.mx/profeco" target="_blank">PROFECO</a></li>
              <li><a href="http://prodecon.gob.mx/" target="_blank">PRODECON</a></li>
            </ul>
          </div>
        </div>
        <div class="span3">
          <div class="widget">
            <ul class="link-list">
              <li><a href="http://www.congreso.gob.mx/" target="_blank">Congreso.gob.mx</a></li>
              <li><a href="https://www.scjn.gob.mx/" target="_blank">SCJN</a></li>
              <li><a href="https://www.gob.mx/impi/" target="_blank">IMPI</a></li>
              <li><a href="http://www.tfjfa.gob.mx/" target="_blank">TFJA</a></li>
              <li><a href="http://imcpsaltillo.com/" target="_blank">Colegio de Contadores Públicos de Saltillo</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  @include('partials.footer')
@endsection

@section('extra_js_libraries')
  <script src="{{ asset('js/camera/camera.js') }}"></script>
  <script src="{{ asset('js/camera/setting.js') }}"></script>
@endsection
