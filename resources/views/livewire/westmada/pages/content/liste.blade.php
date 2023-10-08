<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{__('List des contenus')}}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{__('Voici les différentes contenus.')}}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <div wire:loading wire:target="create">
                            <button disabled class="btn btn-primary">
                                <i class="spinner-border spinner-border-sm" role="status"></i>
                                 Patientez...
                            </button>
                        </div>
                        <button wire:click.prevent="create()" wire:loading.remove wire:target="create" class="btn btn-primary">
                            <em class="icon ni ni-plus"></em><span>Ajouter</span>
                        </button>
                    </li>
                    
                    <li class="nk-block-tools-opt">
                        <a href="/pages-content" wire:navigate class="btn btn-success">
                            <em class="icon ni ni-reload-alt"></em>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{-- @include('livewire.westmada.pages.content.create')
    @include('livewire.westmada.pages.content.edit') --}}
    <div class="nk-block">
        <div class="card">
            <table class="table">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col">
                            <h6 class="overline-title">#</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">Titre</h6>
                        </th>
                        <th class="nk-tb-col tb-col-sm">
                            <h6 class="overline-title">Onglet</h6>
                        </th>
                        <th class="nk-tb-col tb-col-md">
                            <h6 class="overline-title">Status</h6>
                        </th>
                        <th></th>
                        <th class="nk-tb-col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contents as $key => $page)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            <div class="caption-text">
                                {{$key+1}}
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-sm">
                            <span class="text-ellipsis">{{$page->title}}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{$page->onglet->name}}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <div
                                class="badge badge-dim {{$page->is_publish ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                {{$page->is_publish ? 'Publié' : 'Non publié'}}
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <div class="badge badge-dim {{$page->is_slider ? 'bg-primary' : 'bg-danger' }} rounded-pill">
                                {{$page->is_slider ? 'Slider' : 'Non slider'}}
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-end">
                            <div wire:loading wire:target="edit({{ $page->id }})">
                                <button disabled class="btn btn-success">
                                    <i class="spinner-border spinner-border-sm" role="status"></i>
                                    Patientez...
                                </button>
                            </div>
                            <button class="btn btn-sm btn-primary"
                                wire:click="edit({{ $page->id }})" wire:loading.remove wire:target="edit({{ $page->id }})">
                                <em class="icon ni ni-edit"></em>
                                <span>Modifier</span>
                            </button>
                            @if($confirming === $page->id)
                            <button class="btn btn-sm btn-danger" wire:click="kill({{ $page->id }})"
                                class="text-danger">
                                <em class="icon ni ni-trash"></em>
                                <span>Sur...?</span>
                            </button>
                            @else
                            <div wire:loading wire:target="confirmDelete({{ $page->id }})">
                                <button disabled class="btn btn-danger">
                                    <i class="spinner-border spinner-border-sm" role="status"></i>
                                    Patientez...
                                </button>
                            </div>
                            <button class="btn btn-sm btn-secondary" wire:click="confirmDelete({{ $page->id }})"
                                wire:loading.remove wire:target="confirmDelete({{ $page->id }})">
                                <em class="icon ni ni-delete-fill text-danger"></em>
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
            {{$contents->links()}}
        </div>
    </div>
</div>