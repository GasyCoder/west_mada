<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-photo" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="add-photoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Ajouter photo')}}</h5>
                <form wire:submit="save" class="mt-4">
                    <div x-data="{ uploading: false, progress: 0 }" 
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = true" 
                        x-on:livewire-upload-error="uploading = true"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                    {{-- Preview upload --}}
                    @if ($images)
                        @foreach ($images as $image)
                        <img src="{{ $image->temporaryUrl() }}" width="80">
                        @endforeach
                    @endif
                    <!-- Progress Bar -->
                    <div x-show="uploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>    
                    <div class="mt-4">
                        <input type="file" wire:model="images" multiple class="form-control">
                        @error('images.*') <span class="texte-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Publier</label>
                            <div class="form-control-wrap">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" wire:model="is_active" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Oui</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 btn btn-primary">
                        <em class="icon ni ni-save-fill"></em> Enregistrer</button>
                   </div>
                   <br>
                    <x-alertSession/>
                </form>
            </div>
        </div>
    </div>
</div>