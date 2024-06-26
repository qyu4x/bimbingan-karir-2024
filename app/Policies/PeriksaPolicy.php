<?php

namespace App\Policies;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PeriksaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Periksa $periksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Periksa $periksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Periksa $periksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Periksa $periksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Periksa $periksa): bool
    {
        return $user->isDoctor();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->isDoctor();
    }
}
