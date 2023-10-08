<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit-bon" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           <a href="#" class="close" data-bs-dismiss="modal">
            <em class="icon ni ni-cross-sm"></em>
        </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Modifier')}}</h5>
                <form class="mt-2">
                    <div class="row g-gs">  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Type:</label>
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" wire:model="type" value="entree"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Entrée</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" wire:model="type" value="sortie"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Sortie</label>
                                    </div>
                                </div>
                                <div>
                                    @error('type') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">{{__('Catégorie')}}</label>
                                <div class="form-control-wrap">
                                    <select wire:model="category_id" class="form-select"
                                        wire:change="selectedCategoryChanged($event.target.value)">
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
                                <label class="form-label">{{__('Produits')}}</label>
                                <div class="form-control-wrap">
                                    <select wire:model="stock_id" class="form-select"
                                        wire:change="selectedStockChanged($event.target.value)">
                                        <option value="">{{__('--Choisir--')}}</option>
                                        @foreach ($stocks as $stock)
                                        <option value="{{$stock->id}}">{{$stock->name}}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        @error('stock_id') <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <span wire:loading wire:target="selectedCategoryChanged"
                                    class="spinner-border spinner-border-sm"></span>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="form-label" for="bed-no-add">{{__('Quantité')}}</label>
                                <input type="number" wire:model="quantity" class="form-control" id="bed-no-add"
                                    placeholder="{{__('Quantité')}}">
                                <div>
                                    @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="bed-no-add">{{__('Unité')}}</label>
                                <input type="text" wire:model="unit" class="form-control" id="bed-no-add"
                                    placeholder="{{__('kg, l, g')}}">
                                <div>
                                    @error('unit') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" wire:ignore>
                            <div class="form-group">
                                <label class="form-label">{{__('Message')}} <small>(facultatif)</small></label>
                                <textarea class="form-control" wire:model="description" id="description" cols="3"
                                    rows="2"></textarea>
                            </div>
                        </div>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-success close-modal"
                                        wire:loading.class.remove="btn-primary" wire:loading.class.add="disabled">
                                        Mettre à jour <em class="icon ni ni-reload-alt"></em>
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

