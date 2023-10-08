<?php

namespace App\Livewire\WestMada;

use App\Models\Storie;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Stories extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $page = 10;

    #[Rule(['images.*' => 'image|max:1024'])]
    public $images = [];
    public $is_active;

    
    public function render()
    {
        $stories = Storie::orderby('id', 'asc')->paginate($this->page);
        return view('livewire.westmada.pages.story.liste', [
            'stories'  => $stories
        ])->layout('components.westmada.panel');
    }


    public function save()
    {
        $this->validate();

        try {
            $imagePaths = [];

            DB::beginTransaction();

            foreach ($this->images as $image) {
                $path = $image->store('story', 'public');
                $imagePaths[] = $path;
            }

            $photo = new Storie;
            $photo->is_active  = $this->is_active ? true : false;
            $photo->images = implode(',', $imagePaths);
            $photo->save();

            DB::commit();

            $this->reset();
            session()->flash('success', 'Story ajoutées avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout des photos.');
        }
    }

}
