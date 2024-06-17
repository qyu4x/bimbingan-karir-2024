<?php

namespace App\Filament\Resources\JadwalPeriksaResource\Pages;

use App\Filament\Resources\JadwalPeriksaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwalPeriksa extends CreateRecord
{
    protected static string $resource = JadwalPeriksaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['id_dokter'] = auth()->user()->dokter->id;

        return $data;
    }


}
