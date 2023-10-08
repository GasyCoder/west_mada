<div class="container-xl wide-xl">
    <div class="nk-content-body">
        <div class="card">
            <div class="card-inner">
                <ul class="nav nav-tabs nav-sm nav-tabs-s1 px-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#AIWriter">Ajouter page</a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane fade show active" id="AIWriter">
                        <form class="px-3 py-3">
                            <div class="row gy-4 gx-4">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Titre Page</label>
                                        <div class="form-control-wrap">
                                            <input id="title" type="text" wire:model="title" class="form-control" />
                                        </div>
                                        <div>
                                            @error('title') <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" wire:model="type">
                                                <option value="">-- Choisissez --</option>
                                                <option value="apropos_de_nous">Apropos de Nous</option>
                                                <option value="politique_de_confidentialite">Politique de Confidentialité</option>
                                                <option value="mentions_legale">Mentions Légales</option>
                                                <option value="conditions_des_services">Conditions des Services</option>
                                                <option value="autres">Autres</option>
                                            </select>
                                            <div>
                                                @error('type') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="sub_title" class="form-label">Sous titre</label>
                                        <div class="form-control-wrap">
                                            <textarea id="sub_title" wire:model="sub_title" id="" cols="3" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div>
                                            @error('sub_title') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Contenus <small>(facultatif)</small></label>
                                        <div class="form-control-wrap">
                                            <textarea cols="30" rows="10" wire:model="contenus" class="form-control">
                                            </textarea>
                                        </div>
                                        <div>
                                            @error('contenus') <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Publier</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    wire:model="is_active" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Oui</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                <div wire:loading wire:target="save">
                                    <button disabled class="btn btn-primary">
                                        <i class="spinner-border spinner-border-sm" role="status"></i>
                                        Enregistrement en cours...
                                    </button>
                                </div>
                                <div class="col-6" wire:loading.remove wire:target="save">
                                    <button wire:click.prevent="save()" wire:loading.attr="disabled"
                                        class="btn btn-primary close-modal mt-4">
                                        Ajouter <em class="icon ni ni-plus-sm"></em>
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