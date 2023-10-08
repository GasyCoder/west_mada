<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-bon" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="bonLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Ajouter')}}</h5>
                <form class="mt-2">
                    <div class="row g-gs">
                       <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Type:</label>
                            <div class="form-control-wrap">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" wire:model="type" value="entree" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Entrée</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" wire:model="type" value="sortie" class="custom-control-input">
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
                                       wire:change="selectedStockChanged($event.target.value)"
                                        multiple>
                                        <option value="">{{__('--Listes--')}}</option>
                                        @foreach ($stocks as $stock)
                                        <option value="{{$stock->id}}" @if(in_array($stock->id, $selectedProducts)) disabled
                                        @endif>{{$stock->name}} 
                                            @if ($stock->stock_quantity <= 0)
                                           <small class="text-danger epuise">(epuisé)</small>
                                            @endif
                                        </option> {{-- When user remove a input quantity the product name return enable --}}
                                        @endforeach
                                    </select>
                                    <div>
                                        @error('stock_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <span wire:loading wire:target="selectedCategoryChanged" class="spinner-border spinner-border-sm"></span>
                            </div>
                        </div>
                        {{-- When user remove a input quantity the product name return enable --}}
                        @foreach ($selectedProducts as $key => $product)
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="form-label" for="quantity-{{$product}}">
                                        {{$loop->iteration}}. {{__('Quantité')}}
                                        ({{$productDetails[$product]['unit']}})
                                    </label>
                                    <input type="number" wire:model="productDetails.{{$product}}.quantity"
                                        wire:keydown="validateQuantity({{$product}})" class="form-control" id="quantity-{{$product}}"
                                        placeholder="{{__('Quantité', ['product' => $product])}}">
                                    <div>
                                        @error('productDetails.' . $product . '.quantity')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="form-label">Fermer</label>
                                    <div class="form-control-wrap">
                                        <button wire:click="removeOption({{$key}})" type="button" class="btn btn-danger btn-sm btn-remove-option">
                                            <em class="icon ni ni-cross-circle-fill"></em> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-sm-12" wire:ignore>
                                <div class="form-group">
                                    <label class="form-label">{{__('Description')}} <small>(facultatif)</small></label>
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
@push('scripts')

@endpush