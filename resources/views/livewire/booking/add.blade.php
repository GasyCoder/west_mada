<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="AddBooking" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="AddBookingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservation</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
            <form class="form-validate is-alter">
                <div class="row gx-4 gy-3">
                @if ($currentStep === 1)
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Date de début</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input wire:model.live="date_debut" type="date" class="form-control" placeholder="Date début"
                                    min="{{ now()->format('Y-m-d') }}">
                                <div>
                                    @error('date_debut') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Date de fin</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input wire:model.live="date_fin" type="date" class="form-control" placeholder="Date fin"
                                        min="{{ now()->format('Y-m-d') }}" wire:click.live="changed()">
                                    <div>
                                        @error('date_fin') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!$showPrixTotal)
                        <div class="col-12"> 
                        @else
                        <div class="col-6">    
                        @endif
                            <div class="form-group">
                            <label class="form-label">Chambre</label>
                            <div class="form-control-wrap">
                                <select id="hotel_id" wire:model="hotel_id" 
                                    class="form-select"
                                    data-search="on"
                                    wire:change="populate($event.target.value)">
                                    <option value="">--Choisir--</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{$hotel->id}}">
                                            N°{{$hotel->room_number}} - {{$hotel->roomType->name}} 
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('hotel_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            </div>
                        </div>
                        @if ($showPrixTotal)
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="montant">Prix par nuitée</label>
                                <div class="form-control-wrap">
                                    <input type="number" id="montant" wire:model.lazy="montant" 
                                     class="form-control">
                                    <div>
                                        @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Default is 100% --}}
                        <div class="col-2">
                            <div class="form-group">
                                <label class="form-label" for="pourcent">Avance</label>
                                <div class="form-control-wrap">
                                    <select id="pourcent" wire:model.live="pourcent" class="form-select"
                                        wire:change="montantBypourcent">
                                        <option value="100">100%</option>
                                        <option value="50">50%</option>
                                    </select>
                                    <div>
                                        @error('pourcent') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <ul class="d-flex justify-content-between gx-4 mt-1">
                                <li>
                                    <div wire:loading wire:target="checkAvailability">
                                        <button disabled class="btn btn-primary">
                                            <i class="spinner-border spinner-border-sm" role="status"></i>
                                            En cours de vérification...
                                        </button>
                                    </div>
                                    <div wire:loading.remove wire:target="checkAvailability">
                                        <button class="btn btn-primary" wire:click.prevent="checkAvailability()" wire:target="checkAvailability">
                                            Vérifier
                                        </button>
                                    </div>
                                </li>
                                @if ($isHotelAvailable)
                                <li>
                                    <button class="btn btn-info" wire:click.prevent="nextStep" wire:ignore.self>
                                        {{__('Suivant')}} <em class="icon ni ni-chevron-right"></em>
                                    </button>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <x-alertSession/>

                        @elseif ($currentStep === 2)
                        {{-- Before the checking these inputs must be hidden --}}
                        <div class="col-8">
                            <div class="form-group">
                                <label class="form-label" for="client_name">Nom Client</label>
                                <div class="form-control-wrap">
                                    <input type="text" wire:model.live="client_name" class="form-control" 
                                    id="client_name" required
                                    autocomplete="client_name" autofocus
                                    value="{{ old('client_name') }}">
                                    <div>
                                        @error('client_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group"><label class="form-label">Sexe</label>
                            <div class="form-control-wrap">
                                <select class="form-select" wire:model="sexe">
                                    <option value="">--Chosir</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                <div>
                                    @error('sexe') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">Téléphone</label>
                                <div class="form-control-wrap">
                                    <input type="text" wire:model.live="phone" class="form-control" 
                                    id="phone" 
                                    required
                                    autocomplete="phone" autofocus
                                    value="{{ old('phone') }}">
                                    <div>
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input type="text" wire:model.live="email" class="form-control" id="email" 
                                required autocomplete="Adresse email"
                                    autofocus value="{{ old('email') }}">
                                <div>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="event-description">Description <small>(facultatif)</small></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" wire:model="description" id="event-description"></textarea>
                                </div>
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
                    @endif
                    <!-- Navigation Buttons -->
                    <div class="col-12">
                        <ul class="d-flex justify-content-between gx-4 mt-1">
                            @if ($currentStep > 1)
                            <li>
                                <button class="btn btn-secondary btn-dim" wire:click.prevent="prevStep">
                                    <em class="icon ni ni-chevron-left"></em> Retour
                                </button>
                            </li>
                            @endif
                            @if ($currentStep === 2)
                            <li>
                                <button wire:loading.attr="disabled" class="btn btn-success" 
                                 wire:click.prevent="store">
                                 <em class="icon ni ni-check-circle-fill"></em> Confirm
                                 <div wire:loading>
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                </button>
                            </li>
                            @endif
                        </ul>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push("scripts")

@endpush