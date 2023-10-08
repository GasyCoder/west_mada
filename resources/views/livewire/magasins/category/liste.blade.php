<div class="col-md-8 col-xxl-3">
    <div class="card card-bordered card-full">
        <div class="card-inner">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title mb-4">{{__('Listes des catégories')}}</h3>
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
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Status</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $categorie)
                        <tr class="tb-tnx-item">
                            <td class="text-center"><span>{{$key+1}}</span></td>
                            <td class="tb-tnx-id">
                                <span>{{$categorie->name}}</span>
                            </td>
                            <td class="tb-col-md text-center">
                                @can('stock_category-is_active')
                                <div class="form-check form-switch custom-control">
                                    @if($categorie->is_active == true)  
                                    <input class="form-check-input" type="checkbox" checked role="switch"
                                        id="{{$categorie->id}}" wire:click="enable({{ $categorie->id }})"
                                        style="cursor:pointer">
                                    <label class="form-check-label" for="{{$categorie->id}}"></label>
                                    @else
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="{{$categorie->id}}" wire:click="disable({{ $categorie->id }})"
                                        style="cursor:pointer">
                                    <label class="form-check-label" for="{{$categorie->id}}"></label>
                                    @endif
                                </div>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('stock_category-edit')
                                <button class="btn btn-sm btn-primary" wire:click="edit({{$categorie->id}})"><em
                                        class="icon ni ni-edit"></em>
                                </button>
                                @endcan
                                @can('stock_category-delete')
                                <button
                                    onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément?') || event.stopImmediatePropagation()"
                                    class="btn btn-sm btn-danger" wire:click="delete({{$categorie->id}})">
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
                {{$categories->links()}}
            </div>
        </div>
    </div>
</div>