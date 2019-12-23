<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AdminLTE 3 | Starter</title>

    <!-- Styles -->
    @include('backend.partials.styles')
    <!-- /Styles -->

  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

      <!-- Navbar -->
      @include('backend.partials.nav')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('backend.partials.left_sidebar')
      <!-- /Main Sidebar Container -->
      
      {{-- Main Content --}}
      @yield('content')
      {{-- /.main Content --}}
      
      
      
      <!-- Main Footer -->
      @include('backend.partials.footer')
      <!-- /Main Footer -->

    </div>
    {{-- Scripts --}}
    @include('backend.partials.scripts')
    {{-- /scripts --}}
  </body>
</html>