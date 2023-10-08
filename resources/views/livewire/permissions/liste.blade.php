<div class="col-md12 col-xxl-3">
    <div class="card card-bordered card-full">
        <div class="card-inner">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{__('Gestion des permissions')}}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{__('Liste des Permissions.')}}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    @can('role-create')
                    <li class="nk-block-tools-opt">
                        <a data-bs-toggle="modal" href="#add-permi" class="btn btn-primary">
                            <em class="icon ni ni-plus"></em><span> Ajouter</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                   <tr class="tb-odr-item">
                        <th class="">#</th>
                        <th class="text-center">
                            <span class="text-center">Type des rôles</span>
                        </th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($permissions as $key => $permission)
                    <tr class="tb-odr-item">
                        <td class="tb-odr-info">
                            <span class="tb-odr-id">
                                <a href="#">{{ $key+1 }}</a>
                            </span>
                        </td>
                        <td class="tb-odr-amount text-center">
                            <span class="tb-odr-total">
                                <span class="amount"><mark>{{ $permission->name }}</mark></span>
                            </span>
                        </td>
                        <td class="tb-odr-action text-center">
                            <div class="tb-odr-btns d-none d-md-inline">
                                <a data-bs-toggle="modal" href="#edit-permi" wire:click="edit({{ $permission->id }})"
                                    class="btn btn-sm btn-success">
                                    <em class="icon ni ni-edit"></em>Edit
                                </a>
                            </div>
                            @can('role-delete')
                            {{-- <div class="tb-odr-btns d-none d-md-inline">
                                <button wire:click="delete({{ $permission->id }})" class="btn btn-sm btn-danger">
                                    <em class="icon ni ni-trash"></em>Delete
                                </button>
                            </div> --}}
                            @if($confirmingDelete === $permission->id)
                            <div class="tb-odr-btns d-none d-md-inline">
                                <a href="#!" wire:click="kill({{$permission->id}})" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sur...?" data-bs-original-title="Sur...?">
                                    <em class="icon ni ni-trash"></em> Confirmer
                                </a>
                                @else
                                <a href="#!" wire:click="confirmDelete({{$permission->id}})" class="text-danger btn btn-sm btn-warning"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Supprimer" data-bs-original-title="Supprimer">
                                    <em class="icon ni ni-delete-fill"></em> Supprimer
                                </a>
                            </div>
                            @endif
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="mt-1">
               {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>
@include("livewire.permissions.create")
@include("livewire.permissions.show")
@include("livewire.permissions.edit")