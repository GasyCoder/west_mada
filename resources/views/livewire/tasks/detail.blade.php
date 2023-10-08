<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="show-bon" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="showLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block">
                                <div class="invoice">
                                    <div class="invoice-action">
                                        {{-- <a class="btn btn-icon btn-sm btn-white btn-dim btn-outline-danger" 
                                        href="#" target="_blank" wire:click.prevent="generatePDF()">
                                            <em class="icon ni ni-file-pdf"></em>
                                        </a> --}}
                                    </div>
                                    <div class="invoice-wrap">
                                        <div class="invoice-head">
                                            <div class="invoice-contact">
                                                <div class="invoice-contact-info">
                                                    <small class="text-soft fw-medium">
                                                        <em class="icon ni ni-user"></em> {{ $user_id }}
                                                    </small>
                                                    <ul class="list-plain">
                                                        <li><em class="icon ni ni-case"></em><small>Service, Cuisine</small></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="">
                                                <h5 class="title">WEST MADA</h5>
                                                <ul class="list-plain">
                                                    <li class=""><span>Réf</span>:<span>{{ $reference }}</span></li>
                                                    <li class=""><span>Date</span>:<span>{{ optional($created_at)->format('d-M-Y') ?? ''
                                                            }}</span></li>
                                                    <li class=""><span>Type</span>:<span class="fw-bold">{{ $type }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="invoice-bills">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th class="w-150px">Cat</th>
                                                            <th class="w-40">Désignation</th>
                                                            <th>Qté</th>
                                                            <th>Reste</th>
                                                            <th>Prix U</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>{{ $category_id }}</td>
                                                            <td>{{ $stock_name }}</td>
                                                            <td>
                                                                @if($type === 'entree')
                                                                <span class="text-success">+{{ $quantity }}</span>
                                                                @else
                                                                <span class="text-danger">-{{ $quantity }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($type === 'entree')
                                                                {{ $qteRestPlus }}/<span class="text-muted">{{ $stockQuantity }}</span>
                                                                @else
                                                                {{ $qteRestMoins }}/<span class="text-muted">{{ $stockQuantity }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $priceUnity }} Ar</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td colspan="2">Total</td>
                                                            <td>{{ $priceTotal }} Ar</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div class="nk-notes ff-italic fs-12px text-soft">Le responsable de l'entreprise.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        Livewire.on('showDetailModal', function () {
            $('#show-bon').modal('show'); // Show the modal when the event is received
        });
    });
</script>
@endpush