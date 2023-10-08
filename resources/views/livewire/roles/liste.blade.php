<div class="col-md-12 col-xxl-3">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{__('Gestion des rôles')}}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{__('Voici nos différentes rôles.')}}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    @can('role-create')
                    <li class="nk-block-tools-opt">
                        <a data-bs-toggle="modal" href="#add-role" class="btn btn-primary">
                            <em class="icon ni ni-plus"></em><span> Ajouter</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
    
    @include("livewire.roles.create")
    @include("livewire.roles.show")
    @include("livewire.roles.edit")

        <table class="table">
            <thead class="tb-odr-head">
                <tr class="tb-odr-item">
                    <th class="tb-odr-info">
                        <span class="tb-odr-id">#</span>
                    </th>
                    <th class="tb-odr-amount">
                        <span class="tb-odr-date d-none d-md-inline-block">Type des rôles</span>
                    </th>
                    <th class="tb-odr-action">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @foreach ($roles as $key => $role)
                <tr class="tb-odr-item">
                    <td class="tb-odr-info">
                        <span class="tb-odr-id">
                            <a href="#">{{ $key+1 }}</a>
                        </span>
                    </td>
                    <td class="tb-odr-amount">
                        <span class="tb-odr-total">
                            <span class="amount">{{ $role->name }}</span>
                        </span>
                    </td>
                    <td class="tb-odr-action">
                        <div class="tb-odr-btns d-none d-md-inline">
                            <a data-bs-toggle="modal" href="#show-role" wire:click="show({{ $role->id }})"
                                class="btn btn-sm btn-primary">
                                <em class="icon ni ni-eye"></em> Voir
                            </a>
                        </div>
                        <div class="tb-odr-btns d-none d-md-inline">
                            <a data-bs-toggle="modal" href="#edit-role" wire:click="edit({{ $role->id }})"
                                class="btn btn-sm btn-success">
                                <em class="icon ni ni-edit"></em>Edit
                            </a>
                        </div>
                        @can('role-delete')
                        <div class="tb-odr-btns d-none d-md-inline">
                            <button wire:click="delete({{ $role->id }})" class="btn btn-sm btn-danger">
                                <em class="icon ni ni-trash"></em>Delete
                            </button>
                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
</div>