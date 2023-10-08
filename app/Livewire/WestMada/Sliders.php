<?php

namespace App\Livewire\WestMada;

use App\Models\Content;
use App\Models\Navbar;
use App\Models\Onglet;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Sliders extends Component
{

    public $page = 10;
    public $confirming, $selected_id, $name, $navbar_id, $is_active;
    public $is_slider = true;
    public function render()
    {
        $onglets = Onglet::where('is_slider', true)->latest()->paginate($this->page);
        $menus = Navbar::where('is_active', true)->get();
        return view('livewire.westmada.pages.onglets.slide', [
            'onglets' => $onglets,
            'menus'   => $menus,
        ])
        ->layout('components.westmada.panel');
    }

     public function edit($id)
    {
        $edit = Onglet::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $edit->name;
        $this->navbar_id = $edit->navbar->name;
        $this->is_active = $edit->is_active ? true : false;
        $this->is_slider = $edit->is_slider;

    }

    public function update()
    {   
        $this->validate([
            'navbar_id'  => 'nullable',
        ]);
        $update = Onglet::find($this->selected_id);
        $update->update([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false
        ]);

        $this->reset();
        Alert::success('Merci,', 'Votre onglet à jour avec succès!');
        return redirect()->to('/sliders');
    }

    public function save()
    {
        $navbar = Navbar::find($this->navbar_id);

        Onglet::updateOrCreate([
            'name'      => $this->name,
            'navbar_id' => $navbar->id,
            'is_slider'  => true,
            'is_active' => $this->is_active ? true : false
        ]);
        $this->reset();
        Alert::success('Merci,', 'Votre Onglet ajouté avec succès!');
        return redirect()->to('/sliders');
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
