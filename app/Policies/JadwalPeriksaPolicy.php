<?php

namespace App\Policies;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JadwalPeriksaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JadwalPeriksa $jadwalPeriksa): bool
    {
        return $user->isAdmin() || $user->isDoctor();
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
    public function update(User $user, JadwalPeriksa $jadwalPeriksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JadwalPeriksa $jadwalPeriksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JadwalPeriksa $jadwalPeriksa): bool
    {
        return $user->isDoctor();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JadwalPeriksa $jadwalPeriksa): bool
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
