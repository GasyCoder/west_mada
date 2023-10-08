<div class="col-md-8 col-xxl-3">
    <div class="card card-bordered card-full">
        <div class="card-inner">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title mb-4">{{__('Listes')}}</h3>
            </div>
            <div class="form-control-wrap">
                <div class="form-icon form-icon-right">
                    <em class="icon ni ni-search"></em>
                </div>
                <input type="text" wire:model.live="search" name="search" class="form-control" id="search"
                    placeholder="Rechercher...">
            </div>
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$service->name}}</td>
                            <td>
                                @if($service->is_active == true)
                                <span class="badge bg-success">active</span>
                                @else
                                <span class="badge bg-danger">desactivé</span>
                                @endif
                            </td>
                            <td>
                                @can('type-edit')
                                <button class="btn btn-sm btn-primary" wire:click="edit({{$service->id}})">
                                    <em class="icon ni ni-edit"></em>
                                </button>
                                @endcan
                                @can('type-delete')
                                <button onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément?') || event.stopImmediatePropagation()" 
                                class="btn btn-sm btn-danger" wire:click="delete({{$service->id}})">
                                <em class="icon ni ni-trash"></em>
                                </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-1">
                {{$services->links()}}
            </div>
        </div>
    </div>
</div>