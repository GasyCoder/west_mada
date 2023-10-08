<div class="row">
    @if($updateMode)
        @include('livewire.westmada.pages.navbar.liste')
        @include('livewire.westmada.pages.navbar.edit')
    @else
        @include('livewire.westmada.pages.navbar.liste')
        @include('livewire.westmada.pages.navbar.create')
    @endif
</div>