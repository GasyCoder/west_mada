<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">{{__('Tableau de bord de l\'Application')}}</h3>
                    <div class="nk-block-des text-soft">
                        <p>{{__('Bienvenue')}}</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle"><a href="#"
                            class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div>
                                        <a href="#"
                                            class="btn btn-white btn-light text-white bg-secondary">
                                            <em class="d-none d-sm-inline icon ni ni-calender-date"></em>
                                            <span>
                                                <span class="d-none d-md-inline">
                                                   {{ date('d-M-Y')}}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                {{-- <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em
                                    class="icon ni ni-reports"></em><span>Reports</span></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="row g-gs">
                <div class="col-md-4">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="title">Réservation en cours</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help-fill"
                                        data-bs-toggle="tooltip" data-bs-placement="left" 
                                        aria-label="Réservation totale"
                                        data-bs-original-title="Réservation totale">
                                    </em>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount"> {{$reservationTotale}} </span>
                            </div>
                            <div class="invest-data">
                                <div class="invest-data-amount g-2">
                                    <div class="invest-data-history">
                                        <div class="title">CE MOIS-CI</div>
                                        <div class="amount">{{ $counts['countThisMonth'] }}</div>
                                    </div>
                                    <div class="invest-data-history">
                                        <div class="title">CETTE SEMAINE</div>
                                        <div class="amount">{{ $counts['countThisWeek'] }}</div>
                                    </div>
                                </div>
                                <div class="invest-data-ck"><canvas class="iv-data-chart" id="totalBooking" width="312"
                                        height="60"
                                        style="display: block; box-sizing: border-box; height: 48px; width: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="title">Status de réservation</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help-fill"
                                        data-bs-toggle="tooltip" data-bs-placement="left" 
                                        aria-label="Status de réservation"
                                        data-bs-original-title="Status de réservation">
                                    </em>
                                </div>
                            </div>
                            <div class="invest-data">
                                <div class="invest-data-amount g-3">
                                    <div class="invest-data-history">
                                        <div class="title">Payée</div>
                                        <div class="amount">{{$confirme}}</div>
                                        <br>
                                        <div class="title">Terminée</div>
                                        <div class="amount">{{$terminer}}</div>
                                    </div>
                                    <div class="invest-data-history">
                                        <div class="title">En attente</div>
                                        <div class="amount">{{$enAttente}}</div>
                                        <br>
                                        <div class="title">Remboursé</div>
                                        <div class="amount">{{$rembourser}}</div>
                                    </div>
                                    <div class="invest-data-history">
                                        <div class="title">Annulée</div>
                                        <div class="amount">{{$annuler}}</div>
                                        <br>
                                        <div class="title">Corbeille</div>
                                        <div class="amount">{{$trash}}</div>
                                    </div>
                                </div>
                                <div class="invest-data-ck">
                                    <canvas class="iv-data-chart" id="totalRoom" width="310"
                                        height="60"
                                        style="display: block; box-sizing: border-box; height: 48px; width: 248px;">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-bordered  card-full">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="title">Clients</h6>
                                </div>
                                <div class="card-tools"><em class="card-hint icon ni ni-help-fill"
                                        data-bs-toggle="tooltip" data-bs-placement="left" 
                                        aria-label="Clients"
                                        data-bs-original-title="Clients"></em>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount"> 79358
                                    <span class="currency currency-usd">Total</span>
                                </span>
                            </div>
                            <div class="invest-data">
                                <div class="invest-data-amount g-2">
                                    <div class="invest-data-history">
                                        <div class="title">National</div>
                                        <div class="amount">540
                                        </div>
                                    </div>
                                    <div class="invest-data-history">
                                        <div class="title">Internation</div>
                                        <div class="amount">259
                                        </div>
                                    </div>
                                </div>
                                <div class="invest-data-ck">
                                    <canvas class="iv-data-chart" id="totalExpenses" width="290"
                                        height="60"
                                        style="display: block; box-sizing: border-box; height: 48px; width: 232px;">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  Boking --}}

                @include('livewire.booking.index')
                
            </div>
        </div>
    </div>
</div>
