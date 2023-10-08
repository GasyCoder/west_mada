<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between g-3">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{__('Planing de Travail')}}</h3>
                        <div class="nk-block-des text-soft">
                            <p>{{__('Liste des mois de travail.')}}</p>
                        </div>
                    </div>
                    @can('period-create')
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a data-bs-toggle="modal" href="#add-period" class="btn btn-primary">
                                    <em class="icon ni ni-plus"></em><span> Ajouter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endcan
                </div>
            </div>
            @include('livewire.tasks.periode.add')
            <div class="nk-block">
                <div class="card card-bordered card-preview">
                 @if($getperiod > 0)   
                    <div class="card-inner">
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
                        <table class="table">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th class="tb-tnx-id">
                                        <span class="">#</span>
                                    </th>
                                    <th class="tb-tnx-info">
                                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                                            <span>Année</span>
                                        </span>
                                    </th>
                                    <th class="tb-tnx-info">
                                        <span class="tb-tnx-date d-md-inline-block d-none">
                                            <span>Mois</span>
                                        </span>
                                    </th>
                                    @can('period-is_active')
                                    <th class="tb-tnx-amount is-alt">
                                        <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                    </th>
                                    @endcan
                                    @can('period-delete')
                                    <th></th>
                                    @endcan
                                    <th></th>
                                    <th class="tb-tnx-action"><span>&nbsp;</span></th>
                                </tr>
                            </thead>    
                            <tbody>
                                @foreach ($periods as $key => $period)
                                <tr class="tb-tnx-item">
                                    <td><span>{{$key+1}}</span></td>
                                    <td class="tb-tnx-id">
                                        <span class="@if($period->is_active == false) text-muted @endif">{{$period->year}}</span>
                                    </td>
                                    <td class="tb-tnx-info">
                                        <div class="tb-tnx-desc">
                                            <span class="title @if($period->is_active == false) text-muted @else fw-bold @endif ">{{ $period->mois }}</span>
                                        </div>
                                    </td>
                                    @can('period-is_active')
                                    <td class="tb-col-md">
                                        <div class="form-check form-switch custom-control">
                                            @if($period->is_active == true)
                                            <input class="form-check-input" type="checkbox" checked role="switch" id="{{$period->id}}"
                                                wire:click="enable({{ $period->id }})" style="cursor:pointer">
                                            <label class="form-check-label" for="{{$period->id}}"></label>
                                            @else
                                            <input class="form-check-input" type="checkbox" role="switch" id="{{$period->id}}"
                                                wire:click="disable({{ $period->id }})" style="cursor:pointer">
                                            <label class="form-check-label" for="{{$period->id}}"></label>
                                            @endif
                                        </div>
                                    </td>
                                    @endcan
                                    @can('period-delete')
                                    <td class="tb-odr-action">
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            <button class="btn btn-dim btn-sm btn-danger" wire:click="delete({{$period->id}})">
                                                <em class="icon ni ni-trash"></em>
                                            </button>
                                        </div>
                                    </td>
                                    @endcan
                                    
                                    <td class="tb-odr-action">
                                    @if($period->is_active == false)    
                                    @can('super-admin')    
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            <a href="{{ route('tasks', ['id' => $period->id]) }}" wire:navigate class="btn btn-sm btn-primary">
                                                <em class="icon ni ni-list-index"></em> Detail
                                            </a>
                                        </div>
                                    @endcan
                                    @endif
                                    </td>   
                                    @can('period-add-task')
                                    <td class="tb-odr-action">
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            @if($period->is_active == true)
                                                <a href="{{ route('tasks', ['id' => $period->id]) }}" wire:navigate class="btn btn-sm btn-primary">
                                                    <em class="icon ni ni-plus"></em>   
                                                </a>  
                                            @else
                                                <button class="btn btn-dim btn-sm btn-secondary" disabled title="désactivé">
                                                    <em class="icon ni ni-plus"></em>
                                                </button> 
                                            @endif 
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                                {{ $periods->links() }}
                            </div>
                        </div>
                    </div>
                 @else
                    <div class="alert alert-icon alert-danger" role="alert">
                        <em class="icon ni ni-alert-circle"></em>
                        <strong>Information</strong>.
                        {{__('Aucune donnée activé ici pour l\'instant!')}}
                    </div>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>