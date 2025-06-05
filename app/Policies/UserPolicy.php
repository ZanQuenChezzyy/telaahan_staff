<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Only users with the 'admin' role can view this resource
        return $user->hasRole('Admin');
    }

    /**
     * Determine if the given user can delete the specified user record.
     */
    public function delete(User $user, User $model): bool
    {
        // Prevent users from deleting their own account
        return $user->id !== $model->id;
    }

    /**
     * Determine if the given user can bulk delete user records.
     */
    public function deleteAny(User $user): bool
    {
        // Allow bulk delete action in general
        return true;
    }

    /**
     * Other policy methods (view, create, update, delete, etc.)
     */
}
