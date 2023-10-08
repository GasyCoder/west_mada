<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Paramètres</h3>
                    </div>
                </div>
            </div>
            <div class="nk-block nk-block-lg">
                <div class="card card-bordered card-stretch">
                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab"
                                href="#site" aria-selected="true" role="tab">
                                <em class="icon ni ni-laptop"></em>
                                <span>Paramètre général</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="site" role="tabpanel">
                            <div class="card-inner pt-0">
                                <p>Voici les paramètres de base de votre application.</p>
                                
                                <x-alertSession/>

                                <form class="gy-3 form-settings">
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="app_name">Nom</label>
                                                    <span class="form-note">Nom de l'application</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" wire:model="app_name" class="form-control"
                                                        id="app_name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="comp-copyright">
                                                    Logo
                                                </label>
                                                <span class="form-note">Logo de votre application</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="file" wire:model="logo" class="form-control" id="logo">
                                                </div>
                                            </div>
                                            @if ($currentImage)
                                            <div class="current-image">
                                                <p>Current logo:</p>
                                                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Current Image" width="120" />
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-7">
                                            <div class="form-group mt-2">
                                                <button wire:click.prevent="updateSetting()" wire:loading.attr="disabled" class="btn btn-success close-modal"
                                                    wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                                                    Mettre à jour <em class="icon ni ni-reload-alt"></em>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>