<div class="container-xl wide-xl">
    <div class="nk-content-body">
        <div class="card">
            <div class="nk-editor">

                <div class="nk-editor-main">
                    <div class="nk-editor-base">
                        <ul class="nav nav-tabs nav-sm nav-tabs-s1 px-3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#AIWriter">Modifier page</a>
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
                                                        @foreach($submenus as $submenu)
                                                        <option value="{{$submenu->id}}">{{$submenu->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        @error('onglet_d') <span class="error text-danger">{{ $message
                                                            }}</span> @enderror
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="title" class="form-label">Titre Page</label>
                                                <div class="form-control-wrap">
                                                    <input id="title" type="text" wire:model="title"
                                                        class="form-control" />
                                                </div>
                                                <div>
                                                    @error('title') <span class="error text-danger">{{ $message
                                                        }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="sub_title" class="form-label">Sous titre</label>
                                                <div class="form-control-wrap">
                                                    <input id="sub_title" type="text" wire:model="sub_title"
                                                        class="form-control" />
                                                </div>
                                                <div>
                                                    @error('sub_title') <span class="error text-danger">{{ $message
                                                        }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="url" class="form-label">URL
                                                    <small>(facultatif)</small></label>
                                                <div class="form-control-wrap">
                                                    <input id="url" type="text" wire:model="url" class="form-control" />
                                                </div>
                                                <div>
                                                    @error('url') <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Descriptions
                                                    <small>(facultatif)</small></label>
                                                <div class="form-control-wrap">
                                                    <textarea cols="30" rows="4" wire:model="description"
                                                        class="form-control">
                                            </textarea>
                                                </div>
                                                <div>
                                                    @error('description') <span class="error text-danger">{{ $message
                                                        }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="file" class="form-label">Images</label>
                                                <div class="form-control-wrap">
                                                    <input id="file" type="file" wire:model="images"
                                                        class="form-control" multiple />
                                                </div>
                                                @error('images') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                           @if ($currentImage)
                                            <div class="current-image">
                                                <p>Current Image:</p>
                                                <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image" width="120" />
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                               <label class="form-label">Pour slide?</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck{{$selected_id}}" wire:model="is_slider"
                                                            @if($is_slider) checked @endif>
                                                        <label class="custom-control-label" for="customCheck{{$selected_id}}">Oui</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Ajouter liste</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck{{$selected_id}}"
                                                            wire:click="showList()">
                                                        <label class="custom-control-label" for="customCheck{{$selected_id}}">Oui</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Publier</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-switch">
                                                        @if ($is_publish)
                                                        <input type="checkbox" class="custom-control-input" checked wire:model="is_publish"
                                                            id="customSwitch{{$selected_id}}">
                                                        <label class="custom-control-label text-success" for="customSwitch{{$selected_id}}">
                                                            Oui
                                                        </label>
                                                        @else
                                                        <input type="checkbox" class="custom-control-input" wire:model="is_publish"
                                                            id="customSwitch{{$selected_id}}">
                                                        <label class="custom-control-label text-success" for="customSwitch{{$selected_id}}">
                                                            Oui
                                                        </label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="row mt-4">
                                        @if ($addList)
                                        <x-listeInput />
                                        @endif
                                        </div>
                                        <div class="col-6">
                                            <button wire:click.prevent="update()" 
                                            wire:loading.attr="disabled" class="btn btn-success close-modal mt-4"
                                                wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
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