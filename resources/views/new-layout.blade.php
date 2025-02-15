<!DOCTYPE html>
<html lang="en" class="scroll-auto md:scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Used Cranes and Equipment for Sale | Canada, USA | Alberta Crane Service">
  <meta name="google-site-verification" content="zAV9dkbH17UMAnk68CJSTUezIECZu4tCUDu2e9ZVtJE" />
  <title>Used Cranes for Sale | Financing | Alberta
  </title>
  {{-- Custom CSS --}}

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <!-- Google tag (gtag.js) -->
  {{-- Only load analytics if in productions --}}
  @production
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-61207822-1"></script>
    @if (! Auth::user())
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-61207822-1');
    </script>
  @endif

  @endproduction
  {{-- Google Icons --}}
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{asset('site.webmanifest')}}">
  <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  {{-- Font Awesome --}}
  <script src="https://kit.fontawesome.com/c5608c8cee.js" crossorigin="anonymous"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cyan-700">
  <p class="text-2xl">Hello World</p>
  @livewireScripts
</body>

</html>