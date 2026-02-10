<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_GURU_JURUSAN = 'guru_jurusan';
    const ROLE_WAKIL_KEPALA_SEKOLAH = 'wakil_kepala_sekolah';
    const ROLE_KEPALA_SEKOLAH = 'kepala_sekolah';
    const ROLE_BENDAHARA = 'bendahara';

    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_GURU_JURUSAN => 'Guru Jurusan',
        self::ROLE_WAKIL_KEPALA_SEKOLAH => 'Wakil Kepala Sekolah',
        self::ROLE_KEPALA_SEKOLAH => 'Kepala Sekolah',
        self::ROLE_BENDAHARA => 'Bendahara',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'jurusan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Filament: semua user yang ter-auth boleh masuk panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    // ── Relationships ────────────────────────────────────────

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    // ── Role Helpers ─────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isGuruJurusan(): bool
    {
        return $this->role === self::ROLE_GURU_JURUSAN;
    }

    public function isWakilKepalaSekolah(): bool
    {
        return $this->role === self::ROLE_WAKIL_KEPALA_SEKOLAH;
    }

    public function isKepalaSekolah(): bool
    {
        return $this->role === self::ROLE_KEPALA_SEKOLAH;
    }

    public function isBendahara(): bool
    {
        return $this->role === self::ROLE_BENDAHARA;
    }

    /**
     * Apakah user ini bisa melakukan edit/create pada data akademik?
     */
    public function canEdit(): bool
    {
        return in_array($this->role, [
            self::ROLE_ADMIN,
            self::ROLE_GURU_JURUSAN,
            self::ROLE_WAKIL_KEPALA_SEKOLAH,
        ]);
    }

    /**
     * Apakah user ini hanya bisa melihat saja (view only)?
     */
    public function isViewOnly(): bool
    {
        return in_array($this->role, [
            self::ROLE_KEPALA_SEKOLAH,
            self::ROLE_BENDAHARA,
        ]);
    }
}
