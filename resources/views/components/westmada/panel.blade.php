<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- All Generated styles form dashlite -->
    <link rel="stylesheet" href="{{asset('assets/css/dashlite.css')}}">
    <!-- This file is for you to include your own styles -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
    <style>
        .text-ellipsis {
            width: 100px;
            overflow: hidden;
            display: inline-block;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
    @stack('styles')
</head> 

<body class="nk-body bg-lighter npc-general has-sidebar">
    <div class="nk-app-root">
        <div class="nk-main">
            @include("components.westmada.partials.sidebar")    
            <div class="nk-wrap">
                @include("components.partials.navigation")
                <div class="nk-content">
                    {{ $slot }}
                </div>
                @include("components.partials.footer")
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('assets/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/demo-settings.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-toast />

    @stack('scripts')
</body>
</html>