<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-role" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="add-roleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Ajouter')}}</h5>
                <form class="mt-2" wire:ignore>
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
                                @foreach($permissions as $key => $value)
                                <label>
                                    <input type="checkbox" name="selected_permission[]" wire:model="selected_permission" value="{{ $value->id }}" class="name">
                                    {{ $value->name}}
                                </label>    
                                <br>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button wire:click.prevent="save()" wire:loading.attr="disabled"
                                        class="btn btn-primary close-modal" wire:loading.class.remove="btn-primary"
                                        wire:loading.class.add="disabled">
                                        Ajouter <em class="icon ni ni-plus-sm"></em>
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