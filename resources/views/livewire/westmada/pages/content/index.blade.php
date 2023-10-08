<div class="row">
    @if($updateMode)
        @include('livewire.westmada.pages.content.edit')
    @elseif($add)
        @include('livewire.westmada.pages.content.create')
    @else
        @include('livewire.westmada.pages.content.liste')
    @endif
</div>

@push("scripts")
    <script>

    </script>
@endpush