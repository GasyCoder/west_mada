<div class="nk-sidebar nk-sidebar-fixed nk-sidebar-mobile" data-content="sidebarMenu">
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
                                <a class="nk-menu-link" href="/westmada-panel" wire:navigate>
                                    <span class="nk-menu-text">WestMada</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="#!">
                                    <span class="nk-menu-text">Vato Be
                                    </span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="#!">
                                    <span class="nk-menu-text">Ampasindava
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-reports"></em>
                            </span>
                            <span class="nk-menu-text">Menus</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('navbars')}}" wire:navigate>
                                    <span class="nk-menu-text">Navbar</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('onglets')}}" wire:navigate><span
                                        class="nk-menu-text">Onglets</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="{{route('pages-content')}}" wire:navigate>
                                    <span class="nk-menu-text">Contenus</span></a>
                            </li>
                        </ul>
                    </li>   
                    <li class="nk-menu-item has-sub">
                        <a class="nk-menu-link nk-menu-toggle" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-reports"></em>
                            </span>
                            <span class="nk-menu-text">Fronts</span>
                        </a>
                        <ul class="nk-menu-sub">
                            {{-- <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/sliders" wire:navigate>
                                    <span class="nk-menu-text">Sliders</span></a>
                            </li> --}}
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/pages-type" wire:navigate>
                                    <span class="nk-menu-text">Pages</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/services-page" wire:navigate>
                                    <span class="nk-menu-text">Services</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a class="nk-menu-link" href="/photo-story" wire:navigate>
                                    <span class="nk-menu-text">Story</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a class="nk-menu-link" href="#">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-setting-alt-fill"></em>
                            </span>
                            <span class="nk-menu-text">Paramètres</span>
                        </a>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Interface Logiciel</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a class="nk-menu-link" href="/dashboard" wire:navigate>
                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em>
                            </span>
                            <span class="nk-menu-text">Logociel
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>