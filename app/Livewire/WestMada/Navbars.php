<?php

namespace App\Livewire\WestMada;

use App\Models\Navbar;
use App\Models\Onglet;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Navbars extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $page = 10;
    public $updateMode = false;

    #[Rule('required', message: 'Nom de menu est obligatoire.')]
    public $name;
    #[Rule('required')]
    public $dropdown;
    public $is_active;
    public $selected_id, $confirming, $menu, $navbar_id;

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function render()
    {   
        $menus = Navbar::orderBy('id', 'asc')->paginate($this->page);
        return view('livewire.westmada.pages.navbar.index', [
            'menus'  => $menus
        ])->layout('components.westmada.panel');
    }

    public function save()
    {
        $this->validate();

        Navbar::create([
            'name'          => $this->name,
            'dropdown'      => $this->dropdown,
            'is_active'     => $this->is_active ? true : false,
        ]);

        $this->reset();
        $this->showMessage('Menu ajouté avec succès!');
    }

    public function edit($id)
    {
        $edit = Navbar::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $edit->name;
        $this->dropdown = $edit->dropdown;  
        $this->is_active = $edit->is_active ? true : false;

        $this->updateMode = true;
    }

    public function update()
    {
        $update = Navbar::find($this->selected_id);
        $update->update([
           'name' => $this->name,
           'dropdown' => $this->dropdown,
           'is_active' => $this->is_active ? true : false
        ]);

        $this->reset();
        Alert::success('Merci,', 'Votre menu à jour avec succès!');
        return redirect()->to('/navbars');
    }

    public function onglet($id)
    {
        $this->navbar_id = $id;
    }

    public function storeOnglet()
    {
        $navbar = Navbar::find($this->navbar_id);

        Onglet::updateOrCreate([
            'name'      => $this->name,
            'navbar_id' => $navbar->id,
            'is_active' => $this->is_active ? true : false
        ]);
        $this->reset();
        Alert::success('Merci,', 'Votre Onglet ajouté avec succès!');
        return redirect()->to('/navbars');
    }


    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        Navbar::destroy($id);
    }
}
