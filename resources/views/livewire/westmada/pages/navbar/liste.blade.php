<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{__('List des menus')}}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{__('Voici les différentes menus.')}}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <a data-bs-toggle="modal" href="#add-menu" class="btn btn-primary">
                            <em class="icon ni ni-plus"></em><span>Ajouter</span>
                        </a>
                    </li>
                    <li class="nk-block-tools-opt">
                        <a href="/navbar" wire:navigate class="btn btn-success">
                           <em class="icon ni ni-reload-alt"></em>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('livewire.westmada.pages.navbar.create')
    @include('livewire.westmada.pages.navbar.edit')
    @include('livewire.westmada.pages.navbar.add-onglet')
    <div class="nk-block">
        <div class="card">
            <table class="table">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col">
                            <h6 class="overline-title">Ordre</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">Menu</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">DropDown</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">Nbre Onglet</h6>
                        </th>
                        <th class="nk-tb-col tb-col-md">
                            <h6 class="overline-title">Status</h6>
                        </th>
                        <th class="nk-tb-col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($menus as $key => $menu)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            <div class="caption-text">
                                {{$key+1}}
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-sm">
                            <span>{{$menu->name}}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <div class="badge badge-dim {{ $menu->dropdown ? 'bg-info' : 'bg-warning' }} rounded-pill">
                                {{ $menu->dropdown ? 'Oui' : 'Non' }}
                            </div>
                        </td>
                        <td>{{$menu->onglets->count()}}</td>
                        <td class="nk-tb-col tb-col-md">
                            <div class="badge badge-dim {{$menu->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                {{$menu->is_active ? 'Active' : 'Inactive'}}
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-end">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" href="#onglet" wire:click="onglet({{ $menu->id }})">
                                <span>Onglet</span>
                                <em class="icon ni ni-plus"></em>
                            </button>
                        </td>
                        <td class="nk-tb-col tb-col-end">
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" href="#edit-menu" wire:click="edit({{ $menu->id }})">
                                <em class="icon ni ni-edit"></em>
                                <span>Modifier</span>
                            </button>
                           @if($confirming === $menu->id)
                            <button class="btn btn-sm btn-danger" wire:click="kill({{ $menu->id }})" class="text-danger">
                                <em class="icon ni ni-trash"></em>
                                <span>Sur...?</span>
                            </button>
                            @else
                            <button class="btn btn-sm btn-secondary" wire:click="confirmDelete({{ $menu->id }})">
                                <em class="icon ni ni-delete-fill"></em>
                                <span>Supprimer</span>
                            </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card p-3">
            {{$menus->links()}}
        </div>
    </div>
</div>