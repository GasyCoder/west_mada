<?php

namespace App\Livewire;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Task;
use NumberFormatter;
use App\Models\Stock;
use App\Models\Periode;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoryStock;
use Livewire\Attributes\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Tasks extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'validateQuantity',
    ];
    protected function rules()
    {
        return ['quantity' => 'required|integer|lte:qteStock',];
    }

    public $updateMode, $add, $isLoading = false;
    public $perPage = 10;
    public $selected_id;
    public $categories = [];
    public $stocks = [];
    public $search = '';
    public $selected = '';
    public $confirming;

    public $selectedProducts = [];
    public $checkedProducts = [];
    public $productDetails = [];
    public $checked = [];
    public $checkedAll = false;
    
    public $getType;
    public $getReference;
    public $getCreatedAt;
    public $TotalWords;
    public $prixTotal;

    public $isCartModalOpen = false;

    public function closeModal()
    {
        $this->isCartModalOpen = false;
    }

    #[Rule('required', message: 'Type est obligatoire.')]
    public $type;
    #[Rule('required', message: 'Catégorie est obligatoire.')]
    public $category_id = 0;
    #[Rule('required', message: 'Produit est obligatoire.')]
    public $stock_id = 0;

    public $quantity, $unit, $period_id, $description, 
    $periodId, $detail, $user_id, $qteStock, $reference, 
    $priceUnity, $priceTotal, $stock_name, $qteRest,
    $qteRestPlus, $qteRestMoins, $stockQuantity, $stock_quantity, 
    $created_at;

    public function showMessage($message){
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function resetForm()
    {
        $this->selectedProducts = [];
        $this->quantity = null;
        $this->unit = null;
    }

    public function mount($id)
    {
        $this->period_id = $id;
        $user = auth()->user();
        $userServices = $user->services->pluck('id');
        $this->categories = Stock::whereIn('service_id', $userServices)
            ->distinct()
            ->pluck('category_id');
        $this->categories = CategoryStock::whereIn('id', $this->categories)
            ->orderBy('name')
            ->get();
        $this->stocks = collect();
        $this->resetForm();
        
    }

    public function validateQuantity($productId)
    {
        $stock = Stock::find($productId);
        if ($this->type === 'sortie' && $stock && $this->productDetails[$productId]['quantity'] > $stock->stock_quantity) {
            $this->addError('productDetails.' . $productId . '.quantity', 'La quantité ajoutée dépasse la quantité initiale en stock.');
        } else {
            $this->resetErrorBag('productDetails.' . $productId . '.quantity');
        }
    }
    
    public function selectedCategoryChanged($categoryId)
    {
        $this->stocks = Stock::where('category_id', $categoryId)->get();
        $this->stock_id = null;
        $this->resetForm();
    }

    public function removeOption($i)
    {
        if (isset($this->selectedProducts[$i])) {
            $productId = $this->selectedProducts[$i];
            unset($this->selectedProducts[$i]);

            if (isset($this->productDetails[$productId])) {
                $this->productDetails[$productId]['isInputEnabled'] = false;
            }
        }
    }


    public function selectedStockChanged($id)
    {
        $stock = Stock::find($id);
        if ($stock) {
            $this->unit = $stock->unite_stock;
            $this->selectedProducts[] = $stock->id;
            $this->productDetails[$stock->id] = [
                'quantity' => null,
                'unit' => $this->unit,
            ];
        }
    }   



    public function openCart()
    {
        $this->isLoading = true;

        $this->checkedProducts = Task::whereIn('id', $this->checked)->get();
        $firstProduct = $this->checkedProducts->first();
        if ($firstProduct) {
            $this->getType = $firstProduct->type;
            $this->getReference = $firstProduct->reference;
            $this->getCreatedAt = $firstProduct->created_at;
            // Calculate the total price here.
            $totalPrice = 0;
            foreach ($this->checkedProducts as $product) {
                // Add your logic here to calculate the total price.
                $totalPrice += $product->stock->price_u;
            }
            // Convert the total price to words.
            $this->TotalWords = $this->convertToWords($totalPrice);
        }
        $this->isCartModalOpen = true;

        $this->isLoading = false;

    }

    public function toggleAll()
    {
        if ($this->checkedAll) {
            $this->checked = Task::pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->checked = [];
        }
    }

    public function countChecked(){
        return count($this->checked);
    }

    

    public function render()
    {
        $user = auth()->user(); // Use Auth::user() to get the currently authenticated user
        $search = '%' . $this->search . '%';
        $data = getTasksData($user->id, $this->period_id, $search, $this->perPage);
        if ($data['notFound']) {
            abort(404);
        }
        $period = $data['period'];
        $tasks  = $data['tasks'];

        $countChecked = $this->countChecked();

        return view('livewire.tasks.liste', [
            'tasks' => $tasks,
            'period'  => $period,
            'countChecked' => $countChecked,
        ]);
    }


    public function save()
    {
        $this->validate([
            'productDetails.*.quantity' => 'required',
        ]);

        // Find the period by ID
        $periodId = Periode::where('is_active', true)->findOrFail($this->period_id);

        foreach ($this->selectedProducts as $productId) {
            
            // Récupérez le stock associé à la tâche
            $updateStock = Stock::find($productId);

            if ($updateStock) {
                $quantityToAdd = $this->productDetails[$productId]['quantity'];

                // Vérifiez le type de tâche et mettez à jour la quantité en conséquence
                if ($this->type === 'sortie') {
                    $updateStock->stock_quantity -= $quantityToAdd;
                } elseif ($this->type === 'entree') {
                    $updateStock->stock_quantity += $quantityToAdd;
                }
                // Enregistrez la mise à jour du stock
                $updateStock->save();
                // Mettez à jour le statut du stock 
                $updateStock->updateStatus();
            }

            Task::create([
                'period_id'     => $periodId->id,
                'user_id'       => auth()->user()->id,
                'stock_id'      => $productId,
                'category_id'   => $this->category_id,
                'quantity'      => $quantityToAdd,
                'type'          => $this->type,
                'unit'          => $this->productDetails[$productId]['unit'],
                'description'   => $this->description,
                'reference'     => $this->reference,
            ]);
        }

        $this->resetForm();
        Alert::success('Merci,', 'Votre bon ajouté avec succès!');
        return redirect()->route('tasks', ['id' => $periodId->id]);
    }

    public function show($id)
    {
        $this->detail = Task::with('stock', 'user', 'category')->findOrFail($id);

        $this->type         = $this->detail->type;
        $this->reference    = $this->detail->reference;
        $this->stock_name   = $this->detail->stock->name;
        $this->category_id  = $this->detail->category->name;
        $this->quantity     = $this->detail->quantity;
        $this->description  = $this->detail->description;
        $this->user_id      = $this->detail->user->name;
        $this->created_at   = $this->detail->created_at;
        $this->priceUnity   = $this->detail->stock->price_u; //Prix Unitaire de produit stocké
        $this->stockQuantity      = $this->detail->stock->max_quantity;

        if ($this->type === 'entree') {
            $this->qteRestPlus = $this->detail->stock->stock_quantity;
        } elseif ($this->type === 'sortie') {
            $this->qteRestMoins = $this->detail->stock->stock_quantity;
        } else {
            $this->qteRest = 0;
        }

        $this->priceTotal = $this->quantity * $this->priceUnity; // Prix total de produit sortant
        $this->dispatch('showDetailModal'); // dispatch an event to trigger the modal display
    }


    public function edit($id)
    {
        $this->detail = Task::with('stock', 'user', 'category')->findOrFail($id);

        $this->stocks       = Stock::where('id', $this->stock_id)->get();
        $this->categories   = CategoryStock::where('id', $this->detail->category_id)->get();

        $this->unit         = $this->detail->stock->unite_stock;
        $this->quantity     = $this->detail->quantity;
        $this->category_id  = $this->detail->category_id;
        $this->stock_id     = $this->detail->stock->pluck('id')->all();

        $this->selected_id  = $id;
        $this->period_id    = $this->detail->period_id;
        $this->type         = $this->detail->type;
        $this->description  = $this->detail->description;
        $this->user_id      = $this->detail->user->name;
    }

    public function update()
    {
        $this->validate([
            'type' => 'required',
            'category_id' => 'required',
            'stock_id' => 'required',
            'quantity' => 'required',
        ]);

        $periodId = Periode::find($this->period_id);
        $update = Task::find($this->selected_id);
        $update->update([
            'user_id'       => auth()->user()->id,
            'category_id'   => $this->category_id,
            'stock_id'      => $this->stock_id,
            'quantity'      => $this->quantity,
            'type'          => $this->type,
            'unit'          => $this->unit,
            'description'   => $this->description,
            'period_id'     => $periodId->id,
        ]);
        $this->reset();
        Alert::success('Merci,', 'Votre bon à jour avec succès!');
        return redirect()->route('tasks', ['id' => $periodId->id]);
    }


    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        Task::destroy($id);
    }

    // Créez une fonction pour convertir le montant en lettres
    public function convertToWords($amount)
    {
        // Check if $amount is numeric, and if not, attempt to convert it to a float.
        if (!is_numeric($amount)) {
            $amount = floatval($amount);
        }
        // Now, $amount is guaranteed to be numeric (integer or float).
        $formatter = new NumberFormatter('fr', NumberFormatter::SPELLOUT);

        return ucfirst($formatter->format($amount));
    }


    public function generatePDF()
    {
        $this->isLoading = true;

        $totalPrice = 0;
        foreach ($this->checkedProducts as $product) {
                $totalPrice += $product->stock->price_u;
        }
        $data = [
            'getReference' => $this->getReference,
            'getCreatedAt' => $this->getCreatedAt,
            'getType' => $this->getType,
            'checkedProducts' => $this->checkedProducts,
            'prixTotal' => $this->prixTotal,
            'TotalWords' => $this->convertToWords($totalPrice),
        ];

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $html = view('livewire.tasks.cart.invoice', $data)->render();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper(array(0, 0, 396, 612), 'portrait')
        $dompdf->setPaper([0, 0, 249.45, 354.33], 'portrait'); // 7,5 cm x 12,5 cm
        $dompdf->render();

        $output = $dompdf->output();
        $filename = 'invoice.pdf';
        file_put_contents($filename, $output);
        $this->isLoading = false;

        return response()->download($filename)->deleteFileAfterSend(true);

       
    }



}
