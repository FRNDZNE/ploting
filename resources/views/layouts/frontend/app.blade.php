<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/') }}/frontend/style/main.css" />
    @yield('css')
    {{-- @vite('resources/css/app.css') --}}
  </head>
  <body>
    <nav
      class="navbar-navbar-light d-flex mt-4"
      data-aos="fade-down"
      data-aos-delay="100">
      {{-- <div class="container">
        @guest  
          <a href="{{ route('login') }}" class="btn btn-login float-right">Login</a>
        @endguest
        @auth  
          <a href="{{ route('admin.dashboard') }}" class="btn btn-login float-right">Dashboard</a>
        @endauth

      </div> --}}
    </nav>
    <section class="heading-logo" data-aos="fade-down" data-aos-delay="300">
      <img src="{{ asset('/') }}/frontend/images/logobumn.png" alt="" class="logo-bumn" />
      @auth
      <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('/') }}/frontend/images/port.png" alt="" class="logo-port" />
      </a>
      @endauth
      @guest
      <a href="{{ route('login') }}">
        <img src="{{ asset('/') }}/frontend/images/port.png" alt="" class="logo-port" />
      </a>
      @endguest
      <img src="{{ asset('/') }}/frontend/images/logopelindo.png" alt="" class="logo-pelindo" />
    </section>
    @yield('content')
    
    <script src="{{ asset('/') }}/frontend/vendor/jquery/jquery.slim.min.js"></script>
    <script src="{{ asset('/') }}/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    @yield('script')
    {{-- @vite('resources/js/app.js') --}}

  </body>
</html>
