<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('panel.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validateRole($request);
        Role::create($request->only('name', 'persian_name'));

        return back()->with([
            'alert' => __('alerts.success.create', ['attribute' => 'نقش جدید']),
            'alert-type' => 'success',
        ]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('panel.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validateRole($request);
        $role->update($request->only('name', 'persian_name'));
        $role->refreshPermissions($request->permissions);

        return back()->with([
            'alert' => __('alerts.success.update', ['attribute' => 'نقش']),
            'alert-type' => 'success',
        ]);
    }

    protected function validateRole($request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'persian_name' => ['required', 'min:4'],
        ]);
    }
}
