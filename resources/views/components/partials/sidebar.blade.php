<div class="nk-sidebar nk-sidebar-fixed is-dark nk-sidebar-mobile" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu" href="#"><em
                    class="icon ni ni-arrow-left"></em></a><a
                class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu" href="#"><em
                    class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <img alt="logo" class="logo-light logo-img" src="{{asset('assets/images/logo.png')}}"
                srcset="{{asset('assets/images/logo2x.png')}} 2x">
            <img alt="logo-dark" class="logo-dark logo-img" src="{{asset('assets/images/logo-dark.png')}}"
                srcset="{{asset('assets/images/logo-dark2x.png')}} 2x"></a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar="">
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a class="nk-menu-link" href="/dashboard" wire:navigate><span class="nk-menu-icon"><em
                            class="icon ni ni-dashboard-fill"></em></span><span
                            class="nk-menu-text">Dashboard</span></a>   
                    </li>
                    @can('booking-list')
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#"><span class="nk-menu-icon"><em
                            class="icon ni ni-calendar-booking-fill"></em></span><span
                            class="nk-menu-text">Reservation</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/toutes-reservations" wire:navigate>
                                    <span class="nk-menu-text">
                                        Toutes les réservations
                                    </span>
                                </a>
                            </li>
                            @can('booking-corbeille')
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/corbeille-reservations" wire:navigate>
                                    <span class="nk-menu-text">Corbeille</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('hotel-list')
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-home-fill"></em>
                            </span>
                            <span class="nk-menu-text">Hôtel</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('hotels')}}" wire:navigate>
                                    <span class="nk-menu-text">Chambres</span></a>
                            </li>
                            @can('hotel-add-photo')
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('photos')}}" wire:navigate>
                                    <span class="nk-menu-text">Photos</span></a>
                            </li>
                            @endcan
                            @can('type-create')
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('typerooms')}}" wire:navigate>
                                    <span class="nk-menu-text">Type de chambre</span></a>
                            </li>
                            @endcan
                            @can('service-create')
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('inclus')}}" wire:navigate>
                                    <span class="nk-menu-text">Services Inclus</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('stock-list')
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-coins"></em>
                            </span>
                            <span class="nk-menu-text">Magasins</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('stock_categories')}}" wire:navigate>
                                    <span class="nk-menu-text">Catégories</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('stocks')}}" wire:navigate><span
                                        class="nk-menu-text">Stocks</span></a>
                            </li>
                        </ul>
                    </li>   
                    @endcan
                    @can('period-list')
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-list-round"></em>
                            </span>
                            <span class="nk-menu-text">Tâches</span>
                        </a>
                        <ul class="nk-menu-sub">
                            @can('task-create')
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/tasks" wire:navigate>
                                    <span class="nk-menu-text">Sortie/Entrée</span></a>
                            </li>
                            @endcan
                            @can('super-admin')
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="#" wire:navigate>
                                    <span class="nk-menu-text">Bloc note</span></a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('role-list')
                    @can('permission-list')
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Gestions Panel</h6>
                        </li>
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                            <em class="icon ni ni-user-list-fill"></em>
                            </span>
                            <span class="nk-menu-text">Roles/Permissions</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                               <a class="nk-menu-link" href="{{route('roles')}}" wire:navigate>
                                    <span class="nk-menu-text">Roles</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('permissions')}}" wire:navigate>
                                    <span class="nk-menu-text">Permissions
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @endcan
                    @can('user-list')
                    <li class="nk-menu-item">
                        <a class="nk-menu-link" href="{{route('users')}}" wire:navigate>
                            <span class="nk-menu-icon">
                               <em class="icon ni ni-user-add-fill"></em>
                            </span>
                            <span class="nk-menu-text">Utilisateurs</span>
                        </a>
                    </li>
                    @endcan
                    @can('super-admin')
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-setting-alt-fill"></em>
                            </span>
                            <span class="nk-menu-text">Paramètres</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="#" wire:navigate>
                                    <span class="nk-menu-text">Site Panel</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="invoice-list.html">
                                    <span class="nk-menu-text">Gestion des pages
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Interface Web Site</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-layers-fill"></em>
                            </span>
                            <span class="nk-menu-text">Gestion des sites</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('westmada-panel')}}" wire:navigate>
                                    <span class="nk-menu-text">WestMada</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="invoice-list.html">
                                    <span class="nk-menu-text">Vato Be
                                    </span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="invoice-list.html">
                                    <span class="nk-menu-text">Ampasindava
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    {{-- <li class="nk-menu-item">
                        <a class="nk-menu-link" href="#">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em>
                            </span>
                            <span class="nk-menu-text">Page d'accueil
                            </span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>