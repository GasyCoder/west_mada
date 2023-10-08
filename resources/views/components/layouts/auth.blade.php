<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- All Generated styles form dashlite -->
    <link rel="stylesheet" href="{{asset('assets/css/dashlite.css')}}">
    <!-- This file is for you to include your own styles -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
</head>
<body class="nk-body bg-white npc-general pg-auth">
<div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <x-logo_auth/>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                
                                @yield('content')

                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">{{__('Terms &Condition')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">{{__('Privacy Policy')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">{{__('Help')}}</a>
                                        </li>
                                        {{-- Languages --}}
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link text-base"
                                                data-bs-toggle="dropdown" data-offset="0,10">
                                                <small>{{__('English')}}</small>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{asset('assets/images/flags/english.png')}}" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">{{__('English')}}</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{asset('assets/images/flags/french.png')}}" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">{{__('Français')}}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy;{{__('2023 WestMada. All Rights Reserved.')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
</body>
</html>