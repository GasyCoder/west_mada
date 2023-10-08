<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('assets/css2?family=Inter:wght@400;500;700&amp;display=swap')}}">
    <!-- build:css -->
    <link rel="stylesheet" href="{{asset('assets/frontend/vendors/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/vendors/css/swiper-bundle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/main.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- endbuild -->
    @stack('styles')
</head>

<body class=" has-topbar">
    @include('components.westmada.frontend.topbar')

    <!-- Main-->
        <div class="content-wrap ">
            @include('components.westmada.frontend.navbar')
            {{ $slot }}
            
        </div>    
    
    @include('components.westmada.frontend.footer')
    @include('sweetalert::alert')

    <!-- jQuery-->
    <script src="{{asset('assets/frontend/vendors/js/jquery.min.js')}}"></script>
    <!-- build:js -->

    <!-- Inclure les scripts JavaScript depuis le répertoire "assets/frontend/" -->
    <script src="{{ asset('assets/frontend/vendors/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/isotope.pkgd.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/jarallax.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/jarallax-element.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/ofi.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/jquery.inview.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/js/gist-embed.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/show-on-scroll.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/countdown.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/isotope.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/navbar.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/stretch-column.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/swiper.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/controllers/others.js') }}"></script>
    <!-- endbuild -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-toast /> 
    @stack('scripts')
</body>
</html>