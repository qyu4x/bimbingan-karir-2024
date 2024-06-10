<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm'
    ];

    public function daftar_polis() : HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public static function generateMedicalRecordNumber()
    {
        $datePart = now()->format('Ymd');
        $count = self::whereDate('created_at', now()->format('Y-m-d'))->count() + 1;
        $number = str_pad($count, 4, '0', STR_PAD_LEFT);

        return "{$datePart}-{$number}";
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($patient) {
            $patient->user()->delete();
        });
    }
}
