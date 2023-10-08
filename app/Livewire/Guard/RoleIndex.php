<?php

namespace App\Livewire\Guard;

use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleIndex extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    
    public $name, $selected_id, $permissions;
    public $selected_permission = [];
    public $rolePermissions = [];   
    public $add = false;

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }


    public function render()
    {
        $this->authorize('role-list');
        $roles = Role::orderBy('name', 'asc')->paginate(5);
        $this->permissions = Permission::all();
        
            return view('livewire.roles.liste', [
                'roles' => $roles,
            ]);

    }

    public function save()
    {
        $this->authorize('role-create');
        $this->validate([
            'name' => 'required|unique:roles,name',
            'selected_permission' => 'required|array',
        ]);

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selected_permission);

        $this->reset();
        $this->showMessage('Ajouté avec succès!');
        return redirect()->route('roles'); // Corriger la route ici
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $this->rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->orderBy("permissions.name", "asc") // Tri par nom de permission en ordre alphabétique
            ->get();

        $this->selected_id = $id;
        $this->name = $role->name;
    }

    public function edit($id)
    {
        $this->authorize('role-edit');
        $this->reset();
        $this->selected_permission = [];
        $role = Role::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $role->name;

        // Tri des permissions par ordre alphabétique
        $this->selected_permission = $role->permissions()
            ->orderBy('name', 'asc')
            ->pluck('id')
            ->toArray();
    }

    public function update()
    {
        $this->authorize('role-edit');
        $this->validate([
            'name' => 'required',
            'selected_permission' => 'required|array',
        ]);

        $role = Role::findOrFail($this->selected_id);

        $role->name = $this->name;
        $role->save();

        $role->syncPermissions($this->selected_permission);

        $this->reset();
        $this->showMessage('Mise à jour réussie!');

        return redirect()->route('roles');
    }

}