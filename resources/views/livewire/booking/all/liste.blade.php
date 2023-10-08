<div class="card card-bordered card-stretch">
    <div class="card-inner position-relative card-tools-toggle">
        <div class="card-tools col-md-12">
            <div class="form-control-wrap">
                <div class="form-icon form-icon-right">
                    <em class="icon ni ni-search"></em>
                </div>
                <input type="text" wire:model.live="search" name="search" class="form-control" id="search"
                    placeholder="Rechercher...">
            </div>
        </div>
    </div>  
    @if($reservations->count())
    <div class="card-inner-group">
        <div class="card-inner p-0">
            <div class="nk-tb-list nk-tb-ulist">
                <div class="nk-tb-item nk-tb-head">
                    <div class="nk-tb-col tb-col-md"><span class="sub-text"></span></div>
                    <div class="nk-tb-col">
                    <span class="sub-text">
                        Client <em class="icon ni ni-user-alt-fill"></em>
                    </span>
                    </div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Date <em class="icon ni ni-calendar-check-fill"></em></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Ce jour <em class="icon ni ni-calender-date-fill"></em></span></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Réservé <em class="icon ni ni-clock-fill"></em></span></div>
                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Montant <em class="icon ni ni-coin-alt-fill"></em></span></div>
                    <div class="nk-tb-col tb-col-md text-center"><span class="sub-text">Avance</span></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>

                    <div class="nk-tb-col"><span class="sub-text">&nbsp;</span></div>
                    <div class="nk-tb-col nk-tb-col-tools text-end">
                        <div class="dropdown">
                            <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                data-bs-toggle="dropdown" data-offset="0,5">
                                <em class="icon ni ni-plus"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                <ul class="link-tidy sm no-bdr">
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="an" wire:click="toggleAnnuler">
                                            <label class="custom-control-label" for="an">Annulée</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="tr" wire:click="toggleTerminer">
                                            <label class="custom-control-label" for="tr">Terminée</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="bc" wire:click="toggleBack">
                                            <label class="custom-control-label" for="bc">Remboursé</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($reservations as $reservation)
                {{-- Calcul du nombre de jours de réservation --}}
                @php
                $payer = $reservation->nombreDeJours * $reservation->montant;
                @endphp
                <div class="nk-tb-item">
                    <div class="nk-tb-col tb-col-md">
                        <a href="" class="sub-text tb-lead badge badge-dim bg-light">
                            <b><em class="icon ni ni-building-fill sm"></em> {{$reservation->hotel->room_number}}</b> -
                            <small>{{$reservation->hotel->roomType->name}}</small>
                        </a>
                    </div>
                    <div class="nk-tb-col">
                        <div class="user-card">
                            @if(!empty($reservation->user->hasRole('client')->image))
                            <div class="user-avatar sm">
                                <img src="{{ asset('storage/' . $reservation->user->image) }}" alt="Avatar">
                            </div>
                            @else
                            <div class="user-avatar sm bg-primary"><span>{{ substr($reservation->client_name, 0, 2)
                                    }}</span></div>
                            @endif
                            <div class="user-info">
                                <span class="tb-lead">{{$reservation->client_name}}
                                    <span class="dot dot-warning d-md-none ms-1"></span>
                                </span><span>{{$reservation->phone}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="sub-text tb-lead badge badge-dim 
                        rounded-pill bg-success"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top" 
                        aria-label="{{$reservation->date_debut->format('d-m-Y')}}" 
                        data-bs-original-title="{{$reservation->date_debut->format('d-m-Y')}}"
                        style="cursor:pointer">
                            {{$reservation->date_debut->format('d-M')}} 
                            <small class="text-end"> à {{$reservation->checkin->format('H:i')}}</small>
                        </span>
                        <span class="sub-text tb-lead badge badge-dim 
                            rounded-pill bg-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                            aria-label="{{$reservation->date_fin->format('d-m-Y')}}"
                            data-bs-original-title="{{$reservation->date_fin->format('d-m-Y')}}" style="cursor:pointer">
                            {{$reservation->date_fin->format('d-M')}}
                            <small class="text-end"> à {{$reservation->checkout->format('H:i')}}</small>
                        </span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                            {{ $reservation->nombreDeJours }} nuitée(s)
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="badge badge-dim bg-light text-gray">
                            <span>{{$reservation->time_diff}}</span>
                        </span>
                    </div>
                    <div class="nk-tb-col tb-col-mb tb-lead">
                        <small class="fw-bold">{{number_format($payer)}} Ar</small>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-center">
                        @if($reservation->pourcent >= 100)
                        <small class="text-primary tb-lead fw-bold">{{$reservation->pourcent. '%'}}</small>
                        @else
                        <small class="text-danger tb-lead fw-bold">{{$reservation->pourcent. '%'}}</small>
                        @endif
                    </div>
                    <div class="nk-tb-col tb-col-md">
                        @if($reservation->statut == 'annulé')
                        <span class="badge badge-dim bg-outline-danger">Annulée</span>
                        @elseif($reservation->statut == 'remboursé')
                        <span class="badge badge-dim bg-outline-warning">Remboursé</span>
                        @else
                        <span class="badge badge-dim bg-outline-success ">Terminée</span>
                        @endif
                    </div>
                    <div class="nk-tb-col"><span>&nbsp;</span></div>
                    <div class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-2">
                       @if($reservation->statut == 'confirmée')
                        <li class="nk-tb-action-hidden"> 
                            @if($confirmingTermine === $reservation->id)
                                <a href="#!" wire:click="terminer({{$reservation->id}})" 
                                    class="btn btn-sm btn-icon btn-trigger text-success"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sur...?"
                                    data-bs-original-title="Sur...?">
                                    <em class="icon ni ni-check-fill-c"></em>
                                </a>
                            @else
                                @can('booking-termined')
                                <a href="#!" wire:click="confirmTerminer({{$reservation->id}})" 
                                    class="btn btn-sm btn-icon btn-trigger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" aria-label="Terminer" 
                                    data-bs-original-title="Terminer">
                                    <em class="icon ni ni-chevron-down-round-fill"></em>
                                </a>
                                @endcan
                            @endif
                        @elseif($reservation->statut == 'en_attente')
                            @if($confirmingPending === $reservation->id)
                                <a href="#!" wire:click="confirmer({{$reservation->id}})" 
                                class="btn btn-sm btn-icon btn-trigger text-warning" 
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                aria-label="Sur...?" data-bs-original-title="Sur...?">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </a>
                            @else
                                @can('booking-confirmed')
                                <a href="#!" wire:click="confirmPending({{$reservation->id}})" 
                                class="btn btn-sm btn-icon btn-trigger"
                                data-bs-toggle="tooltip" data-bs-placement="top" 
                                aria-label="Confirmer" data-bs-original-title="Confirmer">
                                    <em class="icon ni ni-check-circle-fill"></em>
                                </a>
                                @endcan
                            @endif
                        @elseif($reservation->statut == 'annulé')
                            @if($confirmingUndo === $reservation->id)
                            <a href="#!" wire:click="back({{$reservation->id}})" 
                                class="btn btn-sm btn-icon btn-trigger text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sur...?" 
                                data-bs-original-title="Sur...?">
                                <em class="icon ni ni-reply-all-fill"></em>
                            </a>
                            @else
                            @can('booking-backmoney')
                            <a href="#!" wire:click="backMoney({{$reservation->id}})" 
                                class="btn btn-sm btn-icon btn-trigger"
                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Rembourser" 
                                data-bs-original-title="Rembourser">
                                <em class="icon ni ni-invest"></em>
                            </a>
                            @endcan
                            @endif
                        </li>
                        @endif
                        
                        <li>
                        @if($reservation->statut == 'confirmée' || $reservation->statut == 'en_attente')    
                            @if($confirmingAnnuler === $reservation->id)
                                <a href="#!" wire:click="annuler({{$reservation->id}})" 
                                    class="btn btn-sm btn-icon btn-trigger text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sur...?" 
                                    data-bs-original-title="Sur...?">
                                    <em class="icon ni ni-user-cross-fill"></em>
                                </a>
                                @else
                                @can('booking-cancel')
                                <a href="#!" wire:click="confirmAnnuler({{$reservation->id}})" 
                                    class="btn btn-sm btn-icon btn-trigger"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Annuler" 
                                    data-bs-original-title="Annuler">
                                    <em class="icon ni ni-user-cross-fill"></em>
                                </a>
                                @endcan
                            @endif    
                        @else
                                @if($confirmingTrash === $reservation->id)
                                <a href="#!" wire:click="trash({{ $reservation->id }})" 
                                    class="btn btn-sm btn-icon btn-trigger text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sur...?" 
                                    data-bs-original-title="Sur...?">
                                    <em class="icon ni ni-trash"></em>
                                </a>
                                @else
                                @can('booking-corbeille')
                                <a href="#!" wire:click="confirmTrash({{ $reservation->id }})" 
                                    class="btn btn-sm btn-icon btn-trigger"
                                    data-bs-toggle="tooltip" data-bs-placement="top" 
                                    aria-label="Corbeille" data-bs-original-title="Corbeille">
                                    <em class="icon ni ni-trash-empty-fill"></em>
                                </a>
                                @endcan
                                @endif
                        @endif
                        </li>

                        <li>
                            <div class="drodown">
                                <a href="#!" class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                    data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        @can('booking-view')
                                        <li>
                                            <a data-bs-toggle="modal" wire:click="show({{$reservation->id}})"
                                                href="#clientView">
                                                <em class="icon ni ni-eye"></em>
                                                <span>Aperçu rapide</span>
                                            </a>
                                        </li>
                                        @endcan
                                        @can('booking-edit')
                                        <li>
                                            <a href="#!" data-bs-toggle="modal">
                                                <em class="icon ni ni-edit"></em>
                                                Modifier
                                            </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-inner">
            <ul class="pagination justify-content-center justify-content-md-start">
                {{$reservations->links()}}
            </ul>
        </div>
    </div>
    @else
    <div class="p-3">
        <div class="alert alert-icon alert-warning" role="alert">
            <em class="icon ni ni-alert-circle"></em>
            <strong>Informations</strong>.
            Aucun des reservation disponible pour moment.
            <a href="/toutes-reservations" wire:navigate class="btn btn-sm btn-primary text-end"><em
                    class="icon ni ni-reload"></em></a>
        </div>
    </div>
    @endif
</div>

@push("scripts")

@endpush