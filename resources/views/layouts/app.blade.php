<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sacred Heart Shrine - {{ $title ?? 'Home' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0f3d3e">
  <link rel="icon" type="image/png" href="{{ asset('images/home_page.jpeg') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/home_page.jpeg') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  @production
  <link rel="stylesheet" href="{{ url('/public/css/shrine-theme.css') }}?v=6">
  @else
  <link rel="stylesheet" href="{{ asset('css/shrine-theme.css') }}?v=6">
  @endproduction
  @yield('styles')
</head>
<body>
  @include('layouts.header')
  <main id="main-content">
    @yield('content')
  </main>
  @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('scripts')
</body>
</html>
