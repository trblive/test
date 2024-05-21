<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingsRequest;
use App\Http\Requests\UpdateListingsRequest;
use App\Models\Listings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $listings = Listings::paginate(10);
        $trashedCount = Listings::onlyTrashed()->latest()->get()->count();
        return view('listings.index', compact(['listings', 'trashedCount']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate
        $rules = [
            'title' => ['string', 'required'],
            'description' => ['string', 'required'],
            'salary' => ['string', 'required'],
            'tags' => ['string', 'required'],
            'company' => ['string', 'required'],
            'address' => ['string', 'required'],
            'city' => ['string', 'required'],
            'state' => ['string', 'required'],
            'phone' => ['string', 'required'],
            'email' => ['email:rfc', 'required'],
            'requirements' => ['string', 'required'],
            'benefits' => ['string', 'required'],
        ];
        $validated = $request->validate($rules);

        // store
        $listing = Listings::create(
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'salary' => $validated['salary'],
                'tags' => $validated['tags'],
                'company' => $validated['company'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'requirements' => $validated['requirements'],
                'benefits' => $validated['benefits'],
                'updated_at' => now()
            ]
        );

        return redirect(route('users.index'))
            ->withSuccess("Added '{$listing->title}'.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Listings $listing): View
    {
        return view('listings.show', compact(['listing',]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listings $listing): View
    {
        return view('listings.edit', compact(['listing',]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listings $listing)
    {
        // Validate
        $rules = [
            'title' => ['string', 'required'],
            'description' => ['string', 'required'],
            'salary' => ['string', 'required'],
            'tags' => ['string', 'required'],
            'company' => ['string', 'required'],
            'address' => ['string', 'required'],
            'city' => ['string', 'required'],
            'state' => ['string', 'required'],
            'phone' => ['string', 'required'],
            'email' => ['email:rfc', 'required'],
            'requirements' => ['string', 'required'],
            'benefits' => ['string', 'required'],
        ];
        $validated = $request->validate($rules);

        // store
        $listing->update(
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'salary' => $validated['salary'],
                'tags' => $validated['tags'],
                'company' => $validated['company'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'requirements' => $validated['requirements'],
                'benefits' => $validated['benefits'],
                'updated_at' => now()
            ]
        );

        return redirect(route('listings.show', $listing))
            ->withSuccess("Updated {$listing->title}.");
    }

    /**
     * Show form to confirm deletion of user from storage.
     */
    public function delete(Listings $listing): View
    {
        return view('listings.delete', compact(['listing',]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listings $listing)
    {
        $listing->delete();
        return redirect(route('listings.index'))
            ->withSuccess("{$listing->title} moved to trash.");
    }

    /**
     * Return view showing all listings in the trash.
     */
    public function trash(): View
    {
        $listings = Listings::onlyTrashed()->orderBy('deleted_at')->paginate(5);
        return view('listings.trash', compact(['listings']));
    }

    /**
     * Restore listing from the trash.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $listing = Listings::onlyTrashed()->find($id);
        $listing->restore();
        return redirect(route('listings.trash'))
            ->withSuccess("{$listing->title} has been restored.");
    }

    /**
     * Permanently remove listing in trash.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function remove($id): RedirectResponse
    {
        $listing = Listings::onlyTrashed()->find($id);
        $oldListing = $listing;
        $listing->forceDelete();
        return redirect()
            ->back()
            ->withSuccess("{$oldListing->title} has been permanently deleted.");
    }

    /**
     * Permanently remove all listings that are in the trash
     *
     * @return RedirectResponse
     */
    public function empty(): RedirectResponse
    {
        $listings = Listings::onlyTrashed()->get();
        $trashCount = $listings->count();
        foreach ($listings as $listing) {
            $listing->forceDelete();
        }
        return redirect(route('listings.trash'))
            ->withSuccess("Trash emptied successfully.");
    }

    /**
     * Restore all listings in the trash to system
     *
     * @return RedirectResponse
     */
    public function recoverAll(): RedirectResponse
    {
        $listings = Listings::onlyTrashed()->get();
        $trashCount = $listings->count();

        foreach ($listings as $listing) {
            $listing->restore();
        }
        return redirect(route('listings.trash'))
            ->withSuccess("All users successfully restored.");
    }
}
