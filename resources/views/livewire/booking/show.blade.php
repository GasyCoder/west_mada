<div class="modal fade" id="clientView" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">Details Client</h5>
                @php
                $payer = $nbreJours * $montant;
                @endphp
                <div class="card card-bordered mt-2">
                    <div class="nk-block">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="user-card user-card-s2">
                                    @if(isset($detail) && !empty($detail->user->hasRole('client')->image))
                                    <div class="user-avatar sm">
                                        <img src="{{ asset('storage/' . $detail->user->image) }}" alt="Avatar">
                                    </div>
                                    @else
                                    <div class="user-avatar lg bg-primary">
                                        <span>{{ substr($client_name ?? '', 0, 2) }}</span>
                                    </div>
                                    @endif
                                    <div class="user-info">
                                        <div class="badge bg-outline-primary rounded-pill">Client</div>
                                        <h5>{{ $client_name ?? '' }}</h5>
                                        <span class="sub-text">{{ $phone ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner card-inner-sm">
                                <ul class="btn-toolbar justify-center gx-1">
                                    <li>
                                        <a href="#" class="btn btn-trigger btn-icon">
                                            <em class="icon ni ni-mail"></em>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="#" class="btn btn-trigger btn-icon text-danger">
                                            <em class="icon ni ni-na"></em>
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="card-inner">
                                <div class="row text-center">
                                    <div class="col-12">
                                        <div class="profile-stats">
                                            <span class="sub-text">Chambre {{$hotel_type}}</span>
                                            <span class="amount">N° {{$hotel_id}}</span>
                                            <span class="sub-text">Reservation: 
                                                <span class="badge badge-dim bg-light text-primary">
                                                    <em class="icon ni ni-clock"></em>
                                                    <span>{{ $created_at ?? '' }}</span>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner">
                                <h6 class="overline-title-alt mb-2">Informations</h6>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <span class="sub-text">Date d'entrée:</span>
                                        <span>{{$date_debut}}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Date Sortie:</span>
                                        <span>{{$date_fin}}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Nuitée:</span>
                                        <span>{{$nbreJours}} </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Avance:</span>
                                        <a href="#">
                                            <span>{{$pourcent. ' %'}}</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Total payé:</span>
                                        <span>{{number_format($payer)}} Ar</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Status:</span>
                                        @if($statut == 'confirmée')
                                        <span class="lead-text text-success">Payée</span>
                                        @else
                                        <span class="lead-text text-warning">En attente</span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <span class="sub-text">Fait par:</span>
                                        <span class="lead-text text-info">{{$user_id}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>