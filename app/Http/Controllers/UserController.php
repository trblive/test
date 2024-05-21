<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $users = User::paginate(10);
        $trashedCount = User::onlyTrashed()->latest()->get()->count();
        return view('users.index', compact(['users', 'trashedCount',]));

    }

    /**
     * Show the form for adding a new user.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request): RedirectResponse
    {
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
     * Display the specified user.
     */
    public function show(User $user): View
    {
        return view('users.show', compact(['user',]));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact(['user',]));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {

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
     */
    public function delete(User $user): View
    {
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
     */
    public function trash(): View
    {
        $users = User::onlyTrashed()->orderBy('deleted_at')->paginate(5);
        return view('users.trash', compact(['users']));
    }

    /**
     * Restore user from the trash.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
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
     */
    public function remove($id): RedirectResponse
    {
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
     */
    public function empty(): RedirectResponse
    {
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
     */
    public function recoverAll(): RedirectResponse
    {
        $users = User::onlyTrashed()->get();
        $trashCount = $users->count();

        foreach ($users as $user) {
            $user->restore();
        }
        return redirect(route('users.trash'))
            ->withSuccess("All users successfully restored.");
    }
}
