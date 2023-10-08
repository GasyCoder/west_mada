<div class="col-lg-4">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <h5 class="">{{__('Modifier Employer')}}</h5>
            <form class="mt-2">
                <div class="row g-gs">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="room-no-add">{{__('Nom')}}</label>
                            <input type="text" wire:model="name" class="form-control" id="room-no-add"
                                placeholder="{{__('Nom')}}">
                            <div>
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="room-no-add">{{__('Email')}}</label>
                            <input type="email" wire:model="email" class="form-control" id="room-no-add"
                                placeholder="{{__('Email')}}">
                            <div>
                                @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
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
                            <label class="form-label">{{__('Role')}}</label>
                            <div class="form-control-wrap">
                                <select wire:model="selected_roles" class="form-select">
                                    <option value="">{{__('--Choisir--')}}</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>    
                                    @endforeach
                                </select>
                                <div>
                                    @error('roles') <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
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