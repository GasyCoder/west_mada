<form class="mt-2">
    <div class="row g-gs">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="room-no-add">{{__('Chambre numéro')}}</label>
                <input type="number" wire:model="room_number" class="form-control" id="room-no-add"
                    placeholder="{{__('Chambre numéro')}}">
                <div>
                    @error('room_number') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">{{__('Type de chambre')}}</label>
                <div class="form-control-wrap">
                    <select wire:model="room_type_id" class="form-select">
                        <option value="">{{__('--Choisir--')}}</option>
                        @foreach ($roomtypes as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('room_type_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="bed-no-add">{{__('Nombre de personne')}}</label>
                <input type="number" wire:model="nbre_persone" class="form-control" id="bed-no-add"
                    placeholder="{{__('Nombre de personne')}}">
                <div>
                    @error('nbre_persone') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="rent-add">Tarif</label>
                <input type="number" wire:model="tarif" class="form-control" id="rent-add" placeholder="0.00 Ariary">
                <div>
                    @error('tarif') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12" wire:ignore>
            <div class="form-group">
                <label class="form-label">{{__('Insclus')}}</label>
                <div class="form-control-wrap">
                    <select wire:model="include" class="form-select" multiple>
                        <option value="" disabled>{{ __('--Choisir--') }}</option>
                        @foreach ($includes as $include)
                        <option value="{{ $include->name }}">{{ $include->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-12" wire:ignore>
            <div class="form-group">
                <label class="form-label">{{__('Description')}} <small>(facultatif)</small></label>
                <textarea class="form-control" wire:model="description" id="description" cols="3" rows="2"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="custom-control custom-switch">
                    @if ($is_active)
                    <input type="checkbox" class="custom-control-input" checked wire:model="is_active" id="customSwitch{{$selected_id}}">
                    <label class="custom-control-label text-success" for="customSwitch{{$selected_id}}">
                        Activer
                    </label>
                    @else
                    <input type="checkbox" class="custom-control-input" wire:model="is_active" id="customSwitch{{$selected_id}}">
                    <label class="custom-control-label text-success" for="customSwitch{{$selected_id}}">
                        Activer
                    </label>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                {{-- <li>
                    <a href="#" class="link text-danger" data-bs-dismiss="modal">Annuler</a>
                </li> --}}
                <li>
                    <button wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-success close-modal"
                        wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                        Mettre à jour <em class="icon ni ni-reload-alt"></em>
                    </button>
                    <div wire:loading>
                        Mis à jour en cours...
                    </div>
                </li>
            </ul>
        </div>
    </div>
</form>