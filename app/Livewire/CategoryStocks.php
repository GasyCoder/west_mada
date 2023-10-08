<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoryStock;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryStocks extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    
    public $add = false;
    public $perPage = 10;
    public $search = '';
    public $name;
    public $is_active = 0;
    public $selectId;

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required'
        ]);

        CategoryStock::create([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->reset();
        $this->showMessage('Ajouté avec succès!');
        $this->add = false;
    }

    public function edit($id)
    {
        $this->reset();
        $edit = CategoryStock::findOrFail($id);
        $this->selectId = $id;
        $this->name = $edit->name;
        $this->is_active = $edit->is_active;

        $this->add = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $update = CategoryStock::findOrfail($this->selectId);
        $update->update([
            'name' => $this->name,
            'is_active' => $this->is_active ? true : false,
        ]);

        $this->showMessage('Catégorie à jour avec succès!');
        $this->reset();
        $this->add = false;
        return $this->redirect('/stock_categories');
    }

    public function disable($id)
    {
        $status = CategoryStock::findOrFail($id);
        $status->update([
            'is_active' => $this->is_active ?  false : true,
        ]);
        $this->showMessage('Operation disabled successfully!');
    }

    public function enable($id)
    {
        $status = CategoryStock::findOrFail($id);
        $status->update([

            'is_active' => $this->is_active ? true : false,
        ]);
        $this->showMessage('Operation enabled successfully!');
    }

    public function delete($id)
    {
        $destroy = CategoryStock::findOrfail($id);
        $destroy->delete();
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $categories = CategoryStock::where('name', 'LIKE', $search)
            ->latest()->paginate($this->perPage);
            return view('livewire.magasins.category.index', [
                'categories' => $categories,
            ]);
    }
}   
