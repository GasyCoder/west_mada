@can('stock_category-create')
<div class="col-lg-4">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Ajouter</h5>
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
                            <input type="checkbox" class="custom-control-input" wire:model="is_active"
                                id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Activer</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button wire:click.prevent="save()" wire:loading.attr="disabled" class="btn btn-primary close-modal"
                        wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                        Ajouter <em class="icon ni ni-plus-sm"></em>
                    </button>
                    {{-- <div wire:loading>
                        En cours d'enregistrement...
                    </div> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endcan