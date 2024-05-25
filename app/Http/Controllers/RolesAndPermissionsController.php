<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public static function middleware(): array
    {
        return [
            'role:Administrator|Staff',
        ];
    }

    function __construct()
    {
        $this->middleware('password.confirm');

        Gate::define('can delete Staff', function ($user) {
            return $user->hasAnyRole('Administrator', 'Staff');
        });
        Gate::define('can delete Administrators', function ($user) {
            return $user->hasAnyRole('Administrator');
        });
    }

    public function index()
    {
        // user selector dropdown
        $select = new User;
        $select->id = 0;
        $select->name = 'Please select';

        $excludeRoles = [];
        // disallow deletion of Administrators unless passes gate
        if (!auth()->user()->can('can delete Administrators')) {
            $excludeRoles[] = 'Administrator';
        }

        $roles = Role::whereNotIn('name', $excludeRoles)
            ->with('users')
            ->get();

        $users = User::query()
            ->with('roles')
            ->get();

        return view('admin.roles_editor',
            [
                'roles' => $roles,
                'users' => $users,
                'canEdit' => auth()->user()->can(['Role-Assign', 'Role-Revoke']),
                'canDeleteStaff' => auth()->user()->can('can delete Staff'),
                'canDeleteAdministrators' => auth()->user()->can('can delete Administrators')
            ]
        );
    }

    public function store(Request $request)
    {
        \abort_unless($request->user()->can(['Role-Assign']), '403',
            'You do not have permission to make Role assignments.');

        $rules = [
            'member_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id'
        ];

        $request->validate($rules);

        $member = User::find($request->input('member_id'));
        $role = Role::findById($request->input('role_id'));

        // session error if user already has role
        if ($member->hasRole($role)) {
            return redirect(route('admin.permissions'));
        }

        // assign role
        $member->assignRole($role);

        return redirect(route('admin.permissions'))
            ->withSuccess('success', "Role successfully added to $member->name");
    }

    public function destroy(Request $request)
    {
        \abort_unless($request->user()->can(['Role-Revoke']), '403',
            'You do not have permission to change Role assignments.');

        $rules = [
            'member_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id'
        ];

        $request->validate($rules);

        $member = User::find($request->input('member_id'));
        $role = Role::findById($request->input('role_id'));

        // redirect if user does not already have role
        if (!$member->hasRole($role)) {
            return redirect(route('admin.permissions'));
        }

        // prevent tampering with admin roles
        if ($role->name = 'Staff' && $request->user()->cannot('can delete Staff')) {
            return redirect(route('admin.permissions'));
        }
        if ($role->name = 'Administrator' && $request->user()->cannot('can delete Administrators')) {
            return redirect(route('admin.permissions'));
        }

        // remove role
        $member->removeRole($role);

        return redirect(route('admin.permissions'))
            ->withSuccess('success', "Role successfullu removed from $member->name.");
    }
}
