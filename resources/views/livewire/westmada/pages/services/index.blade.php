<div class="row">
    @if($updateMode)
    @include('livewire.westmada.pages.services.edit')
    @elseif($add)
    @include('livewire.westmada.pages.services.create')
    @else
    @include('livewire.westmada.pages.services.liste')
    @endif
</div>