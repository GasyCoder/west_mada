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
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select id="hotel_id" wire:model="hotel_id" 
                                    class="form-select"
                                    data-search="on">
                                    <option value="">--Chambre--</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{$hotel->id}}">
                                            N°{{$hotel->room_number}} - {{$hotel->roomType->name}} 
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('hotel_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
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