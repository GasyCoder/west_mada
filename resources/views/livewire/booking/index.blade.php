<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Liste des reservations</h3>
                        </div>
                        @can('booking-checking')
                        <div class="nk-block-head-content">
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#AddBooking">
                                <em class="icon ni ni-plus"></em>
                                <span>Reservation</span>
                            </a>
                            <a class="btn btn-dim btn-primary" href="{{route('dashboard')}}" wire:navigate>
                                <em class="icon ni ni-reload-alt"></em>
                                {{-- <span>Recharger</span> --}}
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="nk-block">
                   
                        @include('livewire.booking.liste')
                    
                </div>
            </div>
        </div>
    </div>
</div>

@include('livewire.booking.add')
@include('livewire.booking.edit')
@include('livewire.booking.show')

{{-- modal delete render this --}}
{{-- @include('livewire.booking.delete') --}}




@push('scripts')

@endpush