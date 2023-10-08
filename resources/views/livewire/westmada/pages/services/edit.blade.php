<div class="container-xl wide-xl">
    <div class="nk-content-body">
        <div class="card">
            <div class="nk-editor">
                <div class="nk-editor-main">
                    <div class="nk-editor-base">
                        <ul class="nav nav-tabs nav-sm nav-tabs-s1 px-3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#AIWriter">Modifier service</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane fade show active" id="AIWriter">
                                <form class="px-3 py-3">
                                    <div class="row gy-4 gx-4">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Nom de service</label>
                                                <div class="form-control-wrap">
                                                    <input id="name" type="text" wire:model="name"
                                                        class="form-control" />
                                                </div>
                                                <div>
                                                    @error('name') <span class="error text-danger">{{ $message
                                                        }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="resume" class="form-label">Résumer</label>
                                                <div class="form-control-wrap">
                                                    <textarea id="resume" wire:model="resume" id="" cols="3" rows="3" class="form-control"></textarea>
                                                </div>
                                                <div>
                                                    @error('resume') <span class="error text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Descriptions
                                                    <small>(facultatif)</small></label>
                                                <div class="form-control-wrap">
                                                    <textarea cols="30" rows="4" wire:model="contenus"
                                                        class="form-control">
                                            </textarea>
                                                </div>
                                                <div>
                                                    @error('contenus') <span class="error text-danger">{{ $message
                                                        }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="file" class="form-label">Images</label>
                                                <div class="form-control-wrap">
                                                    <input id="file" type="file" wire:model="images"
                                                        class="form-control"/>
                                                </div>
                                                @error('images') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($currentImage)
                                            <div class="current-image">
                                                <p>Current Image:</p>
                                                <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image"
                                                    width="120" />
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Publier</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-switch">
                                                        @if ($is_active)
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            wire:model="is_active" id="customSwitch{{$selected_id}}">
                                                        <label class="custom-control-label text-success"
                                                            for="customSwitch{{$selected_id}}">
                                                            Activer
                                                        </label>
                                                        @else
                                                        <input type="checkbox" class="custom-control-input"
                                                            wire:model="is_active" id="customSwitch{{$selected_id}}">
                                                        <label class="custom-control-label text-success"
                                                            for="customSwitch{{$selected_id}}">
                                                            Activer
                                                        </label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <button wire:click.prevent="update()" wire:loading.attr="disabled"
                                                class="btn btn-success close-modal mt-4"
                                                wire:loading.class.remove="btn-primary"
                                                wire:loading.class.add="disabled">
                                                Mettre à jour <em class="icon ni ni-reload-alt"></em>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>