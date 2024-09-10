<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller implements HasMiddleware
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
            //new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('super-admin'), except: ['viewEntry']),
            //new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete nomination,web'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        return redirect('permissions')->with('status', 'Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect('permissions')->with('status', 'Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        $permission = Permission::findById($permissionId);
        $permission->delete();

        return redirect('permissions')->with('status', 'Permission Deleted Successfully');
    }
}
