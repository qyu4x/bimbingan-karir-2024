<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class  Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_daftar_poli',
        'tanggal_periksa',
        'catatan',
        'biaya_periksa'
    ];

    public function daftar_polis(): BelongsTo
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli', 'id');
    }

    public function obats(): BelongsToMany
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas')->withTimestamps();
    }
}
