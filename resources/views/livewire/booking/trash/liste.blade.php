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
                        <span class="sub-text">Client <em class="icon ni ni-user-alt-fill"></em></span>
                    </div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Date <em class="icon ni ni-calendar-check-fill"></em></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Ce jour <em class="icon ni ni-calender-date-fill"></em></span>
                    </div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Réservé <em class="icon ni ni-clock-fill"></em></span></div>
                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Montant <em class="icon ni ni-coin-alt-fill"></em></span></div>
                    <div class="nk-tb-col tb-col-md text-center"><span class="sub-text">Avance</span></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>

                    <div class="nk-tb-col"><span class="sub-text">&nbsp;</span></div>
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
                        <small class="fw-bold">{{$reservation->montant. 'Ar'}}</small>
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
                        <span class="badge badge-dim bg-outline-secondary">Annulée
                        </span>
                        @elseif($reservation->statut == 'remboursé')
                        <span class="badge badge-dim bg-outline-secondary">Remboursé
                        </span>
                        @elseif($reservation->statut == 'en_attente')
                       <span class="badge badge-dim bg-outline-secondary ">Terminée
                        @endif
                    </div>
                    <div class="nk-tb-col"><span>&nbsp;</span></div>
                    <div class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-2">
                            <li class="nk-tb text-danger">
                                @can('hotel-delete')
                                @if($confirmingDelete === $reservation->id)
                                <a href="#!" wire:click="kill({{ $reservation->id }})"
                                    class="btn btn-sm btn-icon btn-trigger text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" aria-label="Sur...?" data-bs-original-title="Sur...?">
                                    <em class="icon ni ni-delete-fill"></em>
                                </a>
                                @else
                                @can('booking-delete')
                                <a href="#!" wire:click="confirmDelete({{ $reservation->id }})"
                                    class="btn btn-sm btn-icon btn-trigger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" aria-label="Supprimer" data-bs-original-title="Supprimer">
                                    <em class="icon ni ni-cross-circle-fill"></em>
                                </a>
                                @endcan
                                @endif
                                @endcan
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
                                                <a data-bs-toggle="modal" wire:click="show({{$reservation->id}})" href="#clientView">
                                                    <em class="icon ni ni-eye"></em>
                                                    <span>Aperçu rapide</span>
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
            <a href="/corbeille-reservations" wire:navigate class="btn btn-sm btn-primary text-end"><em
                    class="icon ni ni-reload"></em></a>
        </div>
    </div>
    @endif
</div>

@push("scripts")

@endpush