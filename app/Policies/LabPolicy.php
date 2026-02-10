<?php

namespace App\Policies;

use App\Models\Lab;
use App\Models\User;

class LabPolicy
{
    /**
     * Semua role boleh melihat daftar lab.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua role boleh melihat detail lab.
     */
    public function view(User $user, Lab $lab): bool
    {
        return true;
    }

    /**
     * Hanya Admin, Wakil Kepala Sekolah, dan Guru Jurusan yang boleh membuat.
     */
    public function create(User $user): bool
    {
        return $user->canEdit();
    }

    /**
     * Hanya Admin, Wakil Kepala Sekolah, dan Guru Jurusan (jurusan miliknya) yang boleh edit.
     */
    public function update(User $user, Lab $lab): bool
    {
        if (!$user->canEdit()) {
            return false;
        }

        if ($user->isGuruJurusan()) {
            return $user->jurusan_id === $lab->jurusan_id;
        }

        return true;
    }

    /**
     * Hanya Admin yang boleh menghapus.
     */
    public function delete(User $user, Lab $lab): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
