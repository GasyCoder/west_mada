<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add-room" data-bs-backdrop="static" data-bs-keyboard="false"
aria-labelledby="add-roomLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">{{__('Ajouter une chambre')}}</h5>
                 <x-HotelFormCreate>
                    {{-- Pass roomtypes to the HotelForm component --}}
                    @slot('roomtypes', $roomtypes)
                    {{-- Pass includes to the HotelForm component --}}
                    @slot('includes', $includes)
                </x-HotelFormCreate>
            </div>
        </div>
    </div>
</div>