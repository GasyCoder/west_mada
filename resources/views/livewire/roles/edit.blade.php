{{-- <form method="POST" action="{{ route('roles.update', $role->id) }}">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" value="{{ $role->name }}" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br>
                @foreach($permission as $value)
                <label>
                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name" {{
                        in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                    {{ $value->name }}
                </label>
                <br>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form> --}}

<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit-role" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="edit-roleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Modifier')}}</h5>
                <form class="mt-2">
                    <div class="row g-gs">
                        <div class="mb-3">
                            <label class="form-label" for="name">Nom</label>
                            <input type="text" class="form-control" id="name" wire:model="name"
                                placeholder="Saisir le role">
                            <div>
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Permission:</strong>    
                                <br>
                                @foreach($permissions as $permission)
                                <div class="form-check">
                                   <input class="form-check-input" type="checkbox" name="selected_permission[]" id="selected_permission_{{ $permission->id }}"
                                    value="{{ $permission->id }}" wire:model="selected_permission">
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-success close-modal"
                                        wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                                        Mettre à jour <em class="icon ni ni-reload-alt"></em>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>