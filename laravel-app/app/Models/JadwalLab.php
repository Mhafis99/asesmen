<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'guru_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'materi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class);
    }
}
