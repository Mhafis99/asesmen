<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'jadwal_bimbingan_id',
        'guru_id',
        'nilai_kompetensi',
        'nilai_sikap',
        'catatan',
        'tanggal_penilaian',
    ];

    protected $casts = [
        'tanggal_penilaian' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function jadwalBimbingan()
    {
        return $this->belongsTo(JadwalBimbingan::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
