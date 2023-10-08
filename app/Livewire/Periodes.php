<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Periode;
use Livewire\Component;
use App\Models\JournalStock;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Periodes extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshForm' => '$refresh'];

    public $add = false;
    public $mois, $year;
    public $search = '';
    public $page = 6;
    public $is_active = 0;  

    public function showMessage($message)
    {   
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $data = getPeriodsData($search, $this->page);       

        return view('livewire.tasks.periode.index', $data); 
    }


    public function save()
    {
        $this->validate([
            'mois' => 'required',
            'year'  => 'nullable'
        ]);
        $year = date('Y');
        Periode::create([
            'year' => $year,
            'mois' => $this->mois,
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->reset();
        $this->showMessage('Ajouté avec succès!');
        return redirect()->back();
    }

    public function disable($id)
    {
        $status = Periode::findOrFail($id);
        $status->update([
            'is_active' => $this->is_active ?  false : true,
        ]);
        $this->showMessage('Operation disabled successfully!');
    }

    public function enable($id)
    {
        $status = Periode::findOrFail($id);
        $status->update([

            'is_active' => $this->is_active ? true : false,
        ]);
        $this->showMessage('Operation enabled successfully!');
    }

    public function delete($id)
    {
        $delete = Periode::find($id);
        $delete->delete();
        $this->dispatch('refreshForm');
    }

}
