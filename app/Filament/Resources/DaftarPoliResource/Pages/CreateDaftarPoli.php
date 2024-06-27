<?php

namespace App\Filament\Resources\DaftarPoliResource\Pages;

use App\Filament\Resources\DaftarPoliResource;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Carbon\Traits\Date;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarPoli extends CreateRecord
{
    protected static string $resource = DaftarPoliResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $sequence = DaftarPoli::whereDate('created_at', now()->format('Y-m-d'))->count() + 1;

        $data['no_antrian'] = $sequence;
        $data['status_periksa'] = false;
        $data['id_pasien'] = auth()->user()->pasien->id;

        return $data;
    }


}
