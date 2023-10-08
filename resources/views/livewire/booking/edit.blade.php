<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="EditBooking" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="EditBookingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modification de reservation</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter">
                    <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="client_name">Nom Client</label>
                                    <div class="form-control-wrap">
                                        <input type="text" wire:model.live="client_name" readonly class="form-control" id="client_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Date de début</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input wire:model.live="date_debut" type="date" class="form-control"
                                        placeholder="Date début" min="{{ now()->format('Y-m-d') }}">
                                    <div>
                                        @error('date_debut') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Date de fin</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input wire:model.live="date_fin" type="date" class="form-control"
                                        placeholder="Date fin" min="{{ now()->format('Y-m-d') }}"
                                        wire:click.live="changed()">
                                    <div>
                                        @error('date_fin') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Navigation Buttons -->
                            <div class="col-12">
                                <ul class="d-flex justify-content-between gx-4 mt-1">
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

@push("scripts")

@endpush