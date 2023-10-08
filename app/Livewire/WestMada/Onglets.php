<?php

namespace App\Livewire\WestMada;

use App\Models\Navbar;
use App\Models\Onglet;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Onglets extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    
    public $page = 10;
    public $is_slider = false;
    public $confirming, $selected_id, $name, $navbar_id, $is_active, $navbars;

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function render()
    {   
        $onglets = Onglet::where('is_slider', false)->latest()->paginate($this->page);
        $menus = Navbar::where('is_active', true)->get();
        return view('livewire.westmada.pages.onglets.index', [
            'onglets' => $onglets,
            'menus'   => $menus
        ])
        ->layout('components.westmada.panel');
    }

    public function edit($id)
    {
        $edit               = Onglet::findOrFail($id);
        $this->navbars      = Navbar::where('is_active', true)->get();
        $this->selected_id  = $id;
        $this->name         = $edit->name;
        $this->navbar_id    = $edit->navbar->name;
        $this->is_active    = $edit->is_active ? true : false;

    }

    public function update()
    {
        $update = Onglet::find($this->selected_id);
        $update->update([
            'name' => $this->name,
            'navbar_id' => $this->navbar_id,
            'is_active' => $this->is_active ? true : false
        ]);

        $this->reset();
        Alert::success('Merci,', 'Votre onglet à jour avec succès!');
        return redirect()->to('/onglets');
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        Onglet::destroy($id);
    }
}
