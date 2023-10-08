<div>

    <div class="row">
        @if($add)
        @include("livewire.magasins.stocks.liste")
        @include('livewire.magasins.stocks.edit')
        @else
        @include("livewire.magasins.stocks.liste")
        @include("livewire.magasins.stocks.create")
        @endif
    </div>

    
</div>