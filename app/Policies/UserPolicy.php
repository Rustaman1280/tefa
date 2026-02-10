<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Hanya Admin yang bisa melihat daftar user.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya Admin yang bisa melihat detail user.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya Admin yang bisa membuat user baru.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya Admin yang bisa mengedit user.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya Admin yang bisa menghapus user.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
