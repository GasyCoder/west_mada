<div class="container-xl wide-xl">
    <div class="nk-content-body">
        <div class="card">
            <div class="card-inner">
                <ul class="nav nav-tabs nav-sm nav-tabs-s1 px-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#AIWriter">Ajouter page</a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane fade show active" id="AIWriter">
                        <form class="px-3 py-3">
                            <div class="row gy-4 gx-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Titre Service</label>
                                        <div class="form-control-wrap">
                                            <input id="name" type="text" wire:model="name" class="form-control" />
                                        </div>
                                        <div>
                                            @error('name') <span class="error text-danger">{{ $message }}</span>
                                            @enderror
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
                                        <label class="form-label">Descriptions <small>(facultatif)</small></label>
                                        <div class="form-control-wrap">
                                            <textarea cols="30" rows="10" wire:model="contenus" class="form-control">
                                            </textarea>
                                        </div>
                                        <div>
                                            @error('contenus') <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                        x-on:livewire-upload-finish="uploading = true" x-on:livewire-upload-error="uploading = true"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group"> 
                                            <label class="form-label" for="customFileLabel">Ajouter image</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file"> 
                                                    <input type="file" wire:model="images"> 
                                                </div>
                                            </div>
                                        </div>
                                {{-- Preview upload --}}
                                @if ($images)
                                    <img src="{{ $images->temporaryUrl() }}" height="120">
                                @endif
                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Publier</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    wire:model="is_active" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Oui</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                <div wire:loading wire:target="save">
                                    <button disabled class="btn btn-primary">
                                        <i class="spinner-border spinner-border-sm" role="status"></i>
                                        Enregistrement en cours...
                                    </button>
                                </div>
                                <div class="col-6" wire:loading.remove wire:target="save">
                                    <button wire:click.prevent="save()" wire:loading.attr="disabled"
                                        class="btn btn-primary close-modal mt-4">
                                        Ajouter <em class="icon ni ni-plus-sm"></em>
                                    </button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>