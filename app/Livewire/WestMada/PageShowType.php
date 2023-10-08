<?php

namespace App\Livewire\WestMada;

use Livewire\Component;
use App\Models\PageType;

class PageShowType extends Component
{
    public $page;
    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
        $this->page = PageType::where('slug', $slug)->where('is_active', true)->firstOrFail();
    }


    public function render()
    {
        return view('livewire.westmada.main.page_type_show')
            ->layout('components.westmada.home');
    }
}
