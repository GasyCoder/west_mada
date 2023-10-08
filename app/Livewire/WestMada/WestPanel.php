<?php

namespace App\Livewire\WestMada;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class WestPanel extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.westmada.dashboard')->layout('components.westmada.panel');
    }
}
