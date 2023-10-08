<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit-onglet" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="edit-ongletLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Modifier onglet')}}</h5>
                <form class="mt-2" wire:ignore>
                    <div class="row g-gs">
                        <div class="@if($is_slider == false) col-md-6 @else col-md-10 @endif ">
                            <label class="form-label" for="name">Nom</label>
                            <input type="text" class="form-control" id="name" wire:model="name"
                                placeholder="Saisir le nom de votre menu">
                            <div>
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if($is_slider == false)
                        <div class="col-md-6">
                            <label class="form-label" for="name">Menu Navbar</label>
                            <input type="text" class="form-control" id="name" 
                                wire:model="navbar_id" readonly>
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
                                        @foreach($navbars as $navbar)
                                            <option value="{{$navbar->id}}">{{$navbar->name}}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        @error('navbar_id') <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-switch">
                                        @if ($is_active)
                                        <input type="checkbox" class="custom-control-input" checked
                                            wire:model="is_active" id="customSwitch{{$selected_id}}">
                                        <label class="custom-control-label text-success"
                                            for="customSwitch{{$selected_id}}">
                                            Activer
                                        </label>
                                        @else
                                        <input type="checkbox" class="custom-control-input" wire:model="is_active"
                                            id="customSwitch{{$selected_id}}">
                                        <label class="custom-control-label text-success"
                                            for="customSwitch{{$selected_id}}">
                                            Activer
                                        </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button wire:click.prevent="update()" wire:loading.attr="disabled"
                                        class="btn btn-success close-modal" wire:loading.class.remove="btn-primary"
                                        wire:loading.class.add="disabled">
                                        Mettre à jour <em class="icon ni ni-reload-alt"></em>
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