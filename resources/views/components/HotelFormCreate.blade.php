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
                        <option value="">{{ __('--Choisir--') }}</option>
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
                    <input type="checkbox" class="custom-control-input" wire:model="is_active" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Activer</label>
                </div>
            </div>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-12">
            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                <li>
                    <button wire:click.prevent="save()" wire:loading.attr="disabled" class="btn btn-primary close-modal"
                        wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                        Ajouter <em class="icon ni ni-plus-sm"></em>
                    </button>
                    <div wire:loading>
                        En cours d'enregistrement...
                    </div>
                </li>
            </ul>
        </div>
    </div>
</form>