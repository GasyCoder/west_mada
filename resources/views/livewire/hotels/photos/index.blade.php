<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between g-3">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{__('List des photos')}}</h3>
                        <div class="nk-block-des text-soft">
                            <p>{{__('Voici nos différentes photos des chambres.')}}</p>
                        </div>
                    </div>
                    @can('hotel-add-photo')
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a data-bs-toggle="modal" href="#add-photo" class="btn btn-primary">
                                    <em class="icon ni ni-plus"></em><span>Ajouter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endcan
                </div>
            </div>
            @include('livewire.hotels.photos.create')
            {{-- @include('livewire.hotels.photos.edit') --}}
            <div class="nk-block">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        {{-- <div class="card-inner position-relative card-tools-toggle">
                            <div class="card-tools col-md-12">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-search"></em>
                                    </div>
                                    <input type="text" wire:model.live="search" name="search" class="form-control"
                                        id="search" placeholder="Rechercher...">
                                </div>
                            </div>
                        </div> --}}
                        <div class="p-0">
                           <div class="table-responsive">
                            @foreach ($photos as $key => $photo)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div id="carousel{{ $key }}" class="carousel slide" data-bs-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @php
                                                    $imagePaths = explode(',', $photo->images);
                                                    $numImages = count($imagePaths);
                                                    @endphp
                                                    @for ($i = 0; $i < $numImages; $i++) <li data-bs-target="#carousel{{ $key }}"
                                                        data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}">
                                                        </li>
                                                    @endfor
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($imagePaths as $index => $imagePath)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . trim($imagePath)) }}" class="d-block w-100" alt="Image">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carousel{{ $key }}" role="button" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel{{ $key }}" role="button" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h5>Chambre numéro: <span class="text-primary">{{ $photo->hotel->room_number }}</span></h5>
                                            <p>Type de chambre: {{ $photo->hotel->roomType->name }}</p>
                                            <p>Nombre d'images: {{ $numImages }}</p>
                                            <div class="">
                                                <button class="btn btn-sm btn-success"
                                                wire:click="edit({{ $photo->id }})">
                                                <em class="icon ni ni-edit-fill"></em> Modifier
                                                </button>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément?') || event.stopImmediatePropagation()"
                                                    wire:click="delete({{ $photo->id }})">
                                                    <em class="icon ni ni-trash-fill"></em> Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        </div>
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    {{ $photos->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>