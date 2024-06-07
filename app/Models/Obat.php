<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kemasan',
        'harga'
    ];

    public function periksas(): BelongsToMany
    {
        return $this->belongsToMany(Periksa::class, 'detail_periksas')->withTimestamps();
    }
}
