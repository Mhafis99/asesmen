<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status_guru',
        'nis',
        'nip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    public function isPembimbing(): bool
    {
        return $this->status_guru === 'pembimbing';
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    public function jadwalBimbinganSebagaiGuru()
    {
        return $this->hasMany(JadwalBimbingan::class, 'guru_id');
    }

    public function jadwalLabSebagaiGuru()
    {
        return $this->hasMany(JadwalLab::class, 'guru_id');
    }

    public function jadwalBimbinganSebagaiPembimbing()
    {
        return $this->hasMany(JadwalBimbingan::class, 'guru_id');
    }
}
