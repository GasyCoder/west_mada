<div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{__('List des stocks')}}</h3>
                            <div class="nk-block-des text-soft">
                                <p>{{__('Voici nos différentes stocks.')}}</p>
                            </div>
                        </div>
                        @can('stock-create')
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a data-bs-toggle="modal" href="#add-stock" class="btn btn-primary">
                                        <em class="icon ni ni-plus"></em><span>Ajouter</span>
                                    </a>
                                </li>
                                <div class="drodown">
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
                                </div>
                            </ul>
                        </div>
                        @endcan
                    </div>
                </div>
                @include('livewire.magasins.stocks.create')
                @include('livewire.magasins.stocks.edit')
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card card-bordered card-preview">
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
                                <div class="card-inner">
                                    <table class="table table-tranx">
                                        <thead>
                                            <tr>
                                                <th>Réf</th>
                                                <th>Nom</th>
                                                <th>Catégorie</th>
                                                <th>Service</th>
                                                <th class="tb-col-md">Qté Stock</th>
                                                <th class="tb-col-md">Prix U</th>
                                                <th class="tb-col-md">Status</th>
                                                <th></th>
                                                <th class=""></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stocks as $key => $stock)
                                            <tr>
                                                <td wire:key="{{ $stock->reference }}"><span class="text-primary">#{{ $stock->reference
                                                        }}</span></td>
                                                <td wire:key="{{ $stock->id }}">
                                                    {{$stock->name}}
                                                </td>
                                                <td wire:key="{{ $stock->categorie->id }}">
                                                    {{$stock->categorie->name}}
                                                </td>
                                                <td wire:key="{{ $stock->id }}">
                                                    {{$stock->service->title}}
                                                </td>
                                                <td class="tb-col-mb">
                                                    <span class="tb-amount">
                                                    @if($stock->stock_quantity <= 0) 
                                                    <span class="text-danger">{{$stock->stock_quantity}}</span>
                                                    @endif/{{$stock->max_quantity . $stock->unite_stock}}
                                                    </span>
                                                </td>
                                                <td class="tb-col-mb">
                                                    <span class="tb-amount">{{$stock->price_u . 'Ar'}}
                                                    </span>
                                                </td>
                                                <td class="tb-col-md">
                                                    <div class="tb-tnx-status">
                                                        @if($stock->stock_quantity <= 0)
                                                         <span class="badge badge-dot bg-danger">Epuisé</span>
                                                        @else
                                                         <span class="badge badge-dot bg-success">Actif</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                @can('stock-is_active')
                                                <td class="tb-col-md">
                                                    <div class="form-check form-switch custom-control">
                                                        @if($stock->is_active == true)
                                                        <input class="form-check-input" type="checkbox" checked role="switch" id="{{$stock->id}}"
                                                            wire:click="enable({{ $stock->id }})" style="cursor:pointer">
                                                        <label class="form-check-label" for="{{$stock->id}}"></label>
                                                        @else
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{$stock->id}}"
                                                            wire:click="disable({{ $stock->id }})" style="cursor:pointer">
                                                        <label class="form-check-label" for="{{$stock->id}}"></label>
                                                        @endif
                                                    </div>
                                                </td>
                                                @endcan
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                              @can('stock-edit')  
                                                                <li>
                                                                    <a data-bs-toggle="modal" href="#edit-stock"
                                                                        wire:click="edit({{ $stock->id }})">
                                                                        <em class="icon ni ni-edit"></em>
                                                                        <span>Edit</span>
                                                                    </a>
                                                                </li>
                                                                @endcan
                                                                @can('stock-delete')
                                                                <li>
                                                                    <a href="#" class="text-danger"
                                                                        onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément?') || event.stopImmediatePropagation()"
                                                                        wire:click="delete({{ $stock->id}})">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>