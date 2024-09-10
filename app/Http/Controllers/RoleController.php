<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            //'role_or_permission:super-admin|edit articles',
            new Middleware('role:super-admin', only: ['index']),
            new Middleware('role:super-admin', only: ['destroy']),
            new Middleware('role:super-admin', only: ['create']),
            new Middleware('role:super-admin', only: ['store']),
            new Middleware('role:super-admin', only: ['edit']),
            new Middleware('role:super-admin', only: ['update']),
            new Middleware('role:super-admin', only: ['addPermissionToRole']),
            new Middleware('role:super-admin', only: ['givePermissionToRole']),
            //new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('super-admin'), except: ['viewEntry']),
            //new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete nomination,web'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::get();

        return view('role-permission.role.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect('roles')->with('status', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        return view('role-permission.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect('roles')->with('status', 'Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::findById($roleId);
        $role->delete();

        return redirect('roles')->with('status', 'Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::all();
        $role = Role::findById($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findById($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions added to Role');
    }
}
