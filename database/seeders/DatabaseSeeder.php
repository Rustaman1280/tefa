<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat jurusan contoh jika belum ada
        $jurusanRPL = Jurusan::firstOrCreate(
        ['kode' => 'RPL'],
        ['nama' => 'Rekayasa Perangkat Lunak']
        );

        $jurusanTKJ = Jurusan::firstOrCreate(
        ['kode' => 'TKJ'],
        ['nama' => 'Teknik Komputer dan Jaringan']
        );

        // Admin — bisa semua + kelola user
        User::firstOrCreate(
        ['email' => 'admin@tefa.test'],
        [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
        ]
        );

        // Wakil Kepala Sekolah — bisa tambah/edit semua jurusan
        User::firstOrCreate(
        ['email' => 'wakasek@tefa.test'],
        [
            'name' => 'Wakil Kepala Sekolah',
            'password' => bcrypt('password'),
            'role' => User::ROLE_WAKIL_KEPALA_SEKOLAH,
        ]
        );

        // Guru Jurusan RPL — hanya bisa kelola jurusan RPL
        User::firstOrCreate(
        ['email' => 'guru.rpl@tefa.test'],
        [
            'name' => 'Guru RPL',
            'password' => bcrypt('password'),
            'role' => User::ROLE_GURU_JURUSAN,
            'jurusan_id' => $jurusanRPL->id,
        ]
        );

        // Guru Jurusan TKJ — hanya bisa kelola jurusan TKJ
        User::firstOrCreate(
        ['email' => 'guru.tkj@tefa.test'],
        [
            'name' => 'Guru TKJ',
            'password' => bcrypt('password'),
            'role' => User::ROLE_GURU_JURUSAN,
            'jurusan_id' => $jurusanTKJ->id,
        ]
        );

        // Kepala Sekolah — hanya lihat semua
        User::firstOrCreate(
        ['email' => 'kepsek@tefa.test'],
        [
            'name' => 'Kepala Sekolah',
            'password' => bcrypt('password'),
            'role' => User::ROLE_KEPALA_SEKOLAH,
        ]
        );

        // Bendahara — hanya lihat semua
        User::firstOrCreate(
        ['email' => 'bendahara@tefa.test'],
        [
            'name' => 'Bendahara',
            'password' => bcrypt('password'),
            'role' => User::ROLE_BENDAHARA,
        ]
        );
    }
}
