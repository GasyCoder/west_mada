<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoomType;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoomTypes extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $add, $updateMode = false;
    public $name;
    public $is_active;

    public $typeId;
    public $perPage = 10;
    public $search = '';


    public function showMessage()
    {
        $this->dispatch('showSuccessMessage');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);

        RoomType::create([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false,
        ]);

        $this->showMessage('Type de room ajouté avec succès!');
        $this->reset();
        $this->add = true;
    }


    public function edit($id)
    {
        $edit = RoomType::findOrFail($id);
        $this->typeId       = $id;
        $this->name         = $edit->name;
        $this->is_active    = $edit->is_active;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $update = RoomType::findOrfail($this->typeId);
        $update->update([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false,
        ]);

        $this->showMessage('Type room à jour avec succès!');
        $this->reset();
        $this->updateMode = true;
        return $this->redirect('/typerooms');
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.hotels.types.index', [
            "services" => RoomType::where('name', 'LIKE', $search)
                ->orderby('id', 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function delete($id)
    {
        $deleted = RoomType::find($id);
        $deleted->delete();
    }
}
