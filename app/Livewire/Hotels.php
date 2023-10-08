<?php

namespace App\Livewire;

use App\Models\Hotel;
use Livewire\Component;
use App\Models\Included;
use App\Models\RoomType;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Hotels extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    #[Rule('required|numeric|unique:hotels,room_number', message: 'Ce champ est obligatoire et doit être unique.')]
    public $room_number;
    #[Rule('required', message: 'Type de chambre est obligatoire.')] 
    public $room_type_id;
    #[Rule('required', message: 'Nombre de personne est obligatoire.')] 
    public $nbre_persone;
    #[Rule('required|numeric', message: 'Tarif est obligatoire.')] 
    public $tarif;
    #[Rule('nullable')] 
    public $include;
    public $is_active = true;
    public $perPage = 10;
    public $hotel, $selected_id, $description;
    public $search = '';

    
    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function save()
    {
        $this->authorize('hotel-create');
        $this->validate();

        Hotel::create([
            'room_number' => $this->room_number,
            'room_type_id' => $this->room_type_id,
            'nbre_persone' => $this->nbre_persone,
            'tarif' => $this->tarif,
            'description' => $this->description,
            'include' => implode(', ', $this->include ?? []),
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->reset();
        session()->flash('status', 'Hotel created successfully.');
    }

    public function show($id)
    {
        $hotel = Hotel::findOrfail($id);
    }

    public function edit($id)
    {
        $this->authorize('hotel-edit');
        $this->reset();
        $edit = Hotel::findOrFail($id);
        $this->selected_id = $id;
        $this->room_number = $edit->room_number;
        $this->room_type_id = $edit->room_type_id;
        $this->include = $edit->include ? explode(', ', $edit->include) : [];
        $this->nbre_persone = $edit->nbre_persone;
        $this->tarif = $edit->tarif;
        $this->description = $edit->description;
        $this->is_active = $edit->is_active;
    }
    
    public function update()
    {
        $this->validate([
            'room_number' => 'required',
            'room_type_id' => 'required',
            'nbre_persone' => 'required',
            'tarif' => 'required'
        ]); 

        $udapte = Hotel::find($this->selected_id);
        $udapte->update([
            'room_number' => $this->room_number,
            'room_type_id' => $this->room_type_id,
            'nbre_persone' => $this->nbre_persone,
            'tarif' => $this->tarif,
            'description' => $this->description,
            'include' => implode(', ', $this->include ?? []),
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->reset();
        $this->showMessage('Hotel updated successfully!');
        return $this->redirect('/hotels'); 

    }

    public function delete($id)
    {   
        $deleted = Hotel::find($id);
        $deleted->delete();
    }

    public function disable($id)
    {
        $status = Hotel::findOrFail($id);
        $status->update([
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->showMessage('Operation disabled successfully!');
    }

    public function enable($id)
    {
        $status = Hotel::findOrFail($id);
        $status->update([
            
            'is_active' => $this->is_active ? false : true,
        ]);
        $this->showMessage('Operation enabled successfully!');
    }
    

    public function render()
    {
        $this->authorize('hotel-list');

        $search = '%' . $this->search . '%';
        return view('livewire.hotels.index', [

            'hotels' => Hotel::where('room_number', 'LIKE', $search)
                ->orWhere('tarif', 'LIKE', $search)
                ->orderby('id', 'asc')
                ->paginate($this->perPage),

            'roomtypes' => RoomType::where('is_active', true)->get(),
            'includes' => Included::where('is_active', true)->get(),

        ]);
    }
}
