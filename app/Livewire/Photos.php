<?php

namespace App\Livewire;

use App\Models\Hotel;
use App\Models\Photo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Photos extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    use WithFileUploads; 
    protected $paginationTheme = 'bootstrap';
    public $page = 10;

    #[Rule(['images.*' => 'image|max:1024'])]
    public $images = [];
    // #[Rule(['required|unique:hotels,id'])]
    public $hotel_id;

    public function render()
    {
        $this->authorize('hotel-add-photo');
        $hotels = Hotel::where('is_active', true)->get();
        $photos = Photo::groupBy(['hotel_id', 'id'])->paginate($this->page);
        return view('livewire.hotels.photos.index', [
            'photos'  => $photos,
            'hotels'  => $hotels
        ]);
    }

    public function save()
    {
        $this->validate([
            'hotel_id' => 'required|unique:hotels,id',
        ], [
            'hotel_id.unique' => 'Cette chambre a déjà une image.',
        ]);

        try {
            $imagePaths = [];

            DB::beginTransaction();

            foreach ($this->images as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }

            $hotel = Hotel::findOrFail($this->hotel_id);

            $photo = new Photo;
            $photo->hotel_id = $this->hotel_id;
            $photo->images = implode(',', $imagePaths);
            $photo->save();

            DB::commit();

            $this->reset();
            session()->flash('success', 'Photos ajoutées avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout des photos.');
        }
    }

    public function delete($id)
    {   
        $delete = Photo::find($id);
        $delete->delete();
    }
}
