<?php

namespace App\Livewire\WestMada;

use App\Models\Content;
use Livewire\Component;

class PageContent extends Component
{
    public $page;
    public $slug;
    public $pageId;
    public $listes;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->page = Content::where('slug', $slug)->where('is_publish', true)->firstOrFail();

        $this->listes = Content::select('liste_1', 'liste_2', 'liste_3', 'liste_4')
        ->where('slug', $this->slug)->first();
    }


    public function render()
    {
        return view('livewire.westmada.main.content_show')
        ->layout('components.westmada.home');
    }
}
