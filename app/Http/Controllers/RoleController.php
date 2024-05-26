<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function middleware($middleware, array $options = []): array
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

    /**
     * Display a list of all roles.
     */
    public function index(): View
    {
        \abort_unless(auth()->user()->can(['Role-Browse']), '403',
            'You do not have permission to view user Roles.');

        $roles = Role::all();
        return view('roles.index', [
            'roles' => $roles,
            'canEdit' => auth()->user()->canAny(['Role-Edit', 'Role-Delete']),
        ]);
    }

    /**
     * Display the associated users of the specified role.
     */
    public function show(Role $role): View
    {
        \abort_unless(auth()->user()->can(['Role-Show']), '403',
            'You do not have permission to view Role assignments.');

        // user selector dropdown
        $select = new User;
        $select->id = 0;
        $select->name = 'Please select';

        $allUsers = User::withoutRole($role)
            ->get();

        $users = User::role($role->name)->get();

        return view('roles.show', [
            'role' => $role,
            'users' => $users,
            'allUsers' => $allUsers,
            'canEdit' => auth()->user()->can(['Role-Assign', 'Role-Revoke']),
        ]);
    }

    /**
     * Show the form for editing the specified role permissions.
     */
    public function edit(Role $role): View
    {
        \abort_unless(auth()->user()->can(['Role-Edit']), '403',
            'You do not have permission to edit Role permissions.');

        $perms_user = DB::table('permissions')->where('name', 'like', 'User%')->get();
        $perms_listing = DB::table('permissions')->where('name', 'like', 'Listing%')->get();
        $perms_admin = DB::table('permissions')->where('name', 'like', 'Role%')->get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        $permissions = Permission::get();

        return view('roles.edit',
            [
                'role' => $role,
                'permissions' => $permissions,
                'rolePermissions' => $rolePermissions,
                'perms_user' => $perms_user,
                'perms_listing' => $perms_listing,
                'perms_admin' => $perms_admin
            ]);
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        \abort_unless(auth()->user()->can(['Role-Edit']), '403',
            'You do not have permission to edit Role permissions.');

        $validated = $request->validate([
            'name' => ['string', 'required'],
        ]);

        $role->update([
            'name' => $validated['name'],
        ]);
        $role->syncPermissions($request->input('permission'));

        return redirect(route('roles.index'))
            ->withSuccess("Updated $role->name");
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        \abort_unless(auth()->user()->can(['Role-Delete']), '403',
            'You do not have permission to delete Roles.');

        $role->delete();

        return redirect(route('roles.index'))
            ->withSuccess("$role->name permanently deleted.");
    }

    /**
     * Assign the role to a user.
     */
    public function assign_role(Request $request, Role $role): RedirectResponse
    {
        \abort_unless($request->user()->can(['Role-Assign']), '403',
            'You do not have permission to edit Role assignments.');

        $request->validate([
            'member_id' => 'exists:users,id'
        ]);

        $member = User::find($request->input('member_id'));

        // session error in case user already has role
        if ($member->hasRole($role)) {
            return back()->with('error', "$member->name already has this role.");
        }

        // assign role
        $member->assignRole($role);

        return redirect()->back()
            ->withSuccess("Role successfully added to $member->name");
    }

    /**
     * Remove the role from a user.
     */
    public function revoke_role(Request $request, Role $role): RedirectResponse
    {
        abort_unless($request->user()->can(['Role-Revoke']), '403',
            'You do not have permission to edit Role assignments.');

        $request->validate([
            'member_id' => 'exists:users,id'
        ]);

        $member = User::find($request->input('member_id'));

        // redirect in case user does not already have role
        if (!$member->hasRole($role)) {
            return back()->with('error', "$member->name does not have this role.");
        }

        // prevent tampering with admin roles
        if ($role->name = 'Staff' && $request->user()->cannot('can delete Staff')) {
            return back()->with('error', "You do not have permission to delete Staff roles.");
        }
        if ($role->name = 'Administrator' && $request->user()->cannot('can delete Administrators')) {
            return back()->with('error', "You do not have permission to delete Administrator roles.");
        }

        // remove role
        $member->removeRole($role);

        return redirect()->back()
            ->withSuccess("Role successfully removed from $member->name.");
    }
}
