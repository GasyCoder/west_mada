<div class="col-lg-4">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Modifier</h5>
            </div>
            <form>
                <div class="mb-3">
                    <label class="form-label" for="name">Nom</label>
                    <input type="text" class="form-control" id="name" wire:model="name" placeholder="Saisir le nom">
                    <div>
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            @if ($is_active)
                            <input type="checkbox" class="custom-control-input" checked wire:model="is_active"
                                id="customSwitch{{$selectId}}">
                            <label class="custom-control-label text-success" for="customSwitch{{$selectId}}">
                                Activer
                            </label>
                            @else
                            <input type="checkbox" class="custom-control-input" wire:model="is_active" id="customSwitch{{$selectId}}">
                            <label class="custom-control-label text-success" for="customSwitch{{$selectId}}">
                                Activer
                            </label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-success close-modal"
                        wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                        Mettre à jour <em class="icon ni ni-reload-alt"></em>
                    </button>
                    {{-- <div wire:loading>
                        Mis à jour en cours...
                    </div> --}}
                </div>
            </form>
        </div>
    </div>
</div>