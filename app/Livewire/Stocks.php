<?php

namespace App\Livewire;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\CategoryStock;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Stocks extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    
    public $add, $isOpen = false;
    public $is_active = true;
    public $min_quantity = 1;
    public $perPage = 10;
    public $search = '';
    public $selected_id;
    public $services =  [];

    #[Rule('required', message: 'Nom de produit est obligatoire.')]
    public $name;
    #[Rule('required', message: 'Catégorie est obligatoire.')]
    public $category_id;
    #[Rule('required', message: 'Quantité est obligatoire.')]
    public $max_quantity;
    #[Rule('required', message: 'Prix est obligatoire.')]
    public $price_u;
    public $reference, $unite_stock, $service_id, $description, $stock_quantity;
    

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function save()
    {
        //dd('Save method called');
        $this->validate();
        Stock::create([
            'name'          => $this->name,
            'category_id'   => $this->category_id,
            'stock_quantity' => $this->max_quantity,
            'max_quantity'  => $this->max_quantity,
            'price_u'       => $this->price_u,
            'unite_stock'   => $this->unite_stock,
            'service_id'    => $this->service_id,
            'description'   => $this->description,
            'is_active'     => $this->is_active ? true : false,
            'reference'     => $this->reference,    
        ]);
        $this->reset();
        session()->flash('status', 'Stock ajouté avec succès.');
    }

    public function show($id)
    {
        $hotel = Stock::findOrfail($id);
    }


    public function edit($id)   
    {
        $edit = Stock::findOrFail($id);

        $this->selected_id      = $id;
        $this->name             = $edit->name;
        $this->category_id      = $edit->category_id;
        $this->service_id       = $edit->service_id;
        $this->max_quantity     = $edit->max_quantity;
        $this->stock_quantity   = $edit->stock_quantity;
        $this->price_u          = $edit->price_u;
        $this->unite_stock      = $edit->unite_stock;
        $this->description      = $edit->description;
        $this->is_active        = $edit->is_active;

        //$this->add = true;
    }

    public function update()    
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'service_id' => 'required',
            'stock_quantity' => 'required',
            'price_u' => 'required'
        ]);

        $udapte = Stock::find($this->selected_id);
        $udapte->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'service_id' => $this->service_id,
            'stock_quantity' => $this->stock_quantity,
            'price_u' => $this->price_u,
            'unite_stock' => $this->unite_stock,
            'description' => $this->description,
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->reset();
        $this->showMessage('Stock à jour avec succès!');

        return redirect()->back();
    }

    public function close()
    {
        $this->isOpen = false;

        return redirect()->back();
    }

    public function delete($id)
    {
        $deleted = Stock::find($id);
        $deleted->delete();
    }

    public function disable($id)
    {
        $status = Stock::findOrFail($id);
        $status->update([
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->showMessage('Operation disabled successfully!');
    }

    public function enable($id)
    {
        $status = Stock::findOrFail($id);
        $status->update([

            'is_active' => $this->is_active ? false : true,
        ]);
        $this->showMessage('Operation enabled successfully!');
    }
    

    public function render()    
    {
        $this->authorize('stock-list');

        $search = '%' . $this->search . '%';
        
        $this->services = Service::get();

        $stocks = Stock::where('name', 'LIKE', $search)
                ->orWhere('reference', 'LIKE', $search)
                ->orWhere('stock_quantity', 'LIKE', $search)
                ->orWhere('price_u', 'LIKE', $search)
                ->orWhere('unite_stock', 'LIKE', $search)
                ->orWhere('description', 'LIKE', $search)
                ->orderby('id', 'asc')->paginate($this->perPage);

        $categories = CategoryStock::where('is_active', true)->get();

        return view('livewire.magasins.stocks.liste', [
            'stocks' => $stocks,
            'categories' => $categories,
            //'services'  => $services,
        ]);
      
    }
}
