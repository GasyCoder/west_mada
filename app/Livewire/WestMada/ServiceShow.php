<?php

namespace App\Livewire\WestMada;

use Livewire\Component;
use App\Models\ServicePage;

class ServiceShow extends Component
{
    public $service;
    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
        $this->service = ServicePage::where('slug', $slug)->where('is_active', true)->firstOrFail();
    }


    public function render()
    {
        return view('livewire.westmada.main.service_show')
            ->layout('components.westmada.home');
    }
}
