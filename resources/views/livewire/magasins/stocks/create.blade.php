<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-stock" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="stockLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">{{__('Ajouter produit de stock')}}</h5>
                    <form class="mt-2">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{__('Service')}}</label>
                                    <div class="form-control-wrap">
                                        <select wire:model="service_id" class="form-select">
                                            <option value="">{{__('--Choisir--')}}</option>
                                            @foreach ($services as $row)
                                            <option value="{{$row->id}}">{{$row->title}}</option>
                                            @endforeach 
                                        </select>
                                        <div>
                                            @error('service_id') <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{__('Catégorie')}}</label>
                                    <div class="form-control-wrap">
                                        <select wire:model="category_id" class="form-select">
                                            <option value="">{{__('--Choisir--')}}</option>
                                            @foreach ($categories as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            @error('category_id') <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="room-no-add">{{__('Nom de produit')}}</label>
                                    <input type="text" wire:model="name" class="form-control" id="room-no-add"
                                        placeholder="{{__('Nom de produit')}}">
                                    <div>
                                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="rent-add">Prix U</label>
                                    <input type="number" wire:model="price_u" class="form-control" id="rent-add"
                                        placeholder="0.00 Ariary">
                                    <div>
                                        @error('price_u') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">{{__('Quantité Max')}}</label>
                                    <input type="number" wire:model="max_quantity" class="form-control" id="bed-no-add"
                                        placeholder="{{__('Quantité Unitiale')}}">
                                    <div>
                                        @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" wire:model="stock_quantity">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="bed-no-add">{{__('Unité de stock')}}</label>
                                    <input type="text" wire:model="unite_stock" class="form-control" id="bed-no-add"
                                        placeholder="{{__('kg, l, g')}}">
                                    <div>
                                        @error('unite_stock') <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" wire:ignore>
                                <div class="form-group">
                                    <label class="form-label">{{__('Description')}} <small>(facultatif)</small></label>
                                    <textarea class="form-control" wire:model="description" id="description" cols="3"
                                        rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" wire:model="is_active"
                                            id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Activer</label>
                                    </div>
                                </div>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-success alert-icon alert-dismissible" role="alert">
                                <em class="icon ni ni-alert-circle"></em>
                                <strong>Bravo!</strong>.
                                {{ session('status') }}
                                <button class="close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    {{-- <li>
                                        <a href="#" wire.click="cancel()" class="link text-danger"
                                            data-bs-dismiss="modal">Annuler</a>
                                    </li> --}}
                                    <li>
                                        <button wire:click.prevent="save()" wire:loading.attr="disabled"
                                            class="btn btn-primary close-modal" wire:loading.class.remove="btn-primary"
                                            wire:loading.class.add="disabled">
                                            Ajouter <em class="icon ni ni-plus-sm"></em>
                                        </button>
                                        <div wire:loading>
                                            En cours d'enregistrement...
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>