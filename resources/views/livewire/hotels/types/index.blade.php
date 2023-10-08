<div class="row">
    @if($updateMode)
    @include("livewire.hotels.types.liste")
    @include('livewire.hotels.types.edit')
    @else
    @include("livewire.hotels.types.liste")
    @include("livewire.hotels.types.create")
    @endif
</div>