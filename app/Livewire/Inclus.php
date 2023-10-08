<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Included;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Inclus extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    
    public $add, $updateMode = false;

    #[Rule('required', message:'Ce champ est obligatoire')]
    public $name;
    public $is_active;
    public $serviceId;
    public $perPage = 10;
    public $search = '';

    public function showMessage()
    {
        $this->dispatch('showSuccessMessage');
    }

    public function save()
    {   
        $this->validate();

        Included::create([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->showMessage('Service inclus ajouté avec succès!');
        $this->reset();
        $this->add = true; 
    }

    public function edit($id)
    {
        $this->reset();
        $edit = Included::findOrFail($id);
        $this->serviceId = $id;
        $this->name = $edit->name;
        $this->is_active = $edit->is_active;

        $this->updateMode = true;

    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]); 
        $update = Included::findOrfail($this->serviceId);
        $update->update([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false,
        ]);

        $this->showMessage('Service inclus à jour avec succès!');
        $this->reset();
        $this->updateMode = true;
        return $this->redirect('/inclus'); 

    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.hotels.service.index', [
            "services" => Included::where('name', 'LIKE', $search)
                ->orderby('id', 'asc')
                ->paginate($this->perPage),
        ]);
    }


    public function delete($id)
    {
        $deleted = Included::find($id);
        $deleted->delete();
    }
}
