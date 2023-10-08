<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between g-3">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{__('Nos Tasks')}}</h3>
                        <div class="nk-block-des text-soft">
                            <p>{{__('Voici nos différentes produits.')}}</p>
                        </div>
                    </div>
                    @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                    @endif
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools g-3">
                            <li  class="nk-block-tools-opt">
                                <a data-bs-toggle="modal" href="#add-bon" class="btn btn-primary">
                                    <em class="icon ni ni-plus"></em><span> Entrée / Sortie</span>
                                </a>
                            </li>
                            @can('super-admin')
                            <div class="">
                                <a data-bs-toggle="modal" href="#cart-bon" wire:click="openCart()" 
                                   class="btn btn-outline-light btn-white">
                                    <em class="icon ni ni-cart-fill"></em>
                                    <span>Panier(<b class="text-danger">{{$countChecked}}</b>)</span>
                                  
                                </a>    
                            </div>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
            @include('livewire.tasks.create')
            @include('livewire.tasks.detail')
            @include('livewire.tasks.edit')
            @include('livewire.tasks.cart.achat')
            <div class="nk-block">
                <div class="card card-bordered card-preview">
                    <div class="card-inner position-relative card-tools-toggle">
                        <div class="card-tools col-md-12">
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-search"></em>
                                </div>
                                <input type="text" wire:model.live="search" name="search" 
                                class="form-control" id="search"
                                    placeholder="Rechercher...">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    @if($tasks->count() > 0)    
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>
                                    {{-- <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" wire:model="checkedAll"
                                    class="custom-control-input" 
                                    id="uid" value="1" wire:click="toggleAll()">
                                    <label class="custom-control-label" for="uid"></label>
                                    </div> --}}
                                </th>
                                <th scope="col">Réf</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Qté</th>
                                <th scope="col">Date/Heur</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $key => $row)
                            <tr>
                                @can('super-admin')
                                <td>
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" wire:model="checked" wire:click="countChecked()" 
                                            class="custom-control-input" 
                                            value="{{ $row->id }}" id="uid{{ $row->id }}">
                                        <label class="custom-control-label" for="uid{{ $row->id }}"></label>
                                    </div>
                                </td>
                                @else
                                <td></td>
                                @endcan
                                <td>{{ $row->reference }}</td>
                                <td>{{ $row->category->name }}</td>
                                <td class="text-ellipsis">{{ $row->stock->name }}</td>
                                <td>
                                    <a href="#">{{ $row->quantity }}</a>
                                </td>
                                <td><small class="text-muted">{{ $row->created_at->format('d-M à H:i') }}</small></td>
                                <td>
                                    <span class="badge {{ $row->type == 'sortie' ? 'bg-danger' : 'bg-info' }}">
                                        {{ $row->type == 'sortie' ? 'Sortie' : 'Entrée' }}
                                    </span>
                                </td>   
                                <td>
                                    <div class="btn-group" role="group">
                                        <a data-bs-toggle="modal" href="#show-bon" 
                                            class="btn btn-primary btn-sm" 
                                            wire:click="show({{ $row->id }})">
                                            <em class="icon ni ni-eye"></em> 
                                        </a>
                                    </div>
                                    @can('task-edit')
                                    <div class="btn-group" role="group">
                                        <a data-bs-toggle="modal" href="#edit-bon" 
                                        class="btn btn-info btn-sm" wire:click="edit({{ $row->id }})">
                                            <em class="icon ni ni-edit"></em>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('task-delete')
                                        @if($confirming === $row->id)
                                        <button wire:click="kill({{ $row->id }})" class="btn btn-danger btn-sm">Sur?
                                        </button>
                                        <a href="#" wire:navigate class="badge bg-secondary">
                                            <em class="icon ni ni-cross-circle-fill"></em>
                                        </a>
                                        @else
                                        <button wire:click="confirmDelete({{ $row->id }})" class="btn btn-warning btn-sm">
                                            <em class="icon ni ni-trash"></em>
                                        </button>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    {{-- Should has loading... here before to show this alert --}}
                    <div class="alert alert-icon alert-warning" role="alert"> 
                        <em class="icon ni ni-alert-circle"></em> 
                        <strong>Information</strong>. 
                        {{__('Aucune donnée correspond à ce mois pour l\'instant!')}}
                    </div>
                    @endif 

                    </div>
                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                                {{ $tasks->links() }}
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush