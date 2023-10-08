<?php

namespace App\Livewire\WestMada;

use App\Models\Page;
use App\Models\Navbar;
use App\Models\Storie;
use App\Models\Content;
use Livewire\Component;
use App\Models\PageType;
use App\Models\ServicePage;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class HomeOne extends Component
{
    use WithPagination; 
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $typeAbout, $typePolitique;
    public $pageAbout, $pagePolitique;

    public function mount()
    {
        $this->typeAbout = 'apropos_de_nous'; 
        // $this->typePolitique = 'politique_de_confidentialite';
    }

    public function render()
    {
        $this->pageAbout = PageType::where('type', $this->typeAbout)
            ->where('is_active', true)
            ->first();
        // $this->pagePolitique = PageType::where('type', $this->typePolitique)
        //     ->where('is_active', true)
        //     ->first();
        $services = ServicePage::get()->take(3);
        $menus = Navbar::with('onglets.contents')->where('is_active', true)->get();
        $sliders = Content::where('is_slider', true)->where('is_publish', true)->get();
        $stories = Storie::where('is_active', true)->get();
        // Loop through the stories and explode the image paths
        foreach ($stories as $story) {
            $story->images = explode(',', $story->images);
        }
        return view('livewire.westmada.main.index', [
            'menus'         => $menus,
            'sliders'       => $sliders,
            'pageAbout'     => $this->pageAbout,
            'pagePolitique' => $this->pagePolitique,
            'services'      => $services,
            'stories'       => $stories
        ])
        ->layout('components.westmada.home');
    }



}