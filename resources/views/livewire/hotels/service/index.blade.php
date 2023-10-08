<div class="row">
    @if($updateMode)
        @include("livewire.hotels.service.liste")
        @include('livewire.hotels.service.edit')
    @else
        @include("livewire.hotels.service.liste")
        @include("livewire.hotels.service.create")
    @endif
</div>