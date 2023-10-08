<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des reservations</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a class="btn btn-dim btn-primary btn-sm" href="/toutes-reservations" wire:navigate>
                                <em class="icon ni ni-reload-alt"></em>
                                {{-- <span>Recharger</span> --}}
                            </a>
                        </div>
                    </div>  
                </div>
                <div class="nk-block">

                    @include('livewire.booking.all.liste')

                </div>
            </div>
        </div>
    </div>
</div>

{{-- @include('livewire.booking.edit')
@include('livewire.booking.show') --}}