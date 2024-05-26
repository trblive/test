<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a list of all registered users.
     */
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        $users = User::paginate(10);
        $trashedCount = User::onlyTrashed()->latest()->get()->count();
        return view('users.index', compact(['users', 'trashedCount',]));

    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
    {
        $this->authorize('view', [User::class, $user]);
        return view('users.show', compact(['user',]));
    }

    /**
     * Show the form for adding a new user.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     * @throws AuthorizationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        // Validate
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:128'],
            'email' => ['required', 'email:rfc', 'unique:users'],
            'city' => ['required', 'string', 'min:3', 'max:128'],
            'state' => ['required', 'string', 'min:2', 'max:128'],
            'password' => ['required', 'confirmed', Password::min(4)->letters()],
        ];
        $validated = $request->validate($rules);

        // Store
        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'remember_token' => Str::random(10),
                'city' => $validated['city'],
                'state' => $validated['state']
            ]
        );

        return redirect(route('users.index'))
            ->withSuccess("Added '{$user->name}'.");
    }

    /**
     * Show the form for editing the specified user.
     * @throws AuthorizationException
     */
    public function edit(User $user): View
    {
        $this->authorize('update', [User::class, $user]);
        return view('users.edit', compact(['user',]));
    }

    /**
     * Update the specified user in storage.
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', [User::class, $user]);

        if (empty($request['password'])) {
            unset($request['password']);
            unset($request['password_confirmation']);
        }

        // Validate
        $rules = [
            'name' => ['string', 'required', 'min:3', 'max:128'],
            'email' => ['required', 'email:rfc', Rule::unique('users')->ignore($user)],
            'city' => ['required', 'string', 'min:3', 'max:128'],
            'state' => ['required', 'string', 'min:2', 'max:128'],
            'password' => ['sometimes', 'confirmed', Password::min(4)->letters()],
            'password_confirmation' => ['sometimes', 'required_unless:password,null'],

        ];
        $validated = $request->validate($rules);

        // Store
        $user->update(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'password' => !empty($validated['password']) ? $validated['password'] : $user['password'],
                'updated_at' => now(),
            ]
        );

        return redirect(route('users.show', $user))
            ->withSuccess("Updated {$user->name}.");
    }

    /**
     * Show form to confirm deletion of user from storage.
     * @throws AuthorizationException
     */
    public function delete(User $user): View
    {
        $this->authorize('delete', [User::class, $user]);

        return view('users.delete', compact(['user',]));
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect(route('users.index'))
            ->withSuccess("{$user->name} moved to trash.");
    }

    /**
     * Return view showing all users in the trash.
     * @throws AuthorizationException
     */
    public function trash(): View
    {
        $this->authorize('trash', [User::class]);

        $users = User::onlyTrashed()->orderBy('deleted_at')->paginate(5);
        return view('users.trash', compact(['users']));
    }

    /**
     * Restore user from the trash.
     *
     * @param $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function restore($id): RedirectResponse
    {
        $this->authorize('restore', [User::class]);

        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect(route('users.trash'))
            ->withSuccess("{$user->name} has been restored.");
    }

    /**
     * Permanently remove user in the trash.
     *
     * @param $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function remove($id): RedirectResponse
    {
        $this->authorize('remove', [User::class]);

        $user = User::onlyTrashed()->find($id);
        $oldUser = $user;
        $user->forceDelete();
        return redirect()
            ->back()
            ->withSuccess("{$oldUser->name} has been permanently deleted.");
    }

    /**
     * Permanently remove all users that are in the trash
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function empty(): RedirectResponse
    {
        $this->authorize('empty', [User::class]);

        $users = User::onlyTrashed()->get();
        $trashCount = $users->count();
        foreach ($users as $user) {
            $user->forceDelete();
        }
        return redirect(route('users.trash'))
            ->withSuccess("Trash emptied successfully.");
    }

    /**
     * Restore all users in the trash to system
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function recoverAll(): RedirectResponse
    {
        $this->authorize('recoverAll', [User::class]);

        $users = User::onlyTrashed()->get();
        $trashCount = $users->count();

        foreach ($users as $user) {
            $user->restore();
        }
        return redirect(route('users.trash'))
            ->withSuccess("All users successfully restored.");
    }
}
