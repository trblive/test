<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingsRequest;
use App\Http\Requests\UpdateListingsRequest;
use App\Models\Listings;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        $usersCount = User::all()->count();
        $listingsCount = Listings::all()->count();
        return view('dashboard.index', compact(['user', 'usersCount', 'listingsCount',]));
    }

    /**
     * Display the specified resource.
     */
    public function show(): View
    {
        $user = Auth::user();
        return view('dashboard.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('dashboard.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

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

        return redirect(route('dashboard.show', $user))
            ->withSuccess("Profile changes saved.");
    }

    /**
     * Show form to confirm deletion of user account
     */
    public function delete(): View
    {
        $user = Auth::user();
        return view('dashboard.delete', compact(['user',]));
    }

    /**
     * Remove the user from storage.
     */
    public function destroy(): RedirectResponse
    {
        $user = Auth::user();
        $user->delete();
        return redirect(route('welcome'));
    }
}
