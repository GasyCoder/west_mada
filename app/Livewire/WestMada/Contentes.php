<?php

namespace App\Livewire\WestMada;

use App\Models\Content;
use App\Models\Onglet;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Contentes extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['descriptionUpdated'];
    public $page = 10;
    public $confirming;
    public $updateMode, $add, $addList = false;
    public $liste_1, $liste_2, $liste_3, $liste_4 = '';
    public $title, $onglet_id, $description, $is_publish, $sub_title, $url, $selected_id, $is_slider;
    public $images = [];
    // In your Livewire component class
    public $currentImage;
    public $submenus;


    protected $rules = [
        'title' => 'required',
        'sub_title' => 'required|min:4|max:2000',
        'onglet_id' => 'required',
        'description' => 'nullable',
        'url' => 'nullable|url',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file size limit as needed.
    ];

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function mount()
    {
        $this->description = '';
    }

    public function descriptionUpdated($value)
    {
        $this->description = $value;
    }

    public function render()
    {   
        $usedOngletIds = Content::pluck('onglet_id');
        $onglets = Onglet::where('is_active', true)->whereNotIn('id', $usedOngletIds)->get();

        return view('livewire.westmada.pages.content.index', [
            'contents'  => Content::latest()->paginate($this->page),
            'onglets'  => $onglets
        ])
        ->layout('components.westmada.panel');
    }

    public function showList()
    {
        $this->addList = !$this->addList;
    }

    public function create()
    {
        $this->add = true;
    }

    
    public function save()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // Adjust the max file size to your requirements
        ]);

        $imagePaths = [];

        if ($this->images && count($this->images) <= 4) {
            foreach ($this->images as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $imagePaths[] = $image->store('contents', 'public');
                }
            }
        } else {
            $this->addError('images', 'Le nombre maximum d\'images est 4.');
            return;
        }

        Content::create([
            'title'         => $this->title,
            'sub_title'     => $this->sub_title,
            'onglet_id'     => $this->onglet_id,
            'description'   => $this->description,
            'url'           => $this->url,
            'images'        => implode(',', $imagePaths),
            'is_publish'    => $this->is_publish ? false : true,
            'is_slider'     => $this->is_slider ? true : false,
            'liste_1'       => $this->liste_1,
            'liste_2'       => $this->liste_2,
            'liste_3'       => $this->liste_3,
            'liste_4'       => $this->liste_4,
        ]);

        $this->reset();
        Alert::success('Merci,', 'Votre contenus a été ajoutée avec succès!');
        return redirect()->to('/pages-content');
}


    public function edit($id)
    {
        $edit = Content::findOrFail($id);
        $this->submenus = Onglet::where('is_active', true)->get();
        $this->selected_id  = $id;
        $this->title        = $edit->title;
        $this->sub_title    = $edit->sub_title;
        $this->onglet_id    = $edit->onglet_id;
        $this->description  = $edit->description;
        $this->url          = $edit->url;
        $this->is_publish   = $edit->is_publish;
        $this->is_slider    = $edit->is_slider;

        $this->liste_1      = $edit->liste_1;
        $this->liste_2      = $edit->liste_2;
        $this->liste_3      = $edit->liste_3;
        $this->liste_4      = $edit->liste_4;

        $this->currentImage = $edit->images;

        $this->updateMode = true;

    }


    public function update()
    {
        $this->validate();
        
        $update = Content::find($this->selected_id);
        if (!$update) {
            return;
        }

        $update->update([
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'onglet_id' => $this->onglet_id,
            'description' => $this->description,
            'url' => $this->url,
            'is_publish' => $this->is_publish ? true : false,
            'is_slider' => $this->is_slider ? true : false,
            'liste_1' => $this->liste_1,
            'liste_2' => $this->liste_2,
            'liste_3' => $this->liste_3,
            'liste_4' => $this->liste_4,
        ]);

        if ($this->images) {
            $imagePaths = [];
            foreach ($this->images as $image) {
                $imagePaths[] = $image->store('pages', 'public');
            }
            $update->images = implode(',', $imagePaths);
        }

        $update->save();

        $this->reset();
        Alert::success('Merci,', 'Votre page a été mise à jour avec succès!');
        return redirect()->to('/pages-content');
    }


    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        Content::destroy($id);
    }
}
