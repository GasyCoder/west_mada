
<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="show-role" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="show-roleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
            {{-- here is show or view Role Listes --}}
                <h5 class="modal-title"><p>Role:</p></h5>
                   <strong>{{ $name }}</strong>
                   <hr>
               <div class="col-md-12">
                    <div class="form-group">
                        <h5>Permission:</h5>
                        @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                        <span class="badge bg-primary">{{ $v->name }}</span>
                        @endforeach
                        @else
                        <p class="text-danger" wire:ignore>Aucun permissions</p>
                        @endif
                    </div>  
                </div>
                <hr>

            {{-- Here is Form checkbox to edit and update roles listes --}}
               @can('role-edit')
                {{-- <form>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">{{__('Modifier Permissions')}}</label>
                            <div class="checkbox-list">
                               @foreach($permissions as $value)
                                <label class="checkbox-inline">
                                    <input type="checkbox" wire:model="selected_permission" value="{{$value->id}}" {{
                                        in_array($value->id, $selected_permission) ? 'checked' : '' }}
                                        class="name">
                                    {{ $value->name }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                            <li>
                                <button wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-success close-modal"
                                    wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                                    Confirmer <em class="icon ni ni-reload-alt"></em>
                                </button>
                            </li>
                        </ul>
                    </div>
                </form> --}}
                @endcan
            </div>
        </div>
    </div>
</div>
