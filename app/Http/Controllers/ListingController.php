<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreListingsRequest;
use App\Http\Requests\UpdateListingsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('viewAny', Listings::class);

        $listings = Listings::paginate(10);

        if (auth()->user()->hasRole('Client')) {
            $trashedCount = Listings::onlyTrashed()->where('user_id', auth()->user()->id)->get()->count();
        } else {
            $trashedCount = Listings::onlyTrashed()->latest()->get()->count();
        }

        return view('listings.index', [
            'listings' => $listings,
            'trashedCount' => $trashedCount,
            'canEdit' => auth()->user()->can(['Listing-Edit', 'Listing-Delete']),
            'user' => auth()->user()
        ]);
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Listings $listing): View
    {
        $this->authorize('view', $listing);

        return view('listings.show', compact(['listing',]));
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', Listings::class);
        $user = Auth::user();
        return view('listings.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(StoreListingsRequest $request): RedirectResponse
    {
        $this->authorize('create', Listings::class);

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

        //$user = User::find($request->input('user_id'));

        // store
        $request->user()->listings()->create($validated);

        return redirect(route('listings.index'))
            ->withSuccess("Added Listing.");
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Listings $listing): View
    {
        $this->authorize('update', $listing);
        return view('listings.edit', compact(['listing',]));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(UpdateListingsRequest $request, Listings $listing)
    {
        $this->authorize('update', $listing);

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
     * @throws AuthorizationException
     */
    public function delete(Listings $listing): View
    {
        $this->authorize('delete', $listing);
        return view('listings.delete', compact(['listing',]));
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Listings $listing)
    {
        $this->authorize('delete', $listing);

        $listing->delete();
        return redirect(route('listings.index'))
            ->withSuccess("{$listing->title} moved to trash.");
    }

    /**
     * Return view showing all listings in the trash.
     */
    public function trash(): View
    {
        $this->authorize('trash', Listings::class);

        if (auth()->user()->hasRole('Client')) {
            $listings = Listings::onlyTrashed()->where('user_id', auth()->user()->id)->orderBy('deleted_at')->paginate(5);
        } else {
            $listings = Listings::onlyTrashed()->orderBy('deleted_at')->paginate(5);
        }

        return view('listings.trash', compact(['listings']));
    }

    /**
     * Restore listing from the trash.
     *
     * @param $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function recover($id): RedirectResponse
    {
        $this->authorize('recover', Listings::class);

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
     * @throws AuthorizationException
     */
    public function remove($id): RedirectResponse
    {
        $this->authorize('remove', Listings::class);

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
     * @throws AuthorizationException
     */
    public function empty(): RedirectResponse
    {
        $this->authorize('empty', Listings::class);

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
     * @throws AuthorizationException
     */
    public function restore(): RedirectResponse
    {
        $this->authorize('restore', Listings::class);

        $listings = Listings::onlyTrashed()->get();
        $trashCount = $listings->count();

        foreach ($listings as $listing) {
            $listing->restore();
        }
        return redirect(route('listings.trash'))
            ->withSuccess("All users successfully restored.");
    }
}
