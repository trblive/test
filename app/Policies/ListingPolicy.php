<?php

namespace App\Policies;

use App\Models\Listings;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use function Symfony\Component\Translation\t;

class ListingPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        // only clients can create listings
        return $user->can('Listing-Add')
            ? Response::allow()
            : Response::deny('Only clients can create a new listing.');
    }


    /**
     * Determine whether the user can edit the model.
     */
    public function update(User $user, Listings $listings): Response
    {
        if ($user->can('Listing-Edit')) {
            return true
                ? Response::allow()
                : Response::deny('Only Administrators and Staff can edit other listings.');
        }
        // clients can edit own listings
        return $user->id === $listings->user_id
            ? Response::allow()
            : Response::deny('You may only edit listings registered with your profile.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listings $listings): Response
    {
        if ($user->can('Listing-Delete')) {
            return true
                ? Response::allow()
                : Response::deny('Only Administrators and Staff may delete any listing.');

        }
        // clients can delete own listings
        return $user->id === $listings->user_id
            ? Response::allow()
            : Response::deny('You may only delete listings registered to your user profile.');
    }

    /**
     * Determine whether the user can view trash.
     */
    public function trash(): bool
    {
//        if ($user->canAny(['Listing-Trash-Recover', 'Listing-Trash-Remove', 'Listing-Trash-Empty', 'Listing-Trash-Restore'])) {
//            return true
//                ? Response::allow()
//                : Response::deny('Only Administrators and Staff may view all trashed listings.');
//        }
//        // clients can view own trashed listings
//        return true
//            ? Response::allow()
//            : Response::deny('You may only view trashed listings registered to your user profile.');
        return true;

    }

    /**
     * Determine whether the user can remove trash.
     */
    public function remove(User $user): Response|bool
    {
        if ($user->can('Listing-Trash-Remove')) {
            return true
                ? Response::allow()
                : Response::deny('You may not remove listings.');
        }
        // clients can remove own trashed listings
        if ($user->hasRole('Client')) {
            return true
                ? Response::allow()
                : Response::deny('You may not remove listings.');
        }
        return false;
    }

    /**
     * Determine whether the user can restore trash.
     */
    public function recover(User $user): Response|bool
    {
        if ($user->can('Listing-Trash-Recover')) {
            return true
                ? Response::allow()
                : Response::deny('You may not recover listings.');
        }
        // clients can remove own trashed listings
        if ($user->hasRole('Client')) {
            return true
                ? Response::allow()
                : Response::deny('You may not remove listings.');
        }
        return false;
    }

    /**
     * Determine whether the user can empty the trash.
     */
    public function empty(User $user): Response|bool
    {
        if ($user->can('Listing-Trash-Empty')) {
            return true
                ? Response::allow()
                : Response::deny('You may not empty trash.');
        }
        // clients can empty own trash
        if ($user->hasRole('Client')) {
            return true
                ? Response::allow()
                : Response::deny('You may not empty trash.');
        }
        return false;
    }

    /**
     * Determine whether the user can recover all trash.
     */
    public function restore(User $user): Response|bool
    {
        if ($user->can('Listing-Trash-Restore')) {
            return true
                ? Response::allow()
                : Response::deny('You may not recover trash.');
        }
        // clients can recover own trash
        if ($user->hasRole('Client')) {
            return true
                ? Response::allow()
                : Response::deny('You may not recover trash.');
        }
        return false;
    }
}
