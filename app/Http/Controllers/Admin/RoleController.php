<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateRole($request);
        Role::create($request->only('name', 'persian_name'));

        return success_redirect('back', 'create', 'role');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->validateRole($request, $role);
        $role->update($request->only('name', 'persian_name'));
        $role->refreshPermissions($request->permissions);

        return success_redirect('back', 'update', 'role');
    }

    protected function validateRole(Request $request, ?Role $role = null): void
    {
        $request->validate([
            'name' => ['required', 'min:3', Rule::unique('roles', 'name')->ignore($role?->id)],
            'persian_name' => ['required', 'min:3'],
        ]);
    }
}
