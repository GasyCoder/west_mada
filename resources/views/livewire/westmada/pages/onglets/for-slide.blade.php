<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-slide" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="add-slideLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Ajouter onglet de slide')}}</h5>
                <form class="mt-2" wire:ignore>
                    <div class="row g-gs">
                        <div class="">
                            <label class="form-label" for="name">Nom</label>
                            <input type="text" class="form-control" id="name" wire:model="name"
                                placeholder="Saisir le nom de votre menu">
                            <div>
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="form-label">Changer menu</label>
                                <div class="form-control-wrap">
                                    <select wire:model="navbar_id" class="form-select">
                                        <option value="">{{__('--Choisir--')}}</option>
                                        @foreach($menus as $menu)
                                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        @error('navbar_id') <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" wire:model="is_active"
                                        id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Activer</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button wire:click.prevent="save()" wire:loading.attr="disabled"
                                        class="btn btn-primary close-modal" wire:loading.class.remove="btn-primary"
                                        wire:loading.class.add="disabled">
                                        Ajouter <em class="icon ni ni-plus-sm"></em>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>