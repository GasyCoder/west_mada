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
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Service</th>
            {{-- <th>Email</th> --}}
            <th>Roles</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $key => $user)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $user->name }}</td>

            <td>
                @foreach ($user->services as $service)
                {{ $service->title }}
                @if (!$loop->last)
                ,
                <!-- Pour ajouter une virgule entre les titres -->
                @endif
                @endforeach
            </td>

            {{-- <td>{{ $user->email }}</td> --}}
            <td>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $role)
                <label class="text-success">{{ $role }}</label>
                @endforeach
                @endif
            </td>
            <td>
                @if($user->is_active == true)
                <button class="btn btn-success btn-sm" wire:click="enable({{$user->id}})">
                    <em class="icon ni ni-toggle-on"></em>
                </button>
                @else
                <button class="btn btn-secondary btn-sm" wire:click="disable({{$user->id}})">
                    <em class="icon ni ni-toggle-off text-danger"></em>
                </button>
                @endif
                @can('user-edit')
                <a data-bs-toggle="modal" href="#edit-user" class="btn btn-primary btn-sm"
                    wire:click="edit({{$user->id}})">
                    <em class="icon ni ni-edit"></em>
                </a>
                @endcan
                @if($confirming===$user->id)
                <button wire:click="kill({{ $user->id }})" class="btn btn-danger btn-sm">Sur?
                </button>
                <a href="{{route('users')}}" wire:navigate class="badge bg-secondary"><em
                        class="icon ni ni-cross-circle-fill"></em></a>
                @else
                <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-warning btn-sm">
                    <em class="icon ni ni-trash"></em></button>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    </div>
    <div class="mt-1">
        {{$users->links()}}
    </div>
</div>
</div>
</div>