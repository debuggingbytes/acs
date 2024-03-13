<!DOCTYPE html>
<html lang="en" class="scroll-auto md:scroll-smooth">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
      Account | Alberta Crane Service
    </title>
    @yield('meta')
    
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-XJCT94S2Z1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
          dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-XJCT94S2Z1');
      </script>

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Google Icons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-1616.png') }}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/c5608c8cee.js" crossorigin="anonymous"></script>
  </head>
  <body class="bg-stone-300">    
    <!-- Main content area -->
    <main class="bg-slate-200 h-screen">
     @yield('content')
    </main>
    <!-- end main content -->
    <script src="{{ asset('/js/scripts.js') }}"></script>
    @yield('scripts')
  </body>
</html>