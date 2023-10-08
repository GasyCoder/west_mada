<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-period" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="add-periodLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Ajouter')}}</h5>
                <form class="mt-2">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{__('Mois')}}</label>
                                <div class="form-control-wrap">
                                    <select wire:model="mois" class="form-select">
                                        <option value="">{{__('--Choisir--')}}</option>
                                        <option value="Janvier">Janvier</option>
                                        <option value="Février">Février</option>
                                        <option value="Mars">Mars</option>
                                        <option value="Avril">Avril</option>
                                        <option value="Mai">Mai</option>
                                        <option value="Juin">Juin</option>
                                        <option value="Juillet">Juillet</option>
                                        <option value="Août">Août</option>
                                        <option value="Septembre">Septembre</option>
                                        <option value="Octobre">Octobre</option>
                                        <option value="Novembre">Novembre</option>
                                        <option value="Décembre">Décembre</option>
                                    </select>
                                    <div>
                                        @error('mois') <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" wire:model="is_active" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Activer</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button wire:click.prperiod="save()" wire:loading.attr="disabled"
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
