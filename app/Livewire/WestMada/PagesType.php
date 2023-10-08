<?php

namespace App\Livewire\WestMada;

use Livewire\Component;
use App\Models\PageType;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PagesType extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $confirming;
    public $updateMode, $add = false;

    public $title, $type, $contenus, $is_active, $sub_title;

    protected $rules = [
        'title'   => 'required',
        'type' => 'required',
        'contenus' => 'nullable',
    ];

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function render()
    {
        $pages = PageType::latest()->paginate(10);
        return view('livewire.westmada.pages.types.index', [
            'pages'  => $pages
        ])
        ->layout('components.westmada.panel');
    }

    public function create()
    {
        $this->add = true;
    }
    
    public function save()
    {
        $this->validate();
        PageType::create([
            'title'          => $this->title,
            'type'          => $this->type,
            'sub_title'     => $this->sub_title,
            'contenus'      => $this->contenus,
            'is_active'     => $this->is_active ? true : false,
        ]);

        $this->reset();
        Alert::success('Merci,', 'Votre page a été ajoutée avec succès!');
        return redirect()->to('/pages-type');
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        PageType::destroy($id);
    }
}
