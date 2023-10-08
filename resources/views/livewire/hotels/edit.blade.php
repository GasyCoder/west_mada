
<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit-room" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="edit-roomLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
               <h5 class="modal-title">Modifier Room</h5>
                <x-HotelFormUpdate>
                    {{-- Pass roomtypes to the HotelForm component --}}
                    @slot('roomtypes', $roomtypes)
                    {{-- Pass includes to the HotelForm component --}}
                    @slot('includes', $includes)
                    @slot('is_active', $is_active)
                    @slot('selected_id', $selected_id)
                    {{-- @slot('_instance', $_instance) --}}
                </x-HotelFormUpdate>
            </div>
        </div>
    </div>
</div>