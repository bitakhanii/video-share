<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user->load(['roles', 'permissions']);
        return view('admin.users.edit', compact('roles', 'permissions', 'user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $user->refreshPermissions($request->permissions);
        $user->refreshRoles($request->roles);

        return success_redirect('back', 'saves', 'roles-permissions');
    }
}
