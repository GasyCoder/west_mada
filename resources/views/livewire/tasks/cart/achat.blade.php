<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="cart-bon" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="cartLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" wire:click="closeModal">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                <!-- Loading Indicator (shown when modal is loading) -->
                <div class="d-flex justify-content-center align-items-center">
                    <div wire:loading wire:target="openCart()">
                        <div class="spinner-border text-primary spinner-border-lg" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>    
                <div class="container-fluid" wire:loading.remove>
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @if(count($checkedProducts) > 0)
                            <div class="nk-block">
                                <div class="invoice">
                                    <div class="invoice-action">
                                        <button class="btn btn-icon btn-sm btn-white btn-dim btn-outline-danger" href="#"
                                            wire:click.prevent="generatePDF()">
                                            <em class="icon ni ni-file-pdf"></em>
                                        </button>
                                    </div>
                                    <div class="invoice-wrap">
                                        <div class="invoice-head">
                                            <div class="">
                                                <div class="">
                                                    <h6 class="title">
                                                        <em class="icon ni ni-file"></em> BON D'ACHAT
                                                    </h6>
                                                    <ul class="list-plain">
                                                        <li class="invoice-id"><span>Réf</span>:<span> {{$getReference}}</span></li>
                                                        <li class="invoice-date"><span>Date</span>:<span>
                                                                {{$getCreatedAt?->format('d-M-Y') ??
                                                                ''}}</span></li>
                                                        <li class="invoice-date"><span>Type</span>:<span class="fw-bold">
                                                                {{$getType}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="">
                                                <h5 class="title">WEST MADA</h5>
                                                <ul class="">
                                                    <li class=""><span>Tél</span>:<span> 032556620</span></li>
                                                    <li class=""><span>@</span>:<span> contact@westmada.mg</span></li>
                                                    <li class=""><span>Adresse</span>:<span class=""> Mahajanga - 401</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="invoice-bills">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th class="w-60">Désignation</th>
                                                            <th>Qté</th>
                                                            <th>Reste</th>
                                                            <th>Prix U</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $prixTotal = 0;
                                                        @endphp
                                                        @foreach($checkedProducts as $product)
                                                        @php
                                                        $resteQte = $product->stock->max_quantity - $product->quantity;
                                                        $enterQte = $resteQte + $product->quantity;
                                                        $prixUnity = $product->stock->price_u;
                                                        $prixTotal += $prixUnity;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $product->stock->name }}</td>
                                                            <td>
                                                                @if($product->type === 'entree')
                                                                <span class="text-success">+{{ $product->quantity }}</span>
                                                                @else
                                                                <span class="text-danger">-{{ $product->quantity }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($product->type === 'entree')
                                                                {{ $enterQte }}/<span class="text-muted">{{
                                                                    $product->stock->max_quantity }}</span>
                                                                @else
                                                                {{ $resteQte }}/<span class="text-muted">{{
                                                                    $product->stock->max_quantity }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $prixUnity }} Ar</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3"><small>{{ $product->description }}</small></td>
                                                            <td colspan="1"></td>
                                                            <td>
                                                                <span class="fw-bold">Total :</span>
                                                                <span class="fw-bold">{{ number_format($prixTotal, 2) }}Ar</span>
                                                                <br>
                                                                <p class="nk-notes ff-italic fs-12px text-muted">La somme est arrêtée : {{
                                                                    $TotalWords }} ariary</p>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div class="nk-notes ff-italic fs-12px text-soft"> Le responsable de l'entreprise.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-danger d-flex justify-content-center align-items-center">Aucun produit sélectionné.</p>
                            @endif
                        </div>
                    </div>  
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('showCartModal', function (selectedProducts) {
                $('#cart-bon').modal('show');
            });
            // Utilisez JavaScript pour fermer la modal view
            $('#cart-bon').on('hidden.bs.modal', function () {
                @this.call('closeModal');
            });
        });
    </script>
@endpush