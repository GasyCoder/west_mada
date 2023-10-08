<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Reservations en corbeille</h3>
                        </div>
                        @can('booking-checking')
                        <div class="nk-block-head-content">
                            <a class="btn btn-dim btn-primary btn-sm" href="/corbeille-reservations" wire:navigate>
                                <em class="icon ni ni-reload-alt"></em>
                                {{-- <span>Recharger</span> --}}
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="nk-block">

                    @include('livewire.booking.trash.liste')

                </div>
            </div>
        </div>
    </div>
</div>