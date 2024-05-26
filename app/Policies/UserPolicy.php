<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('User-Browse')
            ? Response::allow()
            : Response::deny('Only Administrators and Staff can view all users.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // admin and staff can view all
        if ($user->can('User-Show')) {
            return true;
        }

        // users can view their own profile
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        // admin and staff can create users
        return ($user->can('User-Add'))
            ? Response::allow()
            : Response::deny('Only Administrators and Staff can add a new user.');
    }

    /**
     * Determine whether the user can edit the model.
     */
    public function update(User $user, User $model): Response
    {
        // admin can edit anyone
        if ($user->hasRole('Administrator')) {
            return true
                ? Response::allow()
                : Response::deny('Only Administrators may edit any user\'s details.');
        }

        // staff can edit clients
        if ($user->hasRole('Staff')) {
            return $model->hasRole('Client')
                ? Response::allow()
                : Response::deny('Staff may only edit client users\' details.');
        }

        // users can edit their own profile
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You may only edit your own user profile.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        // admin can delete anyone but themselves
        if ($user->hasRole('Administrator')) {
            return $user->id !== $model->id
                ? Response::allow()
                : Response::deny();
        } // staff can only delete clients
        elseif ($user->hasRole('Staff')) {
            return $model->hasRole('Client')
                ? Response::allow()
                : Response::deny('Staff may only delete client users.');
        } // users can delete their own profile
        else {
            return $user->id === $model->id
                ? Response::allow()
                : Response::deny('You may only delete your own user profile.');
        }
    }

    /**
     * Determine whether the user can view trash.
     */
    public function trash(User $user): Response
    {
        if ($user->canAny(['User-Trash-Recover', 'User-Trash-Remove', 'User-Trash-Empty', 'User-Trash-Restore'])) {
            return true
                ? Response::allow()
                : Response::deny();
        }
        return false
            ? Response::allow()
            : Response::deny('Only Administrators may view trashed users.');
    }

    /**
     * Determine whether the user can remove a user from the trash.
     */
    public function remove(User $user): bool
    {
        if ($user->can('User-Trash-Remove')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can recover a user from the trash.
     */
    public function recover(User $user): bool
    {
        if ($user->can('User-Trash-Recover')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can empty the trash.
     */
    public function empty(User $user): bool
    {
        if ($user->can('User-Trash-Empty')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can recover all users from the trash.
     */
    public function restore(User $user): bool
    {
        if ($user->can('User-Trash-Restore')) {
            return true;
        }
        return false;
    }
}
