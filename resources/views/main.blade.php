<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Servicios de contaduría">
    <meta name="author" content="Cofessa">

    <title>@yield('title') :: Cofessa </title>

    @yield('token')

    <!-- fuente principal -->
    <link href="{{ asset('css/open-sans.css') }}" rel="stylesheet">

    <!-- gracias a bootstrapmade.com por la plantilla -->
    <!-- bibliotecas css -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.bxslider.css') }}" rel="stylesheet">

    <!-- estilos color plantilla -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('color/red.css') }}" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- bibliotecas css extras -->
    @yield('extra_css_libraries')

    <!-- estilos css extras -->
    @yield('extra_css_styles')
  </head>
  <body>
    <div id="wrapper">
      <!-- menu página -->
      @yield('header')
      
      <!-- contenido página -->
      @yield('content')

      <!-- pie página -->
      @yield('footer')
    </div>

    <a href="#" class="scrollup">
      <i class="icon-angle-up icon-circled icon-bglight icon-2x active"></i>
    </a>

    <!-- bibliotecas javascript -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('js/toucheffects.js') }}"></script>
    <script src="{{ asset('js/google-code-prettify/prettify.js') }}"></script>
    <script src="{{ asset('js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/inview.js') }}"></script>

    <!-- funciones plantilla -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- bibliotecas javascript extras -->
    @yield('extra_js_libraries')

    <!-- funciones javascript extras  -->
    @yield('extra_js_functions')
  </body>
</html>
