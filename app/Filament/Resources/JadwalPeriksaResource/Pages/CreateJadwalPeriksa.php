<?php

namespace App\Filament\Resources\JadwalPeriksaResource\Pages;

use App\Filament\Resources\JadwalPeriksaResource;
use App\Models\JadwalPeriksa;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwalPeriksa extends CreateRecord
{
    protected static string $resource = JadwalPeriksaResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['id_dokter'] = auth()->user()->dokter->id;

        if ($data['is_active']) {
            $data['id_dokter'] = auth()->user()->dokter->id;

            JadwalPeriksa::where('id_dokter', $data['id_dokter'])
                ->update(['is_active' => false]);
        }

        return $data;
    }


}
