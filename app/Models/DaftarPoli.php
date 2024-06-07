<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian'
    ];

    public function jadwal_periksas(): BelongsTo
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa', 'id');
    }

    public function pasiens(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }

    public function periksas(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_daftar_poli', 'id');
    }
}
