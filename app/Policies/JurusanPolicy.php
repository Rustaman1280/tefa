<?php

namespace App\Policies;

use App\Models\Jurusan;
use App\Models\User;

class JurusanPolicy
{
    /**
     * Semua role boleh melihat daftar jurusan.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua role boleh melihat detail jurusan.
     */
    public function view(User $user, Jurusan $jurusan): bool
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
     * Hanya Admin, Wakil Kepala Sekolah, dan Guru Jurusan (miliknya) yang boleh edit.
     */
    public function update(User $user, Jurusan $jurusan): bool
    {
        if (!$user->canEdit()) {
            return false;
        }

        // Guru Jurusan hanya bisa edit jurusan miliknya
        if ($user->isGuruJurusan()) {
            return $user->jurusan_id === $jurusan->id;
        }

        return true;
    }

    /**
     * Hanya Admin yang boleh menghapus.
     */
    public function delete(User $user, Jurusan $jurusan): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
