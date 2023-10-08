<div class="row">
    @if($add)
        @include("livewire.magasins.category.liste")
        @include('livewire.magasins.category.edit')
    @else
        @include("livewire.magasins.category.liste")
        @include("livewire.magasins.category.add")  
    @endif
</div>