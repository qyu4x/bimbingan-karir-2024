<?php

namespace App\Policies;

use App\Models\DaftarPoli;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DaftarPoliPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isPatient() || $user->isDoctor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DaftarPoli $daftarPoli): bool
    {
        return $user->isPatient() || $user->isDoctor();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isPatient();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DaftarPoli $daftarPoli): bool
    {
        return $user->isPatient() || $user->isDoctor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DaftarPoli $daftarPoli): bool
    {
        return $user->isPatient() || $user->isDoctor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DaftarPoli $daftarPoli): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DaftarPoli $daftarPoli): bool
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
