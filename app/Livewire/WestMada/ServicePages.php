<?php

namespace App\Livewire\WestMada;

use Livewire\Component;
use App\Models\ServicePage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServicePages extends Component
{   
    use WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $confirming;
    public $updateMode, $add = false;
    public $page = 10;
    public $currentImage;
    public $name, $images, $contenus, $is_active, $resume, $selected_id;

    protected $rules = [
        'name'   => 'required',
        'resume' => 'required',
        'contenus' => 'nullable',
        'images'  => 'nullable|image|max:2048',
    ];

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function create()
    {
        $this->add = true;
    }

    public function save()
    {
        $this->validate();
        ServicePage::create([
            'name'          => $this->name,
            'resume'        => $this->resume,
            'contenus'      => $this->contenus,
            'is_active'     => $this->is_active ? true : false,
            'images'        => $this->images->store('services', 'public'),
        ]);

        $this->reset();
        Alert::success('Merci,', 'Votre service a été ajoutée avec succès!');
        return redirect()->to('/services-page');
    }

    public function edit($id)
    {
        $edit = ServicePage::findOrFail($id);

        $this->selected_id  = $id;
        $this->name         = $edit->name;
        $this->resume       = $edit->resume;
        $this->contenus     = $edit->contenus;
        $this->is_active    = $edit->is_active;
        $this->currentImage = $edit->images;

        $this->updateMode = true;
    }

    public function render()
    {   
        $services = ServicePage::latest()->paginate($this->page);
        return view('livewire.westmada.pages.services.index', [
            'services'  => $services,
        ])
        ->layout('components.westmada.panel');
    }

    public function update()
    {
        $this->validate();

        $update = ServicePage::find($this->selected_id);
        if (!$update) {
            return;
        }

        $update->update([
            'name'      => $this->name,
            'resume'    => $this->resume,
            'contenus'  => $this->contenus,
            'is_active' => $this->is_active ? true : false,
        ]);

        if ($this->images) {
            $filePath = $this->images->store('services', 'public');
            $update->images = $filePath;
            $update->save();
        }

        $this->reset();
        Alert::success('Merci,', 'Votre service a été mise à jour avec succès!');
        return redirect()->to('/services-page');
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        ServicePage::destroy($id);
    }
}
