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
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
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
                                    @can('super-admin')
                                    <li>
                                        <a href="/parametre" wire:navigate>
                                            <em class="icon ni ni-setting"></em>
                                            <span>Paramètres</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <em class="icon ni ni-activity-alt"></em>
                                            <span>Activité de connexion</span>
                                        </a>
                                    </li>
                                    @endcan
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