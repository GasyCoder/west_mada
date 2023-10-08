<?php

namespace App\Livewire\Guard;

use App\Models\User;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Users extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $add = false;
    public $page = 10;
    public $name, $email, $password, $user_id, $service_id, $roles, $services;
    public $selected_roles = [];
    public $confirming, $selected_id, $is_active;

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function render()
    {
        $this->authorize('user-list');
        $users = User::latest()->paginate($this->page);
        $this->services = Service::all();
        $this->roles = Role::whereIn('name', ['admin', 'employe'])->pluck('name', 'name')->toArray();

        return view('livewire.users.index', [
            'users' => $users,
        ]);
    }

    public function save()
    {
        $this->authorize('user-create');

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'selected_roles' => 'required|array',
            'service_id' => 'required',
        ]);

        $user = User::create([  
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole($this->selected_roles);

        // Attacher l'utilisateur au service
        $user->services()->attach($this->service_id);

        $this->reset(); // Réinitialiser les champs du formulaire
        $this->showMessage('Ajouté avec succès!');
        //return redirect()->route('users');
        $this->add = false;
    }

    public function show($id)
    {
        $user = User::findOrfail($id);
    }

    public function edit($id)
    {
        $this->authorize('user-edit');
        $service = Service::where('user_id', $id);
        $edit = User::findOrFail($id);
        $this->reset();
        $this->selected_id = $id;
        $this->name = $edit->name;
        $this->email = $edit->email;

        $this->service_id = $edit->services->pluck('id')->all();


        $this->roles = Role::whereIn('name', ['admin', 'employe'])->pluck('name', 'name')->all();
        $this->selected_roles = $edit->roles->pluck('name')->all();
        $this->add = true;
    }

    public function update()
    {
        $this->authorize('user-edit');

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_id,
            'password' => 'confirmed',
            'roles' => 'required',
            'service_id' => 'required',
            //'image' => 'nullable|image|max:1024', // 1MB Max

        ]);

        if ($this->selected_id) {
            $record = User::find($this->selected_id);

            $record->update([
                'name' => $this->name,
                'email' => $this->email,
                'service_id' => $this->service_id,
            ]);
            DB::table('model_has_roles')
            ->where('model_id', $this->selected_id)
                ->delete();
            $record->assignRole($this->selected_roles);

            $this->reset();
            $this->showMessage('Employer ajouté avec succès!');
            return redirect()->route('users');
        }
    }

    public function disable($id)
    {
        $status = User::findOrFail($id);
        $status->update([
            'is_active' => $this->is_active ? false : true,
        ]);
        $this->showMessage('Operation disabled successfully!');
    }

    public function enable($id)
    {
        $status = User::findOrFail($id);
        $status->update([
            'is_active' => $this->is_active ? true : false,
        ]);
        $this->showMessage('Operation enabled successfully!');
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        User::destroy($id);
    }

}
