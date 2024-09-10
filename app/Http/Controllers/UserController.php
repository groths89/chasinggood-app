<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            //'role_or_permission:super-admin|edit articles',
            new Middleware('role:super-admin|administrator', only: ['index']),
            new Middleware('role:super-admin|administrator', only: ['create']),
            new Middleware('role:super-admin|administrator', only: ['store']),
            new Middleware('role:super-admin|administrator', only: ['edit']),
            new Middleware('role:super-admin|administrator', only: ['update']),
            new Middleware('role:super-admin', only: ['destroy']),
            new Middleware('role:super-admin', only: ['addRoleToUser']),
            new Middleware('role:super-admin', only: ['assignRoleToUser']),
            //new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('super-admin'), except: ['viewEntry']),
            //new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete nomination,web'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $users = User::get();
        return view('users.index', [
            'users' => $users
        ], compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20'
            ],
            'roles' => [
                'required'
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('users')->with('status', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:users,name' . $user->id
            ]
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return redirect('users')->with('status', 'User Updated Successfully');
    }

    public function destroy($userId)
    {
        $user = User::find($userId);
        if ($user != null) {
            $user->delete();
            return redirect()->route('users')->with(['status' => 'User Deleted Successfully']);
        }

        return redirect('users')->with('status', 'User Deleted Successfully');
    }

    public function addRoleToUser($userId)
    {
        $roles = Role::all();
        $user = User::find($userId);
        $userRoles = DB::table('model_has_roles')
            ->where('model_has_roles.model_id', $user->id)
            ->pluck('model_has_roles.role_id', 'model_has_roles.role_id')
            ->all();

        return view('users.add-roles', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function assignRoleToUser(Request $request, $userId)
    {
        $request->validate([
            'roles' => 'required'
        ]);

        $user = User::find($userId);
        $user->syncRoles($request->roles);

        return redirect()->back()->with('status', 'Roles added to User');
    }
}
