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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">Onglets</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" wire:model="onglet_id">
                                                <option value="1">--Choisir--</option>
                                                @foreach($onglets as $onglet)
                                                <option value="{{$onglet->id}}">{{$onglet->name}}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('onglet_d') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Titre Page</label>
                                        <div class="form-control-wrap">
                                            <input id="title" type="text" wire:model="title" class="form-control"/>
                                        </div>
                                        <div>
                                            @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sub_title" class="form-label">Sous titre</label>
                                        <div class="form-control-wrap">
                                            <textarea id="sub_title" wire:model="sub_title" id="" cols="3" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div>
                                            @error('sub_title') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="url" class="form-label">URL <small>(facultatif)</small></label>
                                        <div class="form-control-wrap">
                                            <input id="url" type="text" wire:model="url" class="form-control" />
                                        </div>
                                        <div>
                                            @error('url') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Descriptions <small>(facultatif)</small></label>
                                        <div class="form-control-wrap">
                                            <textarea cols="30" rows="4" wire:model="description" class="form-control">
                                            </textarea>
                                        </div>
                                        <div>
                                            @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                        x-on:livewire-upload-finish="uploading = true" x-on:livewire-upload-error="uploading = true"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group"> 
                                            <label class="form-label" for="customFileLabel">Ajouter image</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file"> 
                                                    <input type="file" wire:model="images" multiple> 
                                                </div>
                                            </div>
                                        </div>
                                {{-- Preview upload --}}
                                @if ($images)
                                   @foreach ($images as $image)
                                    <img src="{{ $image->temporaryUrl() }}" height="120">
                                    @endforeach
                                @endif
                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                </div>
                                </div>
                               <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Pour slide?</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                        id="customCheck0" wire:model="is_slider">
                                        <label class="custom-control-label" for="customCheck0">Oui</label>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Ajouter liste</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" wire:click="showList()">
                                                <label class="custom-control-label" for="customCheck1">Oui</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Publier</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" wire:model="is_publish" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Oui</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    @if ($addList)
                                   <x-listeInput />
                                    @endif
                                </div>
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
                        </form>
                    </div>
                    </div>
                </div>
        </div>
    </div>
</div>

