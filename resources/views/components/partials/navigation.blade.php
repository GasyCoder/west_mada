<div class="nk-header nk-header-fixed">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu" href="#"><em
                        class="icon ni ni-menu"></em></a>
            </div>  
            <div class="nk-header-brand d-xl-none">
                <a class="logo-link" href="#">
                <img alt="logo" class="logo-light logo-img"
                        src="{{asset('assets/images/logo.png')}}" srcset="{{asset('assets/images/logo2x.png')}} 2x">
                <img alt="logo-dark" class="logo-dark logo-img" src="{{asset('assets/images/logo-dark.png')}}" 
                      srcset="{{asset('assets/images/logo-dark2x.png')}} 2x"></a>
            </div>
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list">
                    <a class="nk-news-item" href="#">
                        <div class="nk-news-icon">
                            {{-- <em class="icon ni ni-card-view"></em> --}}
                        </div>
                        <div class="nk-news-text">
                            {{-- <p>Do you know the latest update of 2022? <span>A overview of our is now
                                    available on YouTube</span></p><em class="icon ni ni-external"></em> --}}
                        </div>
                    </a>
                </div>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    {{-- <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                        <a class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown" href="#">
                            <div class="quick-icon border border-light"><img alt="" class="icon"
                                src="{{asset('assets/images/flags/english-sq.png')}}"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                            <ul class="language-list">
                                <li>
                                    <a class="language-item" href="#"><img alt="" class="language-flag"
                                    src="{{asset('assets/images/flags/english.png')}}"><span
                                            class="language-name">{{__('English')}}</span></a>
                                </li>
                                <li>
                                    <a class="language-item" href="#"><img alt="" class="language-flag"
                                    src="{{asset('assets/images/flags/french.png')}}"><span
                                            class="language-name">{{__('Français')}}</span></a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="dropdown user-dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-account-setting-fill"></em>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">
                                      @if(Auth::user()->hasRole('admin')) 
                                        {{__('Administrateur')}}
                                        @elseif(Auth::user()->hasRole('employe'))
                                        {{__('Employer')}}
                                        @else
                                        {{__('Client')}}
                                      @endif
                                    </div>
                                    <div class="user-name dropdown-indicator">
                                       {{ Auth::user()->name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>VB</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->name }}</span><span
                                            class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="#">
                                            <em class="icon ni ni-user-alt"></em>
                                            <span>Mon profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="settings.html">
                                            <em class="icon ni ni-security"></em>
                                            <span>Sécurité</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="settings-activity-log.html">
                                            <em class="icon ni ni-activity-alt"></em>
                                            <span>Activité de connexion</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="text-danger">
                                        <em class="icon ni ni-power"></em>
                                        <span>{{ __('Déconnexion') }}</span>
                                     </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="dropdown notification-dropdown me-n1">
                        <a class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown" href="#">
                            <div class="icon-status icon-status-info">
                                <em class="icon ni ni-bell"></em>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Notifications</span><a href="#">Mark All as
                                    Read</a>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                You have requested to <span>Widthdrawl</span>
                                            </div>
                                            <div class="nk-notification-time">
                                                2 hrs ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                Your <span>Deposit Order</span> is placed
                                            </div>
                                            <div class="nk-notification-time">
                                                2 hrs ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                You have requested to <span>Widthdrawl</span>
                                            </div>
                                            <div class="nk-notification-time">
                                                2 hrs ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                Your <span>Deposit Order</span> is placed
                                            </div>
                                            <div class="nk-notification-time">
                                                2 hrs ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                You have requested to <span>Widthdrawl</span>
                                            </div>
                                            <div class="nk-notification-time">
                                                2 hrs ago
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                Your <span>Deposit Order</span> is placed
                                            </div>
                                            <div class="nk-notification-time">
                                                2 hrs ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-foot center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>