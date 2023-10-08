<div>
    
@include('livewire.westmada.main.slider', ['slider' => $sliders])

@include('livewire.westmada.main.about', ['slider' => $sliders, 'stories' => $stories])


<div class="container">
    <hr class="m-0">
</div>

@include('livewire.westmada.main.services', ['services' => $services])

{{-- @include('livewire.westmada.main.blog') --}}



</div>
