<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SettingOne;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SettingsOne extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;

    public $app_name;
    public $logo;
    public $currentImage;
    public $update;

    public function render()
    {
        $setting = SettingOne::find(1);
        return view('livewire.settings.index', [
            'setting' => $setting,
        ]);
    }

    public function mount()
    {
        $updateShow = SettingOne::find(1);
        $this->app_name = $updateShow->app_name;
        $this->currentImage = $updateShow->logo;
    }

    public function updateSetting()
    {
        $setting = SettingOne::find(1);
        $setting->app_name = $this->app_name;

        // Validate and store the uploaded file
        if ($this->logo) {
            $this->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Modify according to your requirements
            ]);

            $setting->logo = $this->logo->store('logoapps', 'public');
        }

        $setting->save();

        $this->reset();
        session()->flash('success', 'Paramètre à jour avec succès.');
        return redirect()->to('/parametre');
    }
}
