<?php

namespace App\Policies;

use App\Models\Kelas;
use App\Models\User;

class KelasPolicy
{
    /**
     * Semua role boleh melihat daftar kelas.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua role boleh melihat detail kelas.
     */
    public function view(User $user, Kelas $kelas): bool
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
    public function update(User $user, Kelas $kelas): bool
    {
        if (!$user->canEdit()) {
            return false;
        }

        if ($user->isGuruJurusan()) {
            return $user->jurusan_id === $kelas->jurusan_id;
        }

        return true;
    }

    /**
     * Hanya Admin yang boleh menghapus.
     */
    public function delete(User $user, Kelas $kelas): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
