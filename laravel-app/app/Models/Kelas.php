<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'jurusan',
        'angkatan',
    ];

    public function siswa()
    {
        return $this->hasMany(User::class);
    }

    public function jadwalBimbingan()
    {
        return $this->hasMany(JadwalBimbingan::class);
    }

    public function jadwalLab()
    {
        return $this->hasMany(JadwalLab::class);
    }
}
