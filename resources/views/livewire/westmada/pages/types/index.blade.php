<div class="row">
    @if($updateMode)
    @include('livewire.westmada.pages.types.edit')
    @elseif($add)
    @include('livewire.westmada.pages.types.create')
    @else
    @include('livewire.westmada.pages.types.liste')
    @endif
</div>