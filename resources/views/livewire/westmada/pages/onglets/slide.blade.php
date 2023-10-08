<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{__('List des onglets en Slide')}}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{__('Voici les différentes onglets.')}}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <a data-bs-toggle="modal" href="#add-slide" class="btn btn-primary">
                            <em class="icon ni ni-plus"></em><span>Ajouter</span>
                        </a>
                    </li>
                    <li class="nk-block-tools-opt">
                        <a href="/sliders" wire:navigate class="btn btn-success">
                            <em class="icon ni ni-reload-alt"></em>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('livewire.westmada.pages.onglets.edit')
    @include('livewire.westmada.pages.onglets.for-slide')
    <div class="nk-block">
        <div class="card">
            <table class="table">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col">
                            <h6 class="overline-title">Ordre</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">Nom</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">Navbar Menu</h6>
                        </th>
                        <th class="nk-tb-col tb-col-md">
                            <h6 class="overline-title">Status</h6>
                        </th>
                        <th class="nk-tb-col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($onglets as $key => $onglet)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            <div class="caption-text">
                                {{$key+1}}
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-sm">
                            <span>{{$onglet->name}}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{$onglet->navbar->name}}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <div
                                class="badge badge-dim {{$onglet->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                {{$onglet->is_active ? 'Active' : 'Inactive'}}
                            </div>
                        </td>

                        <td class="nk-tb-col tb-col-end">
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" href="#edit-onglet"
                                wire:click="edit({{ $onglet->id }})">
                                <em class="icon ni ni-edit"></em>
                                <span>Modifier</span>
                            </button>
                            @if($confirming === $onglet->id)
                            <button class="btn btn-sm btn-danger" wire:click="kill({{ $onglet->id }})"
                                class="text-danger">
                                <em class="icon ni ni-trash"></em>
                                <span>Sur...?</span>
                            </button>
                            @else
                            <button class="btn btn-sm btn-secondary" wire:click="confirmDelete({{ $onglet->id }})">
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
    </div>
</div>