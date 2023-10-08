<?php

namespace App\Livewire\Guard;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PermissionIndex extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $name, $selected_id, $roles, $confirmingDelete;
    public $add = false;

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public function render()
    {
        $this->authorize('permission-list');
        $permissions = Permission::orderBy('id', 'desc')->paginate(20);
        $this->roles = Role::all();
       
        return view('livewire.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function save()
    {
        $this->authorize('permission-create');
        $this->validate([
            'name' => 'required|unique:permissions', // Assuming 'name' is the permission name.
        ]);

        Permission::create(['name' => $this->name]);

        $this->reset();
        $this->showMessage('Ajouté avec succès!');
        return redirect()->route('permissions'); // Corriger la route ici
    }

    public function edit($id)
    {
        $this->authorize('permission-edit');
        $this->reset();
        $permission = Permission::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $permission->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $permission = Permission::findOrFail($this->selected_id);

        $permission->name = $this->name;
        $permission->save();

        $this->reset();
        $this->showMessage('Mise à jour réussie!');
        return redirect()->route('permissions');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }

    public function kill($id)
    {
        Permission::destroy($id);
    }
    
}
