<div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{__('List des chambres')}}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{__('Voici nos différentes chambres.')}}</p>
                                </div>
                            </div>
                            @can('hotel-create')
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <a data-bs-toggle="modal" href="#add-room" class="btn btn-primary">
                                            <em class="icon ni ni-plus"></em><span>Ajouter</span>
                                        </a>
                                    </li>
                                    {{-- <div class="drodown">
                                        <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                           <em class="icon ni ni-download-cloud"></em>
                                            <span>Import/Export</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>Import</span></a></li>
                                                <li><a href="#"><span>Export</span></a></li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </ul>
                            </div>
                            @endcan
                        </div>
                    </div>  
                        @include('livewire.hotels.create')
                        @include('livewire.hotels.edit')
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-tools col-md-12">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" wire:model.live="search" name="search" class="form-control" 
                                                id="search" placeholder="Rechercher...">
                                        </div>
                                    </div>
                                </div>
                                <div class="p-0">
                                    <table class="table table-tranx">
                                        <thead>
                                            <tr>
                                                {{-- <th>
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="uid">
                                                        <label class="custom-control-label" for="uid"></label>
                                                    </div>
                                                </th> --}}
                                                <th>Chambre numéro.</th>
                                                <th>Type de chambre</th>
                                                <th class="tb-col-md">Nombre personne</th>
                                                <th class="tb-col-lg">Prix</th>
                                                @can('hotel-is_active')
                                                <th class="tb-col-md">Status</th>
                                                @endcan
                                                <th class=""></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($hotels as $key => $hotel)
                                        <tr>
                                            {{-- <td>
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid{{ $hotel->id }}">
                                                    <label class="custom-control-label" for="uid{{ $hotel->id }}"></label>
                                                </div>
                                            </td> --}}
                                            <td wire:key="{{ $hotel->id }}">
                                                <span class="text-primary">{{$hotel->room_number}}</span>
                                            </td>
                                            <td wire:key="{{ $hotel->roomType->id }}">
                                                {{$hotel->roomType->name}}
                                            </td>
                                            <td>{{$hotel->nbre_persone}}</td>
                                            <td class="tb-col-mb">
                                                <span class="tb-amount">{{$hotel->tarif}} <span class="currency">Ar</span></span>
                                            </td>
                                            <td class="tb-col-md">
                                                @can('hotel-is_active')    
                                                    <div class="form-check form-switch custom-control">
                                                        @if($hotel->is_active == true)
                                                        <input class="form-check-input" type="checkbox" checked role="switch" id="{{$hotel->id}}"
                                                            wire:click="enable({{ $hotel->id }})" style="cursor:pointer">
                                                        <label class="form-check-label" for="{{$hotel->id}}"></label>
                                                        @else
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{$hotel->id}}"
                                                            wire:click="disable({{ $hotel->id }})" style="cursor:pointer">
                                                        <label class="form-check-label" for="{{$hotel->id}}"></label>
                                                        @endif
                                                    </div>
                                                @endcan
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            @can('hotel-edit')
                                                            <li>
                                                                <a data-bs-toggle="modal" href="#edit-room"
                                                                wire:click="edit({{ $hotel->id }})">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            @endcan
                                                            @can('hotel-delete')
                                                            <li>
                                                                <a href="#" class="text-danger" 
                                                                onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément?') || event.stopImmediatePropagation()"    
                                                                wire:click="delete({{ $hotel->id}})">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach  
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        <div class="g">
                                            {{ $hotels->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

